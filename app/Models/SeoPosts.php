<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/6/2018
 * Time: 8:35 PM
 */

namespace App\Models;


use App\Models\Common\Translatable;
use App\Models\Translations\PostsSeoTranslations;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SeoPosts
 *
 * @property int $id
 * @property int $post_id
 * @property string $name
 * @property string $type
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoPosts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SeoPosts extends Translatable
{
    protected $table = 'post_seo';
    public $translatedAttributes = ['keyword', 'title', 'description','image','fb_title','fb_description','fb_image','twitter_title','twitter_description','twitter_image'];

    protected $guarded = ['id'];

    public $translationModel = PostsSeoTranslations::class;
}
