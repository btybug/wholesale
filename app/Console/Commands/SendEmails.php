<?php

namespace App\Console\Commands;

use App\Mail\SendEmail;
use App\Models\MailJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

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
        //\File::put(public_path('test.txt'),now());
        $redayEmailsJobs = MailJob::where('status', '<', 3)->where('must_be_done', '<', now())->with('email')->get();
        foreach ($redayEmailsJobs as $job) {
            try {
                $to=($job->email->to)??$job->to;
                $job->email->to=$to;
                Mail::to($to)
                    ->send(new SendEmail($job));
                $job->status = 4;
                $job->sent_at = now();
                $job->save();
            } catch (\Exception $e) {
                $job->log = $job->log . '\r\n' . $job->status . '.' . $e->getMessage();
                $job->status = $job->status + 1;
                $job->save();
            }

        }
    }
}
