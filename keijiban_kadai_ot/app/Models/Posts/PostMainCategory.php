<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostMainCategory extends Model
{
    protected $table = 'post_main_categories';

    protected $fillable = [
        'main_category',
    ];

    public function mainCategories(){
         // リレーションの定義　1つだけ
         return $this->belongsTo('App\Models\Posts\PostSubCategory');
    }
}
