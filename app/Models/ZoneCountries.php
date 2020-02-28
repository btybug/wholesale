<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/29/2018
 * Time: 3:14 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ZoneCountries
 *
 * @property int $id
 * @property string $name
 * @property int $all
 * @property int $geo_zone_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GeoZones $geoZone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ZoneCountryRegions[] $regions
 * @property-read int|null $regions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries whereAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries whereGeoZoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountries whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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