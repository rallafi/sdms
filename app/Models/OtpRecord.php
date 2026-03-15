<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpRecord extends Model
{
    protected $fillable = [
        'user_id',
        'otp_code',
        'expires_at',
        'is_used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    // OTP belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}