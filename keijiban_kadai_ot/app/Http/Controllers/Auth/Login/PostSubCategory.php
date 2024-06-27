<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\Post;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

    public function post(){
        return $this->belongsTo('App\Models\Posts\Post', 'post_id', 'id');
    }

    public function mainCategory(){
        return $this->hasMany('App\Models\Posts\PostMainCategory');
    }
}
