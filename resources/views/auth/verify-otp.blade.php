@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Verify OTP
            </div>

            <div class="card-body">
                <p class="mb-3">
                    Please enter the 6-digit OTP sent to your email address.
                </p>

                <form action="{{ route('otp.verify') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">OTP Code</label>
                        <input type="text" name="otpCode" class="form-control" maxlength="6" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection