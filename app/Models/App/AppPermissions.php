<?php


namespace App\Models\App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\App\AppPermissions
 *
 * @property int $id
 * @property string $slug
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\AppPermissions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AppPermissions extends Model
{
    protected $table = 'app_permissions';

    protected $guarded=['id'];
}
