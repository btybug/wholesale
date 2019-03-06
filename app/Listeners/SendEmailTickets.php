<?php

namespace App\Listeners;

use App\Events\Tickets;
use App\Models\MailJob;
use App\Models\MailTemplates;

/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/24/2018
 * Time: 9:57 PM
 */
class SendEmailTickets
{

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered $event
     * @return void
     */
    public function handle(Tickets $event)
    {
            $mailTemplate = MailTemplates::where('slug', 'ticket')
                ->where('is_active', '1')
                ->first();
            if ($mailTemplate) {
                MailJob::create([
                    'template_id' => $mailTemplate->id,
                    'must_be_done' => now(),
                    'to' => $event->user->email,
                ]);
                if (MailTemplates::where('slug', 'admin_' . $mailTemplate->slug)->exists()) {
                    $adminMailTemplate = MailTemplates::where('slug', 'admin_' . $mailTemplate->slug)
                        ->first();
                    MailJob::create([
                        'template_id' => $adminMailTemplate->id,
                        'must_be_done' => now()
                    ]);
                }
            }

    }
}