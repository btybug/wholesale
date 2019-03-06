<?php

namespace App\Mail;

use App\Models\NewsletterJob;
use App\Models\Notifications\CustomEmailUser;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendGuestSubscriptionEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $job;
    public $to;

    public function __construct(NewsletterJob $job)
    {
        $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->job->email->from)
            ->subject($this->job->email->subject)
            ->view('email.subscription_email_guests')
            ->with([
                'email' => $this->job->email,
                'user' => null,
                'job' => $this->job,
            ]);
    }
}
