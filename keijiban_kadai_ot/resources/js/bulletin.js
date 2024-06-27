$(function () {
  $('.main_categories').click(function () {
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

  $(document).on('click', '.like_btn', function (e) {
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
    }).done(function (res) {
      console.log(res);
      $('.like_counts' + post_id).text(countInt + 1);
    }).fail(function (res) {
      console.log('fail');
    });
  });

  $(document).on('click', '.un_like_btn', function (e) {
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
    }).done(function (res) {
      $('.like_counts' + post_id).text(countInt - 1);
    }).fail(function () {

    });
  });
});
