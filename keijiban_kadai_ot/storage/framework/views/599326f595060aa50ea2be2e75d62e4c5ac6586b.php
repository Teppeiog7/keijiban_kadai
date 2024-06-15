<?php $__env->startSection('content'); ?>
<div class="post_view w-75">
  <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="" style="margin-top:2px;">
    <p><?php echo e($post->user->username); ?>さん</p>
    <p><?php echo e($post->event_at); ?></p>
    <p><a href="<?php echo e(route('post.detail', ['id' => $post->id])); ?>" class="post_title"><?php echo e($post->title); ?></a></p>
    <p>コメント数：<?php echo e($post->postComments->count()); ?></p>
    <p>閲覧数：<?php echo e($post->viewers->count()); ?></p>
    <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($sub_category->id == $post->post_sub_category_id): ?>
    <p><?php echo e($sub_category->sub_category); ?></p>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div>
      <?php if(Auth::user()->is_Like($post->id)): ?>
      <p class="m-0" style="color: #999;"><i class="fas fa-heart un_like_btn" post_id="<?php echo e($post->id); ?>"></i><span class="like_counts<?php echo e($post->id); ?>"><?php echo e($like->likeCounts($post->id)); ?></span></p>
      <?php else: ?>
      <p class="m-0" style="color: #999;"><i class="fas fa-heart like_btn" post_id="<?php echo e($post->id); ?>"></i><span class="like_counts<?php echo e($post->id); ?>"><?php echo e($like->likeCounts($post->id)); ?></span></p>
      <?php endif; ?>
    </div>

    <p>===============================</p>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <div class="container">
    <a href="<?php echo e(route('category.input')); ?>">カテゴリーを追加</a>
    <br>
    <a href="<?php echo e(route('post.input')); ?>">投稿</a>
  </div>

  <div class="search_container">
    <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
    <input type="submit" value="検索" form="postSearchRequest">
  </div>

  <ul>
    <li style="display:flex; margin-top: 20px;">
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <span class="category_btn"></span>
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
    </li>
    <!-- <li style="margin-top: 20px;">カテゴリー</li>
    <?php $__currentLoopData = $main_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="main_categories" category_id="<?php echo e($main_category->id); ?>">
      <span><?php echo e($main_category->main_category); ?><span>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
  </ul>

  <?php $__currentLoopData = $main_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <p class="main_categories" category_id="<?php echo e($main_category->id); ?>"><?php echo e($main_category->main_category); ?></p>
  <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php if($sub_category->post_main_category_id === $main_category->id): ?>
  <div class="category_num<?php echo e($sub_category->id); ?> sub_categories" style="display: none;">
    <a href="<?php echo e(route('post.show', ['sub_category_word' => $sub_category->sub_category])); ?>" name="sub_category_word" form="postSearchRequest"><?php echo e($sub_category->sub_category); ?></a>
  </div>
  <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php $__env->stopSection(); ?>

  <form action="<?php echo e(route('post.show')); ?>" method="get" id="postSearchRequest"></form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="<?php echo e(asset('js/bulletin.js')); ?>" rel="stylesheet"></script>
  <script>
  $(function() {
    $('.main_categories').click(function() {
      $(this).toggleClass('active');
      var category_id = $(this).attr('category_id');
      $('.category_num' + category_id).slideToggle();
      if ($(this).hasClass('active')) {
        $(this).next('.category_num' + category_id).slideDown();
      } else {
        //それ以外の場合、タグの内容がクローズする
        $(this).next('.category_num' + category_id).slideUp();
      }
      // var category_id = $(this).attr('category_id');
      // $('.category_num' + category_id).slideToggle();
    });
    $(document).on('click', '.like_btn', function(e) {
      e.preventDefault();
      $(this).addClass('un_like_btn');
      $(this).removeClass('like_btn');
      var post_id = $(this).attr('post_id'); //'post_id'の値を抽出している。
      var count = $('.like_counts' + post_id).text();
      var countInt = Number(count);
      //console.log('post_idの値:', post_id);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "post",
        url: "/like/post/" + post_id,
        data: {
          post_id: post_id,
        },
      }).done(function(res) {
        console.log(res);
        $('.like_counts' + post_id).text(countInt + 1);
      }).fail(function(res) {
        console.log('fail');
      });
    });

    $(document).on('click', '.un_like_btn', function(e) {
      e.preventDefault();
      $(this).removeClass('un_like_btn');
      $(this).addClass('like_btn');
      var post_id = $(this).attr('post_id');
      var count = $('.like_counts' + post_id).text();
      var countInt = Number(count);

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "post",
        url: "/unlike/post/" + post_id,
        data: {
          post_id: $(this).attr('post_id'),
        },
      }).done(function(res) {
        $('.like_counts' + post_id).text(countInt - 1);
      }).fail(function() {

      });
    });
  });
  </script>

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Teppei\keijiban_kadai\keijiban_kadai_ot\resources\views/posts/index.blade.php ENDPATH**/ ?>