<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;

use App\Models\Common\Translatable;
use App\Models\Translations\StockTranslation;
use Illuminate\Database\Eloquent\Model;

class Stock extends Translatable
{
    /**
     * @var string
     */
    protected $table = 'stocks';

    public $translationModel = StockTranslation::class;

    public $translatedAttributes = ['name', 'short_description', 'long_description','what_is_content'];
    /**
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'other_images' => 'json',
        'videos' => 'json',
        'posters' => 'json',
    ];

    const TYPES = [
        'vape' => 'Devices',
        'juice' => 'Juice',
        'parts' => 'Devices parts'
    ];

    const STATUS = [
        '0' => 'Draft',
        '1' => 'Published'
    ];

    public function specifications()
    {
        return $this->belongsToMany(Attributes::class, 'stock_attributes', 'stock_id', 'attributes_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'stock_categories', 'stock_id', 'categories_id')
            ->where('categories.type', 'stocks');
    }

    public function stockAttrs()
    {
        return $this->hasMany(StockAttribute::class, 'stock_id')->with('children')->whereNull('parent_id');
    }

    public function variations()
    {
        return $this->hasMany(StockVariation::class, 'stock_id');
    }

    public function promotion_prices()
    {
        return $this->hasMany(PromotionPrice::class, 'promotion_id');
    }

    public function related_products()
    {
        return $this->belongsToMany(Stock::class, 'stock_related', 'stock_id', 'related_id');
    }

    public function promotions()
    {
        return $this->belongsToMany(Stock::class, 'product_promotions', 'stock_id', 'promotion_id')->withPivot('type');
    }

    public function stickers()
    {
        return $this->belongsToMany(Stickers::class, 'stock_stickers', 'stock_id', 'sticker_id');
    }

    public function forRender()
    {
        if (!$this->id) return [];

        return Attributes::leftJoin('stock_variation_options', 'attributes.id', '=', 'stock_variation_options.attributes_id')
            ->leftJoin('stock_variations', 'stock_variation_options.variation_id', '=', 'stock_variations.id')
            ->leftJoin('stocks', 'stock_variations.stock_id', '=', 'stocks.id')
//            ->leftJoin('attributes', 'product_variation_options.options_id','=' ,'attributes.id')
            ->where('stocks.id', '=', $this->id)
            ->select('attributes.*', 'stock_variation_options.attributes_id as attr_id')
            ->distinct()
//            ->groupBy('attr_id','attributes.id','attributes.parent_id','attributes.user_id','attributes.image','attributes.icon','attributes.filter','attributes.display_as','attributes.created_at','attributes.updated_at')
            ->get();

    }

    public function seo()
    {
        return $this->hasMany(StockSeo::class, 'stock_id');
    }

    public function getSeoField($name, $type = 'general')
    {
        $seo = $this->seo()->where('name', $name)->where('type', $type)->first();
        return ($seo) ? $seo->content : null;
    }

    public function type_attrs()
    {
        return $this->belongsToMany(Attributes::class, 'stock_type_attributes', 'stock_id', 'attributes_id')
            ->whereNull('stock_type_attributes.sticker_id')->withPivot('type');
    }

    public function type_attrs_all()
    {
        return $this->hasMany(StockTypeAttribute::class, 'stock_id', 'id');
    }

    public function type_attrs_pivot()
    {
        return $this->hasMany(StockTypeAttribute::class, 'stock_id', 'id')
            ->whereNotNull('stock_type_attributes.sticker_id');
    }

    public function sales()
    {
        return $this->hasMany(StockSales::class, 'stock_id');
    }

    public function active_sales()
    {
        $now = strtotime(now());
        return $this->hasMany(StockSales::class, 'stock_id')->where('canceled',false)
            ->whereRaw("stock_sales.start_date <= ? AND stock_sales.end_date >= ?",
            array($now, $now)
        );
    }

    public function faqs()
    {
        return $this->belongsToMany(Faq::class, 'faq_stocks', 'stock_id', 'faq_id');
    }
}