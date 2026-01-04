<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $customer, $verification_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($customer, $verification_code)
    {
        $this->customer = $customer;
        $this->verification_code = $verification_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject(getEmailTemplate('Forgot Password', 'subject'))
            ->markdown('mail.forgot-verification')
            ->with([
                'customer' => $this->customer,
                'verification_code' => $this->verification_code,
            ]);
    }


}
