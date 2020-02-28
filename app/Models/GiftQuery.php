<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/24/2018
 * Time: 11:07 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GiftQuery
 *
 * @property int $id
 * @property int $gift_id
 * @property string $column
 * @property string $condition
 * @property string $needle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Gifts $gift
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery whereColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery whereGiftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery whereNeedle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GiftQuery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GiftQuery extends Model
{
    protected $table = 'gift_query';
    protected $fillable = ['gift_id','column', 'condition', 'needle'];

    public function gift()
    {
        return $this->belongsTo(Gifts::class,'gift_id');
    }
}