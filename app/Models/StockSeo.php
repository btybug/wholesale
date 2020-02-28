<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/6/2018
 * Time: 8:35 PM
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\StockSeoTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StockSeo
 *
 * @property int $id
 * @property int $stock_id
 * @property string $name
 * @property string $type
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StockSeo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockSeo extends Translatable
{
    protected $table = 'stock_seo';
    public $translatedAttributes = ['keyword', 'title', 'description','fb_title','fb_description','twitter_title','twitter_description'];

    protected $guarded = ['id'];

    public $translationModel = StockSeoTranslations::class;
}
