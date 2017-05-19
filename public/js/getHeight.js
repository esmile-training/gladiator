$(function(){
    // ヘッダーとフッターの高さの幅を取得
    var headerHeight = $('.headerPosition > img').height();
    var footerHeight = $('.footerPosition > img').height();
    
    var main = document.getElementById( "main" );
    
    // ヘッダーの画像の影の部分を詰める
    headerHeight = headerHeight-(headerHeight/8);
    
    // mainの上下の幅を空ける
    main.style.marginTop = (headerHeight)+'px';
    main.style.marginBottom = (footerHeight) + 'px';
    
    // bodyからheader/footer分の高さを引いてmainの高さを調整
    var bodyHeight = $('body').height();
    bodyHeight = bodyHeight - (headerHeight + footerHeight);
    main.style.height = bodyHeight + 'px';
    
    // ガチャ限定
    var mainHeight = $('.junban0').height();
    
    mainHeight += (mainHeight/10);
    main.style.height = mainHeight+'px';
});
