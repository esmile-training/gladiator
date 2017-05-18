$(function(){
    var headerHeight = $('.headerPosition > img').height();
    var footerHeight = $('.footerPosition > img').height();
    console.log(headerHeight);
    var main = document.getElementById( "main" );
    headerHeight = headerHeight-(headerHeight/8);
    //footerHeight = footerHeight+(footerHeight/2);

    main.style.marginTop = (headerHeight)+'px';
    main.style.marginBottom = (footerHeight) + 'px';
    
    var mainHeight = $('.junban0').height();
    console.log(mainHeight);
    main.style.height = mainHeight+'px';
});
