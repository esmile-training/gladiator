$(function(){
	$('img.battle_Button').click(function(){
		// srcの取得
		var getSrc = $(this).attr('src');

		// "/"ごとにURL分割
		var beforeImage = getSrc.split("/");
		// 画像名だけを抽出
		beforeImage = beforeImage[beforeImage.length - 1];

		// すでに画像名に処理後の画像名が入っていれば何もなし
		if(beforeImage.match('Up') || beforeImage.match('Down'))
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

		// 敵の手画像をはてなの画像に変更
		var afterImageE = "http://esmile-sys.sakura.ne.jp/gladiator/public/img/chara/status/hand0.png";
		document.getElementById("enemyHand").src = afterImageE;

		// グー、チョキ、パーのDown画像定義
		var afterImageG = "http://esmile-sys.sakura.ne.jp/gladiator/public/img/chara/status/hand1Down.png";
		var afterImageC = "http://esmile-sys.sakura.ne.jp/gladiator/public/img/chara/status/hand2Down.png";
		var afterImageP = "http://esmile-sys.sakura.ne.jp/gladiator/public/img/chara/status/hand3Down.png";

		// idを取得して、そのid以外の攻撃ボタンを消す
		var idname = $(this).attr("id");

		// グーが押されたら
		if(idname === "playerHand1")
		{
			// チョキとパーの画像を変更            
			document.getElementById("playerHand2").src = afterImageC;
			document.getElementById("playerHand3").src = afterImageP;
		}
		// チョキが押されたら
		else if(idname === "playerHand2")
		{
			// グーとパーの画像を変更 
			document.getElementById("playerHand1").src = afterImageG;
			document.getElementById("playerHand3").src = afterImageP; 
		}
		// パーが押されたら
		else if(idname === "playerHand3")
		{
			// グーとチョキの画像を変更
			document.getElementById("playerHand1").src = afterImageG;
			document.getElementById("playerHand2").src = afterImageC; 
		}
	});

	// 表示を消す処理
	$('.visibil').click(function() {
		// ログの表示を消す
		document.getElementById("battleLog").style.visibility="hidden";
	});
});