<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/15/2018
 * Time: 4:45 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Favorites
 *
 * @property int $id
 * @property int $user_id
 * @property int $stock_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @property-read \App\Models\StockVariation $variation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorites newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorites newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorites query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorites whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorites whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorites whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorites whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Favorites whereUserId($value)
 * @mixin \Eloquent
 */
class Favorites extends Model
{
    protected $table = 'favorites';
    protected $fillable = ['user_id', 'variation_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function variation()
    {
        return $this->belongsTo(StockVariation::class,'variation_id');
    }
}