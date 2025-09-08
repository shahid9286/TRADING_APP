<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalPaidMail extends Mailable
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
        return $this->subject("Withdrawal #{$this->withdrawal_request->id} Paid Successfully")
                    ->view('admin.emails.withdrawal_paid');
    }
}
