$(function(){    
    var headerHeight = $('.headerPosition > .headerImg').height();
    var footerHeight = $('.footerPosition > .footerImg').height();
    
    var main = document.getElementById( "main" );
    var mainHeight =  $('#main').height();
    
    headerHeight = headerHeight-(headerHeight/4);
    footerHeight = footerHeight+(footerHeight/4);

    main.style.marginTop = headerHeight+'px';
    main.style.height = mainHeight+'px';
    main.style.marginBottom = footerHeight+'px';
    

});
