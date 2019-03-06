<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 8:52 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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