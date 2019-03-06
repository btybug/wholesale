<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/29/2018
 * Time: 3:14 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ZoneCountries extends Model
{
    /**
     * @var string
     */
    protected $table = 'zone_countries';
    /**
     * @var array
     */
    protected $fillable = ['name', 'all', 'geo_zone_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function geoZone()
    {
        return $this->belongsTo(GeoZones::class, 'geo_zone_id');
    }

    public function regions()
    {
        return $this->hasMany(ZoneCountryRegions::class,'zone_country_id');
    }
}