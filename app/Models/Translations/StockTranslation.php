<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\StockTranslation
 *
 * @property int $id
 * @property int $stock_id
 * @property string $locale
 * @property string $name
 * @property string $slug
 * @property string|null $short_description
 * @property string|null $long_description
 * @property string|null $what_is_content
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StockTranslation whereWhatIsContent($value)
 * @mixin \Eloquent
 */
class StockTranslation extends Model
{
    protected $table = 'stock_translations';
    public $timestamps = false;
    protected $fillable = ['name','slug','short_description','long_description','what_is_content'];
}
