$(function(){    
    var headerHeight = $('.headerPosition > img').height();
    var footerHeight = $('.footerPosition > img').height();
    
    var main = document.getElementById( "main" );

    var bodyHeight =  $('body').height();
    var mainHeight =  $('#main').height();
    
    bodyHeight = bodyHeight - (headerHeight + footerHeight);
    headerHeight = headerHeight-(headerHeight/7);
    
    if(bodyHeight <= mainHeight){
	main.style.marginTop = headerHeight+'px';
	main.style.height = mainHeight+'px';
    }else{
	main.style.marginTop = headerHeight+'px';
	main.style.height = (bodyHeight + headerHeight)+'px';
    }

});
