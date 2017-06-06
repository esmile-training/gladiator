$(function(){
    $('img.battle_Button2').click(function(){
        // srcの取得
        var getSrc = $(this).attr('src');

        // 押された画像の取得
        var idname = $(this).attr('id');
        
        console.log(idname);

        var goo = $('#playerHand1');
        var cho = $('#playerHand2');
        var paa = $('#playerHand3');
        
        var gooId = goo.attr('id');
        var choId = cho.attr('id');
        var paaId = paa.attr('id');

        var gooSrc = goo.attr('src');
        var choSrc = cho.attr('src');
        var paaSrc = paa.attr('src');

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

        // 押されてない画像の変更

        if(idname === gooId)
        {
            // もともとの画像と変更
            var changeC = choSrc.replace("{{IMG_URL}}chara/status/hand2.png" , "{{IMG_URL}}chara/status/hand2Down.png");
            cho.attr('src', changeC);
            var changeP = paaSrc.replace("{{IMG_URL}}chara/status/hand3.png" , "{{IMG_URL}}chara/status/hand3Down.png");
            paa.attr('src', changeP);
        }
        else if(idname === choId)
        {
            // もともとの画像と変更
            var changeG = gooSrc.replace("{{IMG_URL}}chara/status/hand1.png" , "{{IMG_URL}}chara/status/hand1Down.png");
            $(goo).attr('src', changeG);
            var changeP = paaSrc.replace("{{IMG_URL}}chara/status/hand3.png" , "{{IMG_URL}}chara/status/hand3Down.png");
            $(paa).attr('src', changeP);
        }
        else if(idname === paaId)
        {
            // もともとの画像と変更
            var changeG = gooSrc.replace("{{IMG_URL}}chara/status/hand1.png" , "{{IMG_URL}}chara/status/hand1Down.png");
            $(goo).attr('src', changeG);
            var changeC = choSrc.replace("{{IMG_URL}}chara/status/hand2.png" , "{{IMG_URL}}chara/status/hand2Down.png");
            $(cho).attr('src', changeC);
        }
    });

    $('.visibil').click(function() {
        document.getElementById("enemyHand").style.visibility="hidden";
    });
});