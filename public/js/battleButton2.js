$(function(){
    $('img.battle_Button2').click(function(){
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

        var idname = $(this).attr("id");
        
        var gooid = $('#playerHand1');
        var choid = $('#playerHand2');
        var paaid = $('#playerHand3');
        
        var gooSrc = gooid.attr('src');
        var choSrc = choid.attr('src');
        var paaSrc = paaid.attr('src');
        
        if(idname === "playerHand1")
        {
            // もともとの画像と変更
            var changeC = choSrc.replace("{{IMG_URL}}chara/status/hand2.png" , "{{IMG_URL}}chara/status/hand2Down.png");
            choid.attr('src', changeC);
            var changeP = paaSrc.replace("{{IMG_URL}}chara/status/hand3.png" , "{{IMG_URL}}chara/status/hand3Down.png");
            paaid.attr('src', changeP);
        }
        else if(idname === "playerHand2")
        {
            // もともとの画像と変更
            var changeG = gooSrc.replace("{{IMG_URL}}chara/status/hand1.png" , "{{IMG_URL}}chara/status/hand1Down.png");
            gooid.attr('src', changeG);
            var changeP = paaSrc.replace("{{IMG_URL}}chara/status/hand3.png" , "{{IMG_URL}}chara/status/hand3Down.png");
            paaid.attr('src', changeP);
        }
        else if(idname === "playerHand3")
        {
            // もともとの画像と変更
            var changeG = gooSrc.replace("{{IMG_URL}}chara/status/hand1.png" , "{{IMG_URL}}chara/status/hand1Down.png");
            gooid.attr('src', changeG);
            var changeC = choSrc.replace("{{IMG_URL}}chara/status/hand2.png" , "{{IMG_URL}}chara/status/hand2Down.png");
            choid.attr('src', changeC);
        }
    });
    
    $('.visibil').click(function() {
        document.getElementById("enemyHand").style.visibility="hidden";
    });
});