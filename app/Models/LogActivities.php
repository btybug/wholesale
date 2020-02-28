<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/27/2018
 * Time: 9:30 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LogActivities
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $subject
 * @property string $url
 * @property string $method
 * @property string $ip
 * @property string|null $iso_code
 * @property string|null $country
 * @property string|null $city
 * @property string|null $state
 * @property string|null $state_name
 * @property string|null $postal_code
 * @property string|null $lat
 * @property string|null $lon
 * @property string|null $timezone
 * @property string|null $continent
 * @property string|null $currency
 * @property string|null $agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereContinent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereStateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LogActivities whereUserId($value)
 * @mixin \Eloquent
 */
class LogActivities extends Model
{
    protected $table = 'log_activities';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}