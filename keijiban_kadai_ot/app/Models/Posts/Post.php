<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

use App\Models\Posts\PostSubCategory;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

     public function postSubCategories(){
         return $this->belongsTo('App\Models\Posts\PostSubCategory', 'post_sub_category_id', 'id');
     }

    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function viewers(){
        // リレーションの定義(多対多)
        //第一引数：相手のモデル
        //第二引数：中間テーブルを記載
        //第三引数：自分の外部キー
        //第四引数：相手の外部キー
        return $this->belongsToMany('App\Models\Users\User','action_logs','post_id','user_id');
    }

    // public function likedByUsers()
    // {
    //     return $this->belongsToMany('App\Models\Users\User', 'Post_Favorite', 'post_id', 'user_id')->withTimestamps();
    // }
}
