<?php

namespace App\Console\Commands;

use App\Mail\SendSubscriptionEmail;
use App\Models\Newsletter;
use App\Models\Notifications\CustomEmailUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class sendSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:send';

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
        $redayEmailsJobs = CustomEmailUser::with('email')->where('status', '>', 0)->where('status','<',4)->get();

        foreach ($redayEmailsJobs as $job) {
            try {
                $subscribed = Newsletter::where('user_id',$job->user->id)->where('category_id',$job->email->category_id)->first();
                if($subscribed){
                    $to = $job->user->email;
                    $job->email->to = $to;
                    Mail::to($to)
                        ->send(new SendSubscriptionEmail($job));
                    $job->status = 4;
                    $job->save();
                }else{
                    $job->status = 5;
                    $job->save();
                }

            } catch (\Exception $e) {
                $job->log = $job->log . '\r\n' . $job->status . '.' . $e->getMessage();
                $job->status = $job->status + 1;
                $job->save();
            }
        }
    }
}
