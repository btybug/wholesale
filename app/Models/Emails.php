<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/8/2018
 * Time: 4:30 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Emails
 *
 * @property int $id
 * @property string $email
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Emails whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Emails extends Model
{
    protected $table = 'emails';
    protected $guarded = ['id'];
}