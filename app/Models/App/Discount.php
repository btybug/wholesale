<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\App\Discount
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App\Discount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
    protected $table='discounts';
    protected $guarded = ['id'];

}
