<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $table = 'comments';

    protected $guarded = ['id'];

    public function scopeMain($query){
        return $query->whereNull('parent_id')->where('status', true)->orderBy('created_at','desc');
    }

    public function scopeMainAll($query){
        return $query->whereNull('parent_id')->orderBy('created_at','desc');
    }

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->where('status', true)->orderBy('created_at','desc');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childrenAll()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('created_at','desc');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}