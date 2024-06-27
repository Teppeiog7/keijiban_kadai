<h1>掲示板詳細画面</h1>
<span>{{ $post->user->username }}</span>
<div class="" name="post_title" value="{{ $post->title }}" form="editRequest">{{ $post->title }}</div>
<div class="" name="post_body" value="{{ $post->post }}" form="editRequest">{{ $post->post }}</div>
@if(Auth::user()->id === $post->user->id)
<input type="submit" value="編集" form="editRequest">
<input type="hidden" name="post_id" value="{{ $post->user_id }}" form="editRequest">
<input type="hidden" name="post_title" value="{{ $post->title }}" form="editRequest">
<input type="hidden" name="post_body" value="{{ $post->post }}" form="editRequest">
<form action="{{ route('post.edit.show', ['id' => $post->id]) }}" method="post" id="editRequest">{{ csrf_field() }}</form>
@endif
<p>===============================</p>
<div class="comment_container">
  <span class="">コメント</span>
  @foreach($post->postComments as $comment)
  <div class="comment_area border-top">
    <p><span>{{ $comment->commentUser($comment->user_id)->username }}</span></p>
    <p>{{ $comment->comment }}</p>
    @if(Auth::user()->id === $comment->user_id)
    <input type="submit" value="編集" form="commentEditRequest">
    <form action="{{ route('comment.edit', ['id' => $comment->user_id]) }}" method="post" id="commentEditRequest" name="comment_id" value="{{ $comment->user_id }}">{{ csrf_field() }}</form>
    @endif
  </div>
  <p>■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□</p>
  @endforeach
</div>
<p class="m-0">コメントする</p>
<textarea class="w-100" name="comment" form="commentRequest"></textarea>
<input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
<input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
<form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
