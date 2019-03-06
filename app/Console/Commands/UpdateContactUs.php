<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Matrix\Exception;

class UpdateContactUs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gmail:update';

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
        try {
            $content='';
            if(\File::exists(base_path('test.txt'))){
                $content=\File::get(base_path('test.txt'));
            }
            $content=$content.date('Y-m-d h:m:s')."\r\n";
            \File::put(base_path('test.txt'),$content);
            $emails = \App\Models\ContactUs::whereNull('parent_id')->get();
            foreach ($emails as $email) {
                $content=$content."1\r\n";
                \File::put(base_path('test.txt'),$content);
                $gmail = \App\Models\Gmail::message()->subject($email->uniq_id)->preload()->all();
                $count = count($gmail);
                if ($count) {
                    $content=$content."2\r\n";
                    \File::put(base_path('test.txt'),$content);
                    if ($gmail[0]->getId() != $email->gmail_id) {
                        $email->gmail_id = $gmail[0]->getId();
                        $email->cron_status = 1;
                        $email->cron_status = 1;
                    }
                    if (($count - 1) > $email->children()->count()) {
                        echo 1;
                        $email->message = ($gmail[0]->getHtmlBody(true))?$gmail[0]->getHtmlBody(true):$email->message;
                        $content=$content."3\r\n";
                        \File::put(base_path('test.txt'),$content);
                        $missed_from = ($count - 1) - $email->children()->count();
                        foreach ($gmail as $key => $mail) {
                            if ($key == $missed_from) {
                                $child = $email->children()->create([
                                    'name' => $mail->getFrom()['name'],
                                    'phone' => $email->phone,
                                    'category' => $email->category,
                                    'email' => $mail->getFrom()['email'],
                                    'gmail_id' => $mail->getId(),
                                    'message' => $mail->getHtmlBody(true),
                                ]);
                                foreach ($mail->getTo() as $to)
                                    $child->recipients()->create($to);
                            }
                        }
                    }
                }
                $email->save();
            }
        }catch (\Exception $exception){
            \Log::emergency("message: " . $exception->getMessage(). "  --file-  line : " . $exception->getFile(). ' - ' .$exception->getLine());

        }
    }
}
