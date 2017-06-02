$(function(){    
    var headerHeight = $('.headerPosition > .headerImg').height();
    var footerHeight = $('.footerPosition > .footerImg').height();
    
    var main = document.getElementById( "main" );
    var mainHeight =  $('#main').height();
    
    headerHeight = headerHeight-(headerHeight/6);
    footerHeight = footerHeight+(footerHeight/8);
    
     var bodyHeight = screen.height - (headerHeight + footerHeight);

    console.log(mainHeight);
    console.log(bodyHeight);
    console.log(screen.height);
     
/*
    if(mainHeight < bodyHeight && screen.height < 1024){
	bodyHeight = bodyHeight+(footerHeight/4);
	main.style.marginTop = bodyHeight+'px';
	main.style.height = bodyHeight+'px';
	main.style.marginBottom = footerHeight+'px';
    }else{
	main.style.marginTop = headerHeight+'px';
	main.style.height = mainHeight+'px';
	main.style.marginBottom = footerHeight+'px';
    }*/

});
