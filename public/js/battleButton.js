$(function(){
    $('img.buttleButton').click(function(){
	// クラス名の取得
	var getClass = $(this);
	
	// srcの取得
	var getSrc = $(this).attr('src');
	
	// "/"ごとにURL分割
	var beforeImage = getSrc.split("/");
	// 画像名だけを抽出
	beforeImage = beforeImage[beforeImage.length - 1];

	// すでに画像名に処理後の画像名が入っていれば何もなし
	if(beforeImage.match('Down'))
	{
	    return false;
	}

	// 抽出した画像名から名前と拡張子を分割
	var afterImage = beforeImage.split(".");
	
	// 画像名に押された後の画像名を連結
	afterImage = afterImage[0] + 'Down.' + afterImage[1];
	
	// もともとの画像と変更
	var changeL = getSrc.replace(beforeImage , afterImage);
	$(this).attr('src', changeL);

	// 指定秒数間だけ押されている画像を実行
	setTimeout(function(){
	    var changeL = getSrc.replace(afterImage , beforeImage);
	    $(getClass).attr('src', changeL);
	}, 500);
    });
    $('.visibil').click(function() {       
        document.getElementById("visi").style.visibility="hidden";
    });
    
    $('.clickfalse').click(function() {   
        $('.clickfalse').click(function () {
            return false;
        });
    });
});