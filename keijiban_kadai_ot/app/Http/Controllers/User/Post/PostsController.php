<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Users\User;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\PostFavorite;
use Auth;


class PostsController extends Controller
{

    //==============================

    public function show(Request $request){
        //dd($request);
        $posts = Post::with('user','postComments' , 'viewers')->get();
        //dd($posts);
        $main_categories = PostMainCategory::get();
        //dd($categories);
        $sub_categories = PostSubCategory::get();
        //dd($sub_categories);
        $post_comment = new Post;
        $like = new PostFavorite;

        if(!empty($request->keyword)){
            //$keyword = $request->keyword;
            //dd($keyword);
            //$postSubCategory = PostSubCategory::where('sub_category', 'like', '%' . $request->keyword . '%')->pluck('sub_category');
            //dd($postSubCategory);
             $posts = Post::with('user', 'postComments','postSubCategories')
             ->where('title', 'like', '%'.$request->keyword.'%')
             ->orWhere('post', 'like', '%'.$request->keyword.'%')
             ->orWhereHas('postSubCategories',function ($q) use ($request) {$q->where('sub_category', '=', $request->keyword);})->get();
            //dd($posts);
        }else if($request->sub_category_word){
            $posts = Post::with('user','postComments','postSubCategories')
            ->whereHas('postSubCategories',function ($q) use ($request) {$q->where('sub_category', '=', $request->sub_category_word);})->get();
            //dd($posts);
        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('post_id');//likeした投稿のIDを抽出
            //dd($likes);
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
            // dd($posts);
        }
        return view('posts.index', compact('posts', 'main_categories','sub_categories', 'post_comment','like'));
    }

    //==============================

    public function index(){
        $posts = Post::with('user','subCategories')->get();
        //dd($posts);
        $main_categories = PostMainCategory::get();
        //($main_categories);
        $sub_categories = PostSubCategory::get();
        //dd($sub_categories);
        return view('posts.index', compact('posts','main_categories','sub_categories'));
    }

    //==============================

    public function categoryInput(){
        $main_categories = PostMainCategory::get();
        //dd($main_categories);
        $sub_categories = PostSubCategory::get();
        //dd($sub_categories);
        return view('bulletinboard.category_create', compact('main_categories','sub_categories'));
    }

    //==============================

    public function mainCategoryCreate(Request $request){
        PostMainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('category.input');
    }

    //==============================

    public function subCategoryCreate(Request $request){
        PostSubCategory::create([
            'post_main_category_id' =>$request->input('main_category'),
            'sub_category' => $request->sub_category_name,
        ]);
        return redirect()->route('category.input');
     }

    //==============================

    public function postInput(){
        $main_categories = PostMainCategory::get();
        //dd($main_categories);
        $sub_categories = PostSubCategory::get();
        //dd($sub_categories);
        return view('bulletinboard.post_create', compact('main_categories','sub_categories'));
    }

    //==============================

       public function postCreate(Request $request){
          //dd($request);
          Post::create([
              'user_id' => Auth::id(),
              'post_sub_category_id' => $request->post_category_id,
              'title' => $request->post_title,
              'post' => $request->post_body,
              'event_at' => now(),
              'created_at' => now(),
          ]);
          return redirect()->route('post.show');
      }

    //==============================

    public function postDetail($post_id){
        //dd($post_id);
        $post = Post::with('user','postComments')->findOrFail($post_id);
        //dd($post);
        $actionLog = new ActionLog();
        $userId = Auth::id();
        // event_atを設定して保存
        $actionLog->user_id = $userId;
        $actionLog->post_id = $post_id;
        $actionLog->event_at = now();
        $actionLog->save();

        return view('bulletinboard.post_detail', compact('post'));
    }

    //==============================

    public function commentCreate(Request $request){
        //dd($request);
        PostComment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'event_at' => now(),
        ]);
        // Auth::user()->actionLogs()->create([
        //     'user_id' => Auth::id(),
        //     'post_id' => $request->post_id,
        //     'comment' => $request->comment,
        //     'event_at' => now(),
        // ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    //==============================

    public function commentEditShow(Request $request){
        $comment_id = $request->input('comment_id');
        //dd($comment_id);
        $comment = PostComment::find($comment_id);
        // dd($comment);
        $commentContent = $comment->comment;
        // dd($commentContent);
         return view('bulletinboard.post_comment_edit', compact(''));
    }

    //==============================

    public function postEditShow(Request $request){
        $user_id = $request->input('user_id');
        //dd($user_id);
        $sub_categories = PostSubCategory::get();
        // $posts = Post::with('subCategories')->get();
        // $sub_category= Post::with('subCategories')->whereIn('user_id',$user_id)->get();
        $post_title = $request->input('post_title');
        $post_body = $request->input('post_body');
        //dd($post_id,$sub_categories,$post_title,$post_body);
        // dd($sub_category);
        //dd($posts);
        return view('bulletinboard.post_edit', compact('user_id','sub_categories','post_title','post_body'));
    }

    //==============================

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new PostFavorite;

        $like->user_id = $user_id;
        $like->post_id = $post_id;
        $like->save();

        return response()->json();
    }

    //==============================

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new PostFavorite;

        $like->where('user_id', $user_id)
             ->where('post_id', $post_id)
             ->delete();

        return response()->json();
    }

    //==============================
}
