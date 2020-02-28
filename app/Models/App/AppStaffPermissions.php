<?php


namespace App\Models\App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\App\AppStaffPermissions
 *
 * @property int $id
 * @property int $user_id
 * @property int $permission_id
 * @property int $warehouse_id
 * @property string|null $deadline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppStaffPermissions whereWarehouseId($value)
 * @mixin \Eloquent
 */
class AppStaffPermissions extends Model
{
    protected $table = 'app_staff_permissions';

    protected $guarded=['id'];


}
