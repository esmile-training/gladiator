var flug;

function charCheck(){
	var str = document.form1.teamName.value; //入力内容格納
	for (var i = 0; i < str.length; i++) { 
		var c = str.charCodeAt(i); //最後に入力された文字の取得
		if ( (c >= 0x0 && c < 0x81) || (c == 0xf8f0) || (c >= 0xff61 && c < 0xffa0) || (c >= 0xf8f1 && c < 0xf8f4)) { 
			
		} else { 
			console.log(c);
		}
		if(str.length > 8)
		{
			str = str.substring(0, 8);
			document.form1.teamName.value = str;
		}
	}
}


function wupBtn(){
	//空白の登録禁止処理
	//名前と感想の欄のテキストを変数に代入する
	var name = document.form1.elements[0].value;
  
	//名前若しくは感想欄のどちらかが空かチェック
  if ( name == "" )
  {
    //どちらか空であれば、ボタンを押せなくする
    document.form1.elements[1].disabled = true;
  }else{
    //両方とも書き込まれていたら、ボタンを押せるようにする
    document.form1.elements[1].disabled = false;
  } 
}

function disbtn(b)
{	
	//８文字以上入力された場合のポップアップ表示
	if(flug == false && document.form1.teamName.value.length > 8)
	{
		alert("全角８文字以内にしてください");
	} else {	
		 b.disabled = true;
		 b.value = '登録中';
		 b.form.submit();
	}
}

function checkChara(){
	var charCheckNum = 8;   					//許容全角文字数
	var str = document.form1.teamName.value;
	for (var i = 0; i < str.length; i++) { 
	var c = str.charCodeAt(i); //最後に入力された文字の取得
		if ( (c >= 0x0 && c < 0x81) || (c == 0xf8f0) || (c >= 0xff61 && c < 0xffa0) || (c >= 0xf8f1 && c < 0xf8f4)) { 
			//入力禁止処理
		} else { 
			console.log(c);
		}
		if(str.length > charCheckNum)
		{
			str = str.substring(0, 8);
			document.form1.teamName.value = str;
		}
	}
}
