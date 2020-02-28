<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 8:52 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryCosts
 *
 * @property int $id
 * @property int $min
 * @property int $max
 * @property int $geo_zone_id
 * @property int $delivery_cost_types_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GeoZones $geoZone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliveryCostOptions[] $options
 * @property-read int|null $options_count
 * @property-read \App\Models\DeliveryCostsTypes $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts whereDeliveryCostTypesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts whereGeoZoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCosts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeliveryCosts extends Model
{
    /**
     * @var string
     */
    protected $table = 'delivery_costs';
    /**
     * @var array
     */
    protected $fillable = ['max', 'min', 'geo_zone_id', 'delivery_cost_types_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function geoZone()
    {
        return $this->belongsTo(GeoZones::class, 'geo_zone_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(DeliveryCostsTypes::class, 'delivery_cost_types_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(DeliveryCostOptions::class, 'delivery_cost_id');
    }
}