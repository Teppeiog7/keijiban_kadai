<h1>新規投稿画面</h1>
<select class="w-100" form="postCreate" name="post_category_id">
  @foreach($main_categories as $main_category)
  <optgroup label="{{ $main_category->main_category }}"></optgroup>
  <!-- サブカテゴリー表示 -->
  <!-- ▼追加 -->
  @foreach($sub_categories as $sub_category)
  <option value="{{ $sub_category->id }}" label="{{ $sub_category->sub_category }}" name="sub_category_id"></option>
  @endforeach
  @endforeach
</select>
<div>
  <p class="mb-0">タイトル</p>
  <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
</div>
<div>
  <p class="mb-0">投稿内容</p>
  <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
</div>
<div class="mt-3 text-right">
  <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
</div>
<form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
