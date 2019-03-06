<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/27/2018
 * Time: 8:05 PM
 */

namespace App\Listeners;

use App\Events\OrderCanceled;
use App\Events\OrderCompleted;
use App\Models\MailJob;
use App\Models\MailTemplates;

class SendEmailOrderCompleted
{
    public function handle(OrderCompletedted $event)
    {
        $mailTemplate = MailTemplates::where('slug', 'order_is_completed')
            ->where('is_active', '1')
            ->first();
        if ($mailTemplate) {
            MailJob::create([
                'template_id' => $mailTemplate->id,
                'must_be_done' => now(),
                'to' => $event->user->email,
                'additional_data' => $event->order,
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