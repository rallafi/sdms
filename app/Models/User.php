<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
        'last_login_at',
        'current_session_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // User belongs to one role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // User can have many OTP records
    public function otpRecords()
    {
        return $this->hasMany(OtpRecord::class);
    }

    // User can have many activity logs
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // Documents uploaded by this user
    public function uploadedDocuments()
    {
        return $this->hasMany(Document::class, 'uploaded_by');
    }

    // Documents last edited by this user
    public function editedDocuments()
    {
        return $this->hasMany(Document::class, 'last_edited_by');
    }

    // Reservations made by this user
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}