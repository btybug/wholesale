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
 * App\Models\ZoneCountryRegions
 *
 * @property int $id
 * @property string $name
 * @property int $zone_country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ZoneCountries $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountryRegions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountryRegions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountryRegions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountryRegions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountryRegions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountryRegions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountryRegions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ZoneCountryRegions whereZoneCountryId($value)
 * @mixin \Eloquent
 */
class ZoneCountryRegions extends Model
{
    /**
     * @var string
     */
    protected $table = 'zone_country_regions';
    /**
     * @var array
     */
    protected $fillable = ['name', 'zone_country_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(ZoneCountries::class, 'zone_country_id');
    }
}