<?php
namespace App\Models\Translations;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations\FiltersTranslation
 *
 * @property int $id
 * @property string $name
 * @property string|null $first_child_label
 * @property int $filters_id
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FiltersTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FiltersTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FiltersTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FiltersTranslation whereFiltersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FiltersTranslation whereFirstChildLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FiltersTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FiltersTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\FiltersTranslation whereName($value)
 * @mixin \Eloquent
 */
class FiltersTranslation extends Model
{
    protected $table = 'filters_translations';
    public $timestamps = false;
    protected $fillable = ['name','first_child_label'];
}
