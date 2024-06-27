<h1>カテゴリー追加画面</h1>
<?php $__errorArgs = ['main_category_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<p style="color:red; font-weight:bold;"><?php echo e($message); ?></p> <!-- エラーメッセージを表示 -->
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<p class="" style="margin-top:20px">新規メインカテゴリー</p>
<input type="text" class="w-100" name="main_category_name" form="mainCategoryRequest">
<input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryRequest">
<form action="<?php echo e(route('main.category.create')); ?>" method="post" id="mainCategoryRequest"><?php echo e(csrf_field()); ?></form>

<p class="" style="margin-top:20px">メインカテゴリー</p>
<select name="main_category" form="subCategoryRequest">
  <?php $__currentLoopData = $main_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($main_category->id); ?>" label="<?php echo e($main_category->main_category); ?>"></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<p class="" style="margin-top:20px">新規サブカテゴリー</p>
<input type="text" class="w-100" name="sub_category_name" form="subCategoryRequest">
<input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="subCategoryRequest">
<form action="<?php echo e(route('sub.category.create')); ?>" method="post" id="subCategoryRequest"><?php echo e(csrf_field()); ?></form>

<p class="" style="margin-top:20px">カテゴリー一覧</p>
<?php $__currentLoopData = $main_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<p><?php echo e($main_category->main_category); ?></p>
<?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($sub_category->post_main_category_id === $main_category->id): ?>
<p><?php echo e($sub_category->sub_category); ?></p>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\Users\Teppei\keijiban_kadai\keijiban_kadai_ot\resources\views/bulletinboard/category_create.blade.php ENDPATH**/ ?>