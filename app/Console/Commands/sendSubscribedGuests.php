<?php

namespace App\Console\Commands;

use App\Mail\SendGuestSubscriptionEmail;
use App\Mail\SendSubscriptionEmail;
use App\Models\NewsletterJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendSubscribedGuests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guests:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $redayEmailsJobs = NewsletterJob::with('email','newsletter')->where('status', '>', 0)->where('status','<',4)->get();

        foreach ($redayEmailsJobs as $job) {
            try {
                $to = $job->newsletter->email;
                $job->email->to = $to;
                Mail::to($to)
                    ->send(new SendGuestSubscriptionEmail($job));
                $job->status = 4;
                $job->save();
            } catch (\Exception $e) {
                $job->log = $job->log . '\r\n' . $job->status . '.' . $e->getMessage();
                $job->status = $job->status + 1;
                $job->save();
            }
        }
    }
}
