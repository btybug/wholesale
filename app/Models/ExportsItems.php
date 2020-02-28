<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExportsItems
 *
 * @property int $id
 * @property int $item_id
 * @property int $qty
 * @property int $export_id
 * @property int $status
 * @property float $price
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exports $import
 * @property-read \App\Models\Items $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems whereExportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExportsItems whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExportsItems extends Model
{
    protected $table='export_items';
    protected $fillable = ['item_id','qty','export_id','status','price','note'];

    public function import()
    {
        return $this->belongsTo(Exports::class,'export_id');
    }
    public function parent()
    {
        return $this->belongsTo(Items::class,'item_id');
    }



}
