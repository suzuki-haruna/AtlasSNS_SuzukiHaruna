$(function () { // if document is ready
  //投稿機能モーダル
  alert('hello world')

  //クリックで動く
  $('.menu').click(function () {
    $(this).toggleClass('active');
    $(this).next('nav').slideToggle();
  });
  //ホバーで動く
  /*$('.menu').hover(function () {
    $(this).toggleClass('active');
    $(this).next('nav').slideToggle();
  });*/
});
