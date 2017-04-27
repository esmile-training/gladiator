$(function(){
  var target = '';
  //.modal_btnを押したとき
  $(".modal_btn").click(function(){
    target = $(this).get(0).className.split(" ")[1];
    target = $(".modal." + target);
    if ( target.is(":hidden") ) {
      target.fadeIn(600);
      $(".modal_container");//.addClass("bg-blur");
    } else {
      target.hide();
      $(".modal_container");//.removeClass("bg-blur");
    }
  });
  // 閉じるボタンを押したときの処理
  $(".close").click(function(){
    $(".modal").hide();
    $(".modal_container");//.removeClass("bg-blur");
  });
});
