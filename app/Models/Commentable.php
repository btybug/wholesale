<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/16/2018
 * Time: 10:03 PM
 */

namespace App\Models;


use App\User;

trait Commentable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return bool
     */
    public function getCanBeRated()
    {
        return (isset($this->canBeRated)) ? $this->canBeRated : false;
    }

    /**
     * @return bool
     */
    public function mustBeApproved()
    {
        return (isset($this->mustBeApproved)) ? $this->mustBeApproved : false;
    }

    /**
     * @return mixed
     */
    public function totalCommentCount()
    {
        return ($this->mustBeApproved()) ? $this->comments()->where('approved', true)->count() : $this->comments()->count();
    }

    /**
     * @return float
     */
    public function averageRate()
    {
        return ($this->getCanBeRated()) ? $this->comments()->where('approved', true)->avg('rate') : 0;
    }

    public function makeReady()
    {
        $data=[];
        foreach ($this->comments as $comment){
            $data[]=$comment->treeArray();
        }
        return collect($this->recursive($data));
    }

    private function recursive($data, $i = 0, $result = [])
    {
        if (isset($data[$i]) && count($data[$i])) {
            $user=User::find($data[$i]['commented_id']);
            $result[]= [
                "id" => $data[$i]['id'],
                "parent" => ($data[$i]['commentable_type'] == self::class)?null:$data[$i]['commentable_id'],
                "created" => $data[$i]['created_at'],
                "modified" => $data[$i]['updated_at'],
                "content" => $data[$i]['comment'],
                "pings" => [],
                "creator" => $user->id,
                "fullname" => $user->name.' '.$user->last_name,
                "profile_picture_url" => url('public/images/'.$user->gender.'.png'),
                "created_by_admin" => false,
                "created_by_current_user" => false,
                "upvote_count" => 3,
                "user_has_upvoted" => false,
                "is_new" => false
            ];

            if(isset($data[$i]['comment_tree']) && count($data[$i]['comment_tree'])){
                $result=  $this->recursive($data[$i]['comment_tree'],0,$result);
            }
            $i++;
            $result= $this->recursive($data,$i,$result);
        }
        return $result;
    }

}