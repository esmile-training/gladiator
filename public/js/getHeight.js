$(function(){    
    var headerHeight = $('.headerPosition > img').height();
    var footerHeight = $('.footerPosition > img').height();
    
    var main = document.getElementById( "main" );
    
    var bodyHeight =  $('body').height();
    var mainHeight =  $('#main').height();
    
    headerHeight = headerHeight-(headerHeight/4);
    
    if(bodyHeight <= mainHeight){
	main.style.marginTop = headerHeight+'px';
	main.style.marginBottom = footerHeight+'px';
	
	console.log('main');
    }else{
	main.style.marginTop = headerHeight+'px';
	main.style.height = (bodyHeight-(headerHeight+footerHeight))+'px';
	
	console.log('body');
    }

});
