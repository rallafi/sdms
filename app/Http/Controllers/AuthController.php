<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\ActivityLog;
use App\Models\OtpRecord;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController
{
    /**
     * Show register page
     */
    public function showRegisterForm()
    {
        // Only Engineer and Manager can register from UI
        $roles = Role::whereIn('name', ['engineer', 'manager'])->get();

        return view('auth.register', compact('roles'));
    }

    /**
     * Save new user account
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'roleName' => 'required|string|in:engineer,manager',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role = Role::where('name', $request->roleName)->first();

        if (!$role) {
            return back()->with('error', 'Selected role was not found. Please try again.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        // Save registration log
        $this->saveActivityLog(
            $user->id,
            'register',
            'New account created successfully.',
            $request->ip()
        );

        return redirect()->route('login')->with('success', 'Registration completed successfully. Please login now.');
    }

    /**
     * Show login page
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * First login step: check email/password and send OTP
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        // Check if email exists and password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            $this->saveActivityLog(
                $user?->id,
                'login_failed',
                'Invalid email or password.',
                $request->ip()
            );

            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->withInput();
        }

        // Check if user is active
        if (!$user->is_active) {
            return back()->withErrors([
                'email' => 'Your account is inactive.',
            ]);
        }

        // Mark old OTPs as used before making a new one
        OtpRecord::where('user_id', $user->id)
            ->where('is_used', false)
            ->update(['is_used' => true]);

        // Generate a simple 6 digit OTP
        $otpCode = (string) random_int(100000, 999999);

        OtpRecord::create([
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'expires_at' => now()->addMinutes(5),
            'is_used' => false,
        ]);

        // Send OTP to email
        Mail::to($user->email)->send(new OtpMail($user->name, $otpCode));

        // Store pending user id in session until OTP is verified
        session([
            'pending_user_id' => $user->id,
        ]);

        $this->saveActivityLog(
            $user->id,
            'otp_sent',
            'OTP was sent to the user email.',
            $request->ip()
        );

        return redirect()->route('otp.form')->with('success', 'OTP has been sent to your email.');
    }

    /**
     * Show OTP form
     */
    public function showOtpForm(Request $request)
{
    if (!$request->session()->has('pending_user_id')) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    return view('auth.verify-otp');
}

    /**
     * Second login step: verify OTP and complete login
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otpCode' => 'required|digits:6',
        ]);

        $pendingUserId = session('pending_user_id');

        if (!$pendingUserId) {
            return redirect()->route('login')->with('error', 'Your login session has expired. Please login again.');
        }

        $user = User::find($pendingUserId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        $otpRecord = OtpRecord::where('user_id', $user->id)
            ->where('is_used', false)
            ->latest()
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'OTP record not found. Please login again.');
        }

        // Check expiry first
        if (now()->greaterThan($otpRecord->expires_at)) {
            $otpRecord->is_used = true;
            $otpRecord->save();

            $this->saveActivityLog(
                $user->id,
                'otp_failed',
                'OTP expired.',
                $request->ip()
            );

            return back()->with('error', 'OTP has expired. Please login again.');
        }

        // Check entered OTP
        if ($otpRecord->otp_code !== $request->otpCode) {
            $this->saveActivityLog(
                $user->id,
                'otp_failed',
                'Incorrect OTP entered.',
                $request->ip()
            );

            return back()->with('error', 'Incorrect OTP.');
        }

        // Mark OTP as used
        $otpRecord->is_used = true;
        $otpRecord->save();

        // Complete login now
        Auth::login($user);

        // Regenerate session after login
        $request->session()->regenerate();

        // Save the new session id to enforce one active session
        $user->current_session_id = $request->session()->getId();
        $user->last_login_at = now();
        $user->save();

        // Remove pending login data
        $request->session()->forget('pending_user_id');

        $this->saveActivityLog(
            $user->id,
            'login_success',
            'User completed login with OTP successfully.',
            $request->ip()
        );

        return redirect()->route('dashboard')->with('success', 'Login successful.');
    }

    /**
     * Dashboard after login
     */
    public function dashboard()
    {
        return view('dashboard.index');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        $user = User::find(Auth::id());
    
        if ($user) {
            $this->saveActivityLog(
                $user->id,
                'logout',
                'User logged out successfully.',
                $request->ip()
            );
    
            $user->current_session_id = null;
            $user->save();
        }
    
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    /**
     * Small helper function to save activity logs
     */
    private function saveActivityLog($userId, $action, $description, $ipAddress)
    {
        ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
            'ip_address' => $ipAddress,
        ]);
    }
}