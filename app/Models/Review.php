<?php

namespace App\Models;


use App\Enums\ReviewStatusTypes;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $guarded=['id'];

    public function item()
    {
        return $this->hasOne(Items::class,'id','item_id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public static function updateOrCreate(int $id = null, array $data)
    {
        $model = self::find($id)??new static();
        if(isset($model->id)) {
            $data['status'] = ReviewStatusTypes::RESUBMITTED;
            $model->update($data);
        } else{
            $data['status'] = ReviewStatusTypes::SUBMITTED;
            $model->fill($data);
        }

        $model->save();
        return $model;
    }
}
