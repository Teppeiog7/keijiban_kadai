<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class PostComment extends Model
{
    protected $table = 'post_comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];

    public function post(){
        return $this->belongsTo('App\Models\Posts\Post');
    }

    public function commentUser($user_id){
        return User::where('id', $user_id)->first();
    }
}
