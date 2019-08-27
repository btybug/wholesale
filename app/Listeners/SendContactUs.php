<?php

namespace App\Listeners;

use App\Events\Tickets;
use App\Mail\ContactUs;
use App\Models\Gmail;
use App\Models\MailJob;
use App\Models\MailTemplates;

/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/24/2018
 * Time: 9:57 PM
 */
class SendContactUs
{

    /**
     * Handle the event.
     *
     * @param \Illuminate\Auth\Events\Registered $event
     * @return void
     */
    public function handle(\App\Events\ContactUs $event)
    {
        $mailTemplate = MailTemplates::where('slug', 'new_contact_us')
            ->where('is_active', '1')
            ->first();
        if ($mailTemplate) {
            try {
                $email = new ContactUs($mailTemplate, $event->email);
                \Config::set('mail.from.address', $mailTemplate->from);
                \Mail::to($event->email->email)->send($email);
//                \Mail::to('hakobyan.sahak88@gmail.com')->send($email);
                $event->email->message = Gmail::getEncodedBody($event->email->message);
                $event->email->recipients()->create(['name' => env('APP_NAME'), 'email' => Gmail::user()]);
                $event->email->save();


                if (MailTemplates::where('slug', 'admin_' . $mailTemplate->slug)->exists()) {
                    $adminMailTemplate = MailTemplates::where('slug', 'admin_' . $mailTemplate->slug)->first();
                    $email = new ContactUs($adminMailTemplate, $event->email);
                    \Config::set('mail.from.address', $adminMailTemplate->from);
//                    \Mail::to($adminMailTemplate->to)->cc($adminMailTemplate->cc)->send($email);
                \Mail::to('hakobyan.sahak88@gmail.com')->cc($adminMailTemplate->cc)->send($email);
                    $event->email->message = Gmail::getEncodedBody($event->email->message);
                    $event->email->recipients()->create(['name' => env('APP_NAME'), 'email' => Gmail::user()]);
                    $event->email->save();
                  
                }

            } catch
            (\Exception $exception) {
                \Log::emergency("message: " . $exception->getMessage() . "  --file-  line : " . $exception->getFile() . ' - ' . $exception->getLine());
            }

        }

    }
}
