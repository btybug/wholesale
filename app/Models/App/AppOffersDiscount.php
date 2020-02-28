<?php


namespace App\Models\App;


use Illuminate\Database\Eloquent\Model;

class AppOffersDiscount extends Model
{
    protected $table = 'app_offers_discount';
    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];
}
