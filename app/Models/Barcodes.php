<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Barcodes
 *
 * @property int $id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Items $item
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Barcodes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Barcodes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Barcodes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Barcodes whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Barcodes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Barcodes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Barcodes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Barcodes extends Model
{
    protected $table = 'barcodes';
    protected $fillable=['code'];

    public function item()
    {
        return $this->hasOne(Items::class,'barcode_id');
    }
}
