<?php

namespace App\Mail;

use App\Models\MailJob;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $job;
    public $to;

    public function __construct(MailJob $job)
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
        $this->from($this->job->email->from);
        if ($this->job->email->cc) {
            $this->cc(explode(',', $this->job->email->cc));
            }
        $this->subject($this->job->email->subject)
            ->view('send_email')
            ->with([
                'email' => $this->job->email,
                'user' => User::find($this->job->additional_data['user']['id']),
                'job' => $this->job,
            ]);
        return $this;
    }
}
