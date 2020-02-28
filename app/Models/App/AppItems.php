<?php


namespace App\Models\App;


use App\Models\Category;
use App\Models\Items;
use Illuminate\Database\Eloquent\Model;

class AppItems extends Model
{
    protected $table = 'app_items';

    protected $guarded=['id'];

    public function item()
    {
        return $this->belongsTo(Items::class,'item_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_categories', 'item_id', 'categories_id','item_id')
            ->where('categories.type', 'stocks');
    }
}
