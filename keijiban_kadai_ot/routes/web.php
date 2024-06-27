<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'Auth\login\LoginController@loginView')->name('loginView');
Route::post('/login', 'Auth\login\LoginController@login')->name('loginView');

Route::get('/register', 'Auth\Register\RegisterController@register');
Route::post('/register/post', 'Auth\Register\RegisterController@register')->name('registerPost');

Route::get('/added', 'Auth\Register\RegisterController@added');

//=====================================

//ログイン中のページ
//ミドルウェア ログインしてない場合、エラー画面にする。
Route::group(['middleware' => 'auth'], function() {

    //トップページに遷移
    Route::get('/top','User\Post\PostsController@show')->name('post.show');

    Route::get('/bulletin_board/posts/{keyword?}', 'User\Post\PostsController@show')->name('post.show');

    Route::get('/bulletin_board/posts/{category_word?}', 'User\Post\PostsController@show')->name('post.show');
    //カテゴリーの追加画面に遷移
    Route::get('/top/categoryInput', 'User\Post\PostsController@categoryInput')->name('category.input');
    //メインカテゴリーの登録
    Route::post('/create/main_category', 'User\Post\PostsController@mainCategoryCreate')->name('main.category.create');
    //サブカテゴリーの登録
    Route::post('/create/sub_category', 'User\Post\PostsController@subCategoryCreate')->name('sub.category.create');
    //投稿の画面に遷移
    Route::get('/top/postInput', 'User\Post\PostsController@postInput')->name('post.input');
    //投稿の内容の追加
    Route::post('top/postInput/create', 'User\Post\PostsController@postCreate')->name('post.create');
    //投稿の詳細画面に遷移
    Route::get('/bulletin_board/post/{id}', 'User\Post\PostsController@postDetail')->name('post.detail');
    //詳細画面のコメントを投稿
    Route::post('/comment/create', 'User\Post\PostsController@commentCreate')->name('comment.create');
    //投稿の詳細画面のコメント編集に遷移
    Route::post('/bulletin_board/post/CommentEdit/{id}', 'User\Post\PostsController@commentEditShow')->name('comment.edit');
    //投稿の編集画面に遷移
    Route::post('/bulletin_board/post/edit/{id}', 'User\Post\PostsController@postEditShow')->name('post.edit.show');

    Route::post('/like/post/{id}', 'User\Post\PostsController@postLike')->name('post.like');

    Route::post('/unlike/post/{id}', 'User\Post\PostsController@postUnLike')->name('post.unlike');
});
