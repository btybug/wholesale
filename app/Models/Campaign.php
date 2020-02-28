<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Campaign
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $sql_query
 * @property string $model
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereSqlQuery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $guarded = ['id'];
}