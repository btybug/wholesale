<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\WarehouseTranslations
 *
 * @property int $id
 * @property int $warehouse_id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseTranslations whereWarehouseId($value)
 * @mixin \Eloquent
 */
class WarehouseTranslations extends Model
{
    protected $table = 'warehouse_translations';
    public $timestamps = false;
    protected $fillable = ['name','description', 'address'];
}
