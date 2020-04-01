<?php


namespace App\Services;


use App\Events\OrderCanceled;
use App\Events\OrderCompleted;
use App\Events\OrderCompletelyCollected;
use App\Events\OrderPartiallyCollected;
use App\Events\OrderSubmitted;
use App\Models\Orders;
use App\Models\Others;
use App\Models\Settings;
use App\Models\Statuses;
use App\Models\Stock;

class OrderExportService
{
    private $id;
    private $data = [];

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function run(){
        $order = Orders::findOrFail($this->id);

        $this->data['order'] = $order->toArray();
        $products = [];
        foreach ($order->items as $item){
            $stock = Stock::with(['specifications','categories','offers',
                'special_offers','special_filters','offer_products','promotions',
                'stickers','type_attrs','faqs','brand','main_item','ads','banners'])->findOrFail($item->stock_id);

            $products[]= [
              'product' => $stock->toArray(),
              'order_item' => $item->toArray()
            ];
        }

        $this->data['products'] = $products;

        return $this->data;
    }
}
