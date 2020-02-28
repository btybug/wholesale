<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/22/2018
 * Time: 5:14 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Currencies
 *
 * @property int $id
 * @property string $name
 * @property string $currency
 * @property string $symbol
 * @property string $format
 * @property float $rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currencies whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currencies extends Model
{
    protected $table = 'currencies';
    protected $guarded = ['id'];
}