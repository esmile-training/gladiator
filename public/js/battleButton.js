$(function(){
    $('img.battle_Button').click(function(){	
	// srcの取得
	var getSrc = $(this).attr('src');
	
	// "/"ごとにURL分割
	var beforeImage = getSrc.split("/");
	// 画像名だけを抽出
	beforeImage = beforeImage[beforeImage.length - 1];

	// すでに画像名に処理後の画像名が入っていれば何もなし
	if(beforeImage.match('Up'))
	{
	    return false;
	}

	// 抽出した画像名から名前と拡張子を分割
	var afterImage = beforeImage.split(".");
	
	// 画像名に押された後の画像名を連結
	afterImage = afterImage[0] + 'Up.' + afterImage[1];
	
	// もともとの画像と変更
	var changeL = getSrc.replace(beforeImage , afterImage);
	$(this).attr('src', changeL);
    });
    
    // ボタンが押されたら、押されたボタン以外の手のボタンを消す
    $('.visibil').click(function() {
        // 敵の手
        document.getElementById("enemyHand").style.visibility="hidden";

        // idを取得して、そのid以外の攻撃ボタンを消す
        var idname = $(this).attr("id");
        
        // グーが押されたら
        if(idname === "playerHand1")
        {
            document.getElementById("playerHand2").style.visibility="hidden";
            document.getElementById("playerHand3").style.visibility="hidden";
        }
        // チョキが押されたら
        else if(idname === "playerHand2")
        {
            document.getElementById("playerHand1").style.visibility="hidden";
            document.getElementById("playerHand3").style.visibility="hidden";
        }
        // パーが押されたら
        else if(idname === "playerHand3")
        {
            document.getElementById("playerHand1").style.visibility="hidden";
            document.getElementById("playerHand2").style.visibility="hidden"; 
        }
    });
});