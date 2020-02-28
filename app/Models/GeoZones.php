<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 8:49 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GeoZones
 *
 * @property int $id
 * @property int|null $tax_rate_id
 * @property string $name
 * @property string $description
 * @property array $payment_options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ZoneCountries[] $countries
 * @property-read int|null $countries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliveryCosts[] $deliveries
 * @property-read int|null $deliveries_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones wherePaymentOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones whereTaxRateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GeoZones whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GeoZones extends Model
{
    protected $table = 'geo_zones';

    protected $fillable = ['tax_rate_id','name', 'description', 'payment_options'];

    protected $casts = [
      'payment_options' => 'json'
    ];

    public function deliveries()
    {
        return $this->hasMany(DeliveryCosts::class,'geo_zone_id');
    }

    public function countries()
    {
        return $this->hasMany(ZoneCountries::class,'geo_zone_id')->with('regions');
    }

}