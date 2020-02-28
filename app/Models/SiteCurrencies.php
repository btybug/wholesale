<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SiteCurrencies
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $symbol
 * @property float $rate
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteCurrencies whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SiteCurrencies extends Model
{
    protected $table = 'site_currencies';

    protected $guarded = ['id'];
}