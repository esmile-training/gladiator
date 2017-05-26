$(function(){    
    var headerHeight = $('.headerPosition > .headerImg').height();
    var footerHeight = $('.footerPosition > .footerImg').height();
    
    var main = document.getElementById( "main" );
    var mainHeight =  $('#main').height();
    
    headerHeight = headerHeight-(headerHeight/6);
    footerHeight = footerHeight+(footerHeight/8);
    
     var bodyHeight = screen.height - (headerHeight + footerHeight);

    if(mainHeight < bodyHeight && screen.height < 1024){
	mainHeight = bodyHeight+(footerHeight/4);
	console.log(mainHeight);
	main.style.marginTop = headerHeight+'px';
	main.style.height = mainHeight+'px';
    }else{
	main.style.marginTop = headerHeight+'px';
	main.style.height = screen.height+'px';
	main.style.marginBottom = footerHeight+'px';
    }

});
