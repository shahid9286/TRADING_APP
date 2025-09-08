<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawal_request;
    public $user;

    public function __construct($withdrawal_request, $user)
    {
        $this->withdrawal_request = $withdrawal_request;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject("New Withdrawal Request from {$this->user->username}")
                    ->view('admin.emails.withdrawal_request');
    }
}
