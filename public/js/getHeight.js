$(function(){
    var headerHeight = $('.headerPosition > img').height();
    var footerHeight = $('.footerPosition > img').height();

    
    var main = document.getElementById( "main" );
	headerHeight = headerHeight-(headerHeight/8);
	 
	main.style.marginTop = headerHeight+'px';
    
	var body =  $('body').height();
	body = body - (headerHeight + footerHeight);
	main.style.height = body+'px';
	

});
