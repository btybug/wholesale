<?php

namespace App\Models;


use App\Models\Translations\AttributeTranslation;
use Illuminate\Database\Eloquent\Model;

class AttributeStickers extends Model
{
    /**
     * @var string
     */
    protected $table = 'attributes_stickers';
    /**
     * @var array
     */
    protected $guarded = ['id'];

    public function attr()
    {
        return $this->belongsTo(Attributes::class, 'attributes_id');
    }

    public function sticker()
    {
        return $this->belongsTo(Stickers::class, 'sticker_id');
    }
}