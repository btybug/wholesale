<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/1/2018
 * Time: 1:37 PM
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\ItemTranslations;

/**
 * App\Models\Items
 *
 * @property int $id
 * @property string|null $sku
 * @property int $barcode_id
 * @property int|null $brand_id
 * @property string $type
 * @property array|null $manual_codes
 * @property string|null $alert
 * @property int $quantity
 * @property string $image
 * @property int $default_price
 * @property int $status
 * @property float|null $length
 * @property float|null $width
 * @property float|null $height
 * @property float|null $weight
 * @property float|null $item_length
 * @property float|null $item_width
 * @property float|null $item_height
 * @property float|null $item_weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_archive
 * @property int $landing
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemCategories[] $ItemCategories
 * @property-read int|null $item_categories_count
 * @property-read \App\Models\Barcodes $barcode
 * @property-read \App\Models\Category $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $qty
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemsLocations[] $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemsMedia[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Others[] $others
 * @property-read int|null $others_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemsPackages[] $packages
 * @property-read int|null $packages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Purchase[] $purchase
 * @property-read int|null $purchase_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemSpecification[] $specifications
 * @property-read int|null $specifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attributes[] $specificationsPivot
 * @property-read int|null $specifications_pivot_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Suppliers[] $suppliers
 * @property-read int|null $suppliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\ItemTranslations[] $translations
 * @property-read int|null $translations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ItemsMedia[] $videos
 * @property-read int|null $videos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items archive()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items main()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereAlert($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereBarcodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereDefaultPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereIsArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereItemHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereItemLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereItemWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereItemWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereLanding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereManualCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Items extends Translatable
{
    protected $table = 'items';

    protected $guarded = ['id'];

    protected $casts = [
        'manual_codes' => 'json',
    ];
    public $translationModel = ItemTranslations::class;

    public $translatedAttributes = ['name','short_name', 'short_description', 'long_description'];

    protected $appends = array('qty');

    const ACTIVE = 1;
    const DRAFT = 0;

    public function getQtyAttribute()
    {
        return ($this->type == 'simple') ? $this->purchase()->sum('qty') - $this->others()->sum('qty') : 0;
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE)->where('is_archive',self::DRAFT);
    }

//    public function getBarcodesAttribute()
//    {
//        return Barcodes::all()->pluck('code','id');
//    }

    public function scopeMain($query)
    {
        return $query->where('is_archive', false);
    }
    public function scopeArchive($query)
    {
        return $query->where('is_archive', true);
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'item_id');
    }

    public function barcode()
    {
        return $this->belongsTo(Barcodes::class, 'barcode_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'items.brand_id');
    }

    public function media()
    {
        return $this->hasMany(ItemsMedia::class, 'item_id')->where('items_media.type','image');
    }

    public function videos()
    {
        return $this->hasMany(ItemsMedia::class, 'item_id')->where('items_media.type','video');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Suppliers::class, 'item_suppliers', 'item_id', 'supplier_id');
    }

    public function packages()
    {
        return $this->hasMany(ItemsPackages::class, 'item_id');
    }

    public function locations()
    {
        return $this->hasMany(ItemsLocations::class, 'item_id');
    }

    public function others()
    {
        return $this->hasMany(Others::class, 'item_id');
    }

    public function specificationsPivot()
    {
        return $this->belongsToMany(Attributes::class, 'item_specifications', 'item_id', 'attributes_id');
    }

    public function specifications()
    {
        return $this->hasMany(ItemSpecification::class, 'item_id');
    }

    public function specifications_with_children()
    {
        return $this->hasMany(ItemSpecification::class, 'item_id')->has('children','>',0);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_categories', 'item_id', 'categories_id')
            ->where('categories.type', 'stocks');
    }

    public function ItemCategories()
    {
        return $this->hasMany(ItemCategories::class,'item_id');

    }
}
