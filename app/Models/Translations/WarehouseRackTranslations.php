<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\WarehouseRackTranslations
 *
 * @property int $id
 * @property int $warehouse_racks_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseRackTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseRackTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseRackTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseRackTranslations whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseRackTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseRackTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseRackTranslations whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\WarehouseRackTranslations whereWarehouseRacksId($value)
 * @mixin \Eloquent
 */
class WarehouseRackTranslations extends Model
{
    protected $table = 'warehouse_rack_translations';
    public $timestamps = false;
    protected $fillable = ['name','description'];
}
