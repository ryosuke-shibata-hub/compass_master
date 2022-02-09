$(function () {

  $(function () {
    $('.dropdwn li').hover(function () {
      $("ul:not(:animated)", this).slideDown();
    }, function () {
      $("ul.drop_menu", this).slideUp();
    });
  });

  $(".btn-dell").click(function () {
    if (confirm("本当に削除しますか？")) {
      // そのままsubmit処理を実行（※削除）
    } else {
      // キャンセル
      return false;
    }
  });

  function stop_process(click_execution) {
    click_execution.css('pointer-events', 'none');
    setTimeout(function () {
      click_execution.css('pointer-events', '');
    }, 500);
  }
  //投稿のいいね機能
  $('.post_favorite').on('click', function () {
    var post_id = $(this).attr("post_id");
    var post_favorite_id = $(this).attr("post_favorite_id");
    var click_post_favorite = $(this);


    stop_process(click_post_favorite);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/post_favorite',
      type: 'POST',
      data: { 'post_id': post_id, 'post_favorite_id': post_favorite_id, },
    })


      .done(function (data) {
        $('#post_favorite_count' + post_id).text(data[1]).change();

        if (data[0] == 0) {
          click_post_favorite.attr('post_favorite_id', '1');
          click_post_favorite.children().attr('class', 'fas fa-heart');
        }
        if (data[0] == 1) {
          click_post_favorite.attr('post_favorite_id', '0');
          click_post_favorite.children().attr('class', 'far fa-heart');
        }
      })
      .fail(function (data) {
        alert('いいね処理失敗');
      });

  });
  //コメントへのいいね機能
  $('.comment_favorite').on('click', function () {
    var comment_id = $(this).attr("comment_id");
    var comment_favorite_id = $(this).attr("comment_favorite_id");
    var click_comment_favorite = $(this);

    stop_process(click_comment_favorite);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/post_comment_favorite',
      type: 'POST',
      data: { 'comment_id': comment_id, 'comment_favorite_id': comment_favorite_id, },
    })
      .done(function (data) {
        $('#comment_favorite_count' + comment_id).text(data[1]).change();

        if (data[0] == 0) {
          click_comment_favorite.attr('comment_favorite_id', '1');
          click_comment_favorite.children().attr('class', 'fas fa-heart');
        }
        if (data[0] == 1) {
          click_comment_favorite.attr('comment_favorite_id', '0');
          click_comment_favorite.children().attr('class', 'far fa-heart');
        }
      })
      .fail(function (data) {
        alert('いいね処理失敗');
      });

  });
  //カテゴリーでの検索機能
  $('#post_sub_category_search').on('change', function () {

    var category_id = $('option:selected').data('subcategory_id');
    var url = '/post/index/' + category_id;
    window.location = url;
  });

});
