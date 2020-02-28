<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Languages
 *
 * @property int $id
 * @property string $name
 * @property string $native
 * @property string $code
 * @property string $rtl
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages whereNative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages whereRtl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Languages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Languages extends Model
{
    protected $table = 'languages';
    public $timestamps = false;

    protected $guarded = ['id'];
}