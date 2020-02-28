<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/20/2018
 * Time: 8:53 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryCostsTypes
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostsTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostsTypes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostsTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostsTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostsTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostsTypes whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeliveryCostsTypes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeliveryCostsTypes extends Model
{
    protected $table = 'delivery_cost_types';
    protected $fillable = ['title'];
}