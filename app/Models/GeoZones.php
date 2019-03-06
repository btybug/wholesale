<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 8:49 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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