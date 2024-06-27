<h1>コメント編集画面</h1>
<div class="w-100">
  <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
    <textarea placeholder="投稿内容" name="post_body" class="w-100" value="{{ $comment_body }}" form="">{{ $comment_body }}</textarea>
  </div>
  <div class="w-50 m-auto edit-modal-btn d-flex">
    <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
    <input type="submit" class="btn btn-primary d-block" value="編集">
  </div>
</div>
