<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $otpCode;

    /**
     * Create a new message instance.
     */
    public function __construct($userName, $otpCode)
    {
        $this->userName = $userName;
        $this->otpCode = $otpCode;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your SDMS OTP Code')
            ->view('emails.otp');
    }
}