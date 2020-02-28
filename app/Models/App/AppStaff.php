<?php


namespace App\Models\App;


use App\Models\Warehouse;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\App\AppStaff
 *
 * @property int $id
 * @property int $users_id
 * @property int $warehouses_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @property-read \App\Models\Warehouse $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaff query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaff whereUsersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaff whereWarehousesId($value)
 * @mixin \Eloquent
 */
class AppStaff extends Model
{
    protected $table = 'app_staff';

    protected $guarded=['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouses_id');
    }
}
