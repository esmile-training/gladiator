$(function(){
    var headerHeight = $('.headerPosition > img').height();
    var footerHeight = $('.footerPosition > img').height();

    
    var main = document.getElementById( "main" );
	headerHeight = headerHeight-(headerHeight/8);
	 
    main.style.marginTop = (headerHeight)+'px';
    main.style.marginBottom = (footerHeight) + 'px';
    
    var mainHeight = $('.junban0').height();
    console.log(mainHeight);

	mainHeight += (mainHeight/10);
    main.style.height = mainHeight+'px';
});
