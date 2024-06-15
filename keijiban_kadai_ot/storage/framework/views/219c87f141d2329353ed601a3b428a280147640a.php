<h1>新規投稿画面</h1>
<select class="w-100" form="postCreate" name="post_category_id">
  <?php $__currentLoopData = $main_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <optgroup label="<?php echo e($main_category->main_category); ?>"></optgroup>
  <!-- サブカテゴリー表示 -->
  <!-- ▼追加 -->
  <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($sub_category->id); ?>" label="<?php echo e($sub_category->sub_category); ?>" name="sub_category_id"></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<div>
  <p class="mb-0">タイトル</p>
  <input type="text" class="w-100" form="postCreate" name="post_title" value="<?php echo e(old('post_title')); ?>">
</div>
<div>
  <p class="mb-0">投稿内容</p>
  <textarea class="w-100" form="postCreate" name="post_body"><?php echo e(old('post_body')); ?></textarea>
</div>
<div class="mt-3 text-right">
  <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
</div>
<form action="<?php echo e(route('post.create')); ?>" method="post" id="postCreate"><?php echo e(csrf_field()); ?></form>
<?php /**PATH C:\Users\Teppei\keijiban_kadai\keijiban_kadai_ot\resources\views/bulletinboard/post_create.blade.php ENDPATH**/ ?>