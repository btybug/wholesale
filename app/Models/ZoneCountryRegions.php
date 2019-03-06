<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/29/2018
 * Time: 3:14 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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