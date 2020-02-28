<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/2/2018
 * Time: 10:08 PM
 */

namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\StatusesTranslations
 *
 * @property int $id
 * @property int $statuses_id
 * @property string $name
 * @property string $description
 * @property string $locale
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations whereStatusesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\StatusesTranslations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StatusesTranslations extends Model
{
    protected $table = 'statuses_translations';
    public $timestamps = false;
    protected $fillable = ['name','description'];
}