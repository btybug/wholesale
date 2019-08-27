<?php

namespace App\Mail;

use App\Models\MailTemplates;
use App\Services\ShortCodes;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    private $mailTemplates;
    private $contactUs;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MailTemplates $mailTemplates,\App\Models\ContactUs $contactUs)
    {
        $this->mailTemplates = $mailTemplates;
        $this->contactUs = $contactUs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->view('email.contact')
            ->with('mailTemplates',$this->mailTemplates)
            ->with('Shortcodes',new ShortCodes())
            ->with('contactUs',$this->contactUs)
            ->subject($this->mailTemplates->subject);
        return $message;
    }
}


