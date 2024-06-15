<h1>掲示板詳細画面</h1>
<span><?php echo e($post->user->username); ?></span>
<div class="" name="post_title" value="<?php echo e($post->title); ?>" form="editRequest"><?php echo e($post->title); ?></div>
<div class="" name="post_body" value="<?php echo e($post->post); ?>" form="editRequest"><?php echo e($post->post); ?></div>
<?php if(Auth::user()->id === $post->user->id): ?>
<input type="submit" value="編集" form="editRequest">
<input type="hidden" name="post_id" value="<?php echo e($post->user_id); ?>" form="editRequest">
<input type="hidden" name="post_title" value="<?php echo e($post->title); ?>" form="editRequest">
<input type="hidden" name="post_body" value="<?php echo e($post->post); ?>" form="editRequest">
<form action="<?php echo e(route('post.edit.show', ['id' => $post->id])); ?>" method="post" id="editRequest"><?php echo e(csrf_field()); ?></form>
<?php endif; ?>
<p>===============================</p>
<div class="comment_container">
  <span class="">コメント</span>
  <?php $__currentLoopData = $post->postComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="comment_area border-top">
    <p><span><?php echo e($comment->commentUser($comment->user_id)->username); ?></span></p>
    <p><?php echo e($comment->comment); ?></p>
    <?php if(Auth::user()->id === $comment->user_id): ?>
    <input type="submit" value="編集" form="commentEditRequest">
    <form action="<?php echo e(route('comment.edit', ['id' => $comment->user_id])); ?>" method="post" id="commentEditRequest" name="comment_id" value="<?php echo e($comment->user_id); ?>"><?php echo e(csrf_field()); ?></form>
    <?php endif; ?>
  </div>
  <p>■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□</p>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<p class="m-0">コメントする</p>
<textarea class="w-100" name="comment" form="commentRequest"></textarea>
<input type="hidden" name="post_id" form="commentRequest" value="<?php echo e($post->id); ?>">
<input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
<form action="<?php echo e(route('comment.create')); ?>" method="post" id="commentRequest"><?php echo e(csrf_field()); ?></form>
<?php /**PATH C:\Users\Teppei\keijiban_kadai\keijiban_kadai_ot\resources\views/bulletinboard/post_detail.blade.php ENDPATH**/ ?>