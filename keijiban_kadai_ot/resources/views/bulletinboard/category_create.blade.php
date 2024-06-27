<h1>カテゴリー追加画面</h1>
@error('main_category_name')
<p style="color:red; font-weight:bold;">{{ $message }}</p> <!-- エラーメッセージを表示 -->
@enderror
<p class="" style="margin-top:20px">新規メインカテゴリー</p>
<input type="text" class="w-100" name="main_category_name" form="mainCategoryRequest">
<input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryRequest">
<form action="{{ route('main.category.create') }}" method="post" id="mainCategoryRequest">{{ csrf_field() }}</form>

<p class="" style="margin-top:20px">メインカテゴリー</p>
<select name="main_category" form="subCategoryRequest">
  @foreach($main_categories as $main_category)
  <option value="{{ $main_category->id }}" label="{{ $main_category->main_category }}"></option>
  @endforeach
</select>
<p class="" style="margin-top:20px">新規サブカテゴリー</p>
<input type="text" class="w-100" name="sub_category_name" form="subCategoryRequest">
<input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="subCategoryRequest">
<form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">{{ csrf_field() }}</form>

<p class="" style="margin-top:20px">カテゴリー一覧</p>
@foreach($main_categories as $main_category)
<p>{{$main_category->main_category}}</p>
@foreach($sub_categories as $sub_category)
@if($sub_category->post_main_category_id === $main_category->id)
<p>{{ $sub_category->sub_category }}</p>
@endif
@endforeach
@endforeach
