<?php

namespace App\Models;

use App\Models\Common\Translatable;
use App\Models\Translations\WarehouseTranslations;
use App\User;

/**
 * App\Models\Warehouse
 *
 * @property int $id
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WarehouseRacks[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Items[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\App\Orders[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $staff
 * @property-read int|null $staff_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations\WarehouseTranslations[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Warehouse whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Warehouse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Common\Translatable withTranslation()
 * @mixin \Eloquent
 */
class Warehouse extends Translatable
{
    /**
     * @var string
     */

    protected $table = 'warehouses';

    public $translationModel = WarehouseTranslations::class;

    public $translatedAttributes = ['name','description', 'address'];
    /**
     * @var array
     */
    protected $guarded = ['id'];

    public function items()
    {
        return $this->belongsToMany(Items::class, 'filter_items', 'filter_id', 'item_id');
    }

    public function appItems()
    {
        return $this->belongsToMany(Items::class, 'app_items', 'warehouse_id', 'item_id');
    }

    public function categories()
    {
        return $this->hasMany(WarehouseRacks::class,'warehouse_id');
    }

    public function default_rack()
    {
        return $this->categories()->where('is_default',1)->first();
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\App\Orders::class,'shop_id');
    }

    public function staff()
    {
        return $this->belongsToMany(User::class,'app_staff','warehouses_id','users_id');
    }



}
