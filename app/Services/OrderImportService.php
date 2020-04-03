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

class OrderImportService
{
    private $data = [];
    private $order;
    private $products;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function run(){
        $this->order = $this->data['order'];
        $this->products = $this->data['products'];

        if(count($this->products)){
            foreach ($this->products as $product){
                $this->buildProduct($product);
            }
        }

        dd('sssss');
    }

    private function buildProduct($data){
        $orderItem = $data['order_item'];
        $productData = $data['product'];

        $this->createOrUpdateRelatedTables($productData);
        dd($orderItem,$productData);
    }

    private function createOrUpdateRelatedTables($productData){

    }
}
