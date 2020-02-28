<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/27/2018
 * Time: 9:19 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Suppliers
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $company
 * @property string $email
 * @property string|null $fax
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Purchase[] $purchases
 * @property-read int|null $purchases_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suppliers whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Suppliers extends Model
{
    protected $table = 'suppliers';
    protected $guarded = ['id'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'supplier_id');
    }
}