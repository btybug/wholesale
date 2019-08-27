<?php


namespace App\Services;


use App\Events\OrderCanceled;
use App\Events\OrderCompleted;
use App\Events\OrderCompletelyCollected;
use App\Events\OrderSubmitted;
use App\Models\Settings;
use App\Models\Statuses;

class OrdersService
{
    public function changeStatus($order, $status_id)
    {
        $status = Statuses::find($status_id);
        if($status && $status->is_default){
            $settings=new Settings();
            $model = $settings->getEditableData('orders_statuses');
            switch (array_search($status_id,$model->toArray())){
                case 'submitted':event(new OrderSubmitted($order->user,$order));break;
                case 'canceled':event(new OrderCanceled($order->user,$order));break;
                case 'completed':event(new OrderCompleted($order->user,$order));break;
                case 'collected':event(new OrderCompletelyCollected($order->user,$order));break;
                case 'partially_collected':event(new OrderPartiallyCollected($order->user,$order));break;
            }
        }
    }
}
