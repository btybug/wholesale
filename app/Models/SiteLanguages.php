<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SiteLanguages
 *
 * @property int $id
 * @property string $name
 * @property string|null $original_name
 * @property string $code
 * @property string $direction
 * @property int $default
 * @property int $shared
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereShared($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SiteLanguages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SiteLanguages extends Model
{
    protected $table = 'site_languages';
    public $timestamps = false;

    protected $guarded = ['id'];

    public function getTranslations(){

        if(! \File::exists("resources/lang/$this->code.json")){
            \File::put("resources/lang/$this->code.json",json_encode([]));
        }

        $data = json_decode( \File::get("resources/lang/$this->code.json"),true);
        return $data;
    }
}