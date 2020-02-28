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
 * App\Models\Dashboard
 *
 * @property int $id
 * @property int $user_id
 * @property string $placeholder
 * @property int $position
 * @property string $widget
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard wherePlaceholder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dashboard whereWidget($value)
 * @mixin \Eloquent
 */
class Dashboard extends Model
{
    protected $table = 'dashboard';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}