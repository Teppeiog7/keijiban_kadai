<h1>投稿編集画面</h1>
<p class="" style="margin-top:20px">サブカテゴリー</p>
<select name="sub_category" form="subCategoryRequest">

  @foreach($sub_categories as $sub_category)
  <option value="{{ $sub_category->id }}" label="{{ $sub_category->sub_category }}"></option>
  @endforeach
</select>
<!-- <input type="text" class="w-100" name="sub_category_name" form="subCategoryRequest"> -->
<div class="w-100">
  <div class="modal-inner-title w-50 m-auto">
    <input type="text" name="title" placeholder="タイトル" class="w-100" value="{{ $post_title }}" form="subCategoryRequest">
  </div>
  <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
    <textarea placeholder="投稿内容" name="post_body" class="w-100" value="{{ $post_body }}" form="subCategoryRequest">{{ $post_body }}</textarea>
  </div>
  <div class="w-50 m-auto edit-modal-btn d-flex">
    <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
    <input type="submit" class="btn btn-primary d-block" value="編集">
  </div>
</div>
