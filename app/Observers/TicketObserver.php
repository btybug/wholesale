<?php
/**
 * Created by PhpStorm.
 * User: hookTM
 * Date: 11/9/2018
 * Time: 11:51 AM
 */

namespace App\Observers;


use App\Models\Ticket;
use App\Traits\TracksHistoryTrait;

class TicketObserver
{
    use TracksHistoryTrait;

    public function updated(Ticket $model)
    {
//        $this->track($model);

        $this->track($model, function ($value, $field) use($model) {
            $column = str_replace(' ', '_', $field);
            $message = '';
            if ($column === 'status_id') {
                $value = $model->status->name;
                $field = "status";
            }elseif ($column == 'priority_id'){
                $value = $model->priority->name;
                $field = "priority";
            }elseif ($column == 'category_id'){
                $value = $model->category->name;
                $field = "category";
            }elseif ($column == 'staff_id'){
                $value = $model->staff->name;
                $field = "staff";
                $message = "Resigned responsibility to ${value}";
            }

            return [
                'body' => ($message) ? $message : "Updated {$field} to ${value}",
            ];
        });
    }

    public function deleting(Ticket $ticket)
    {
        //
    }
}