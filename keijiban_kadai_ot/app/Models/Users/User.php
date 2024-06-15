<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostFavorite;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];


    public function postSubCategories(){
         return $this->hasMany('App\Models\Posts\PostSubCategory');
     }

    public function posts(){
        // リレーションの定義(多対多)
        //第一引数：相手のモデル
        //第二引数：中間テーブルを記載
        //第三引数：自分の外部キー
        //第四引数：相手の外部キー
        return $this->belongsToMany('App\Models\Posts\Post','action_logs','user_id','post_id');
    }

    // いいねしているかどうか
    public function is_Like($post_id){
        return PostFavorite::where('user_id', Auth::id())->where('post_id', $post_id)->first(['Post_favorites.id']);
    }

    public function likedPosts()
    {
        return $this->belongsToMany('App\Models\Posts\Post', 'Post_Favorite', 'user_id', 'post_id')->withTimestamps();
    }

    public function likePostId(){
        return PostFavorite::where('user_id', Auth::id());
    }
}