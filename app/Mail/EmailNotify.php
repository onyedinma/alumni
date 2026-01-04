<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNotify extends Mailable
{
    use Queueable, SerializesModels;

    protected $singleData;
    protected $userData;
    protected $customData;
    protected $template;
    protected $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($singleData=NULL,$userData=NULL,$customData=NULL,$template=NULL,$link=NULL)
    {
        $this->singleData = $singleData;
        $this->userData = $userData;
        $this->customData = $customData;
        $this->template = $template;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->singleData != NULL)
        {
            return $this->from(getOption('MAIL_FROM_ADDRESS'), getOption('app_name'))
            ->subject($this->singleData->subject)
            ->markdown('mail.single-email-notify')
            ->with([
                'message' => $this->singleData->message,
            ]);
        }
        else{
            $data = [
                'userData' => $this->userData,
                'template' => $this->template,
            ];
            if($this->customData != NULL)
            {
                $data['customData'] = $this->customData;
            }
            if($this->link != NULL)
            {
                $data['link'] = $this->link;
            }
            return $this->from(getOption('MAIL_FROM_ADDRESS'), getOption('app_name'))
            ->subject(getEmailTemplate($this->template, 'subject', $link = '', $this->customData, $this->userData))
            ->markdown('mail.email-notify')
            ->with($data);
        }
    }
}
