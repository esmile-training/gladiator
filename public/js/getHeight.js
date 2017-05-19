$(function(){
    // ヘッダーとフッターの高さの幅を取得
    var headerHeight = $('.headerPosition > img').height();
    var footerHeight = $('.footerPosition > img').height();
    
    var main = document.getElementById( "main" );
    
    // ヘッダーの画像の影の部分を詰める
    headerHeight = headerHeight-(headerHeight/8);
    
    // mainの上下の幅を空ける
	main.style.marginBottom = footerHeight+'px';
    
	var body =  $('body').height();
	body = body - (headerHeight + footerHeight);
	main.style.height = body+'px';
	

});
