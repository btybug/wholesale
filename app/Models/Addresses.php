<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Addresses
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $company
 * @property string|null $type
 * @property string $first_line_address
 * @property string $second_line_address
 * @property string $city
 * @property string $country
 * @property string $region
 * @property string $post_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereFirstLineAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses wherePostCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereSecondLineAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Addresses whereUserId($value)
 * @mixin \Eloquent
 */
class Addresses extends Model
{
    /**
     * @var string
     */
    protected $table = 'addresses';
    /**
     * @var array
     */
    protected $fillable = [
        'user_id','first_name','last_name','company','type', 'first_line_address', 'second_line_address', 'city', 'country','region', 'post_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCountry()
    {
        return $this->hasOne(ZoneCountries::class, 'id','country');
    }

    public function getRegion()
    {
        return $this->hasOne(ZoneCountryRegions::class, 'id','region');
    }
}