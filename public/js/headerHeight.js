$(function(){
    var height = $('.headerPosition > img').height();
    var main = document.getElementById( "main" );
    console.log(height);
    main.style.marginTop = height+'px';
});