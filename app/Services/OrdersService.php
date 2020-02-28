<?php


namespace App\Services;


use App\Events\OrderCanceled;
use App\Events\OrderCompleted;
use App\Events\OrderCompletelyCollected;
use App\Events\OrderPartiallyCollected;
use App\Events\OrderSubmitted;
use App\Models\Others;
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

    public function refundItems($orderItem,$order,$request)
    {
        if(count($orderItem->options)){
            foreach ($orderItem->options as $options){
                if(count($options)){
                    foreach ($options as $items){
                        if(isset($items['options'])){
                            foreach ($items['options'] as $item){
                                $sold = Others::where('grouped',$order->id)->where('item_id',$item['variation']['item_id'])
                                    ->where('qty',$item['qty'])->first();
                                if($sold){
                                    if($request->type){
                                        $sold->delete();
                                        $order->history()->create([
                                            'status_id' => null,
                                            'note' => "Refunded " . $sold->item->name ." and returned to Items",
                                        ]);
                                    }else{
                                        $sold->reason = $request->reason;
                                        $sold->notes = $request->notes;
                                        $sold->save();

                                        $order->history()->create([
                                            'status_id' => null,
                                            'note' => "Refunded " . $sold->item->name ." item, reason - ".$request->reason,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $orderItem->is_refunded = true;
        $orderItem->save();

        return $orderItem;
    }
}
