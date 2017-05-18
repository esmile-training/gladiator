<META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
<script TYPE="text/javascript">
var charCheckNum = 8;   					//許容文字数
function charCheck(){
	if(document.all || document.getElementById){		//IE4,N6,O6以降
		var str = document.form1.teamName.value;
		var r = 0; 
		for (var i = 0; i < str.length; i++) { 
        var c = str.charCodeAt(i); 
			if ( (c >= 0x0 && c < 0x81) || (c == 0xf8f0) || (c >= 0xff61 && c < 0xffa0) || (c >= 0xf8f1 && c < 0xf8f4)) { 
				r += 1; 
			} else { 
				r += 2; 
			} 
		}
		if(r >= charCheckNum){		//許容文字数を超えている場合
			str = str.substring(0, charCheckNum);//許容文字数にする
			document.form1.teamName.value = str;	//フォーム文に許容文字数を設定
		}
	}
}

function blank_alert() {
	if(document.form1.teamName.value==""){
		alert("データを入力してください");
	}
}
</script>

<div align="center">

	<br>エディット画面
</div>

<div align="center">

	<p>チーム名を入力してください<br>

	<font color="red">※全角８文字以内</font><br>
	<form name="form1" action="addUser" method="get">
		<input type="text" name="teamName" onblur="blank_alert()" onkeydown="charCheck()" onkeyup="charCheck()"></p>
		<input type="submit" value="登録">
	<input type="hidden" name="gachavalue" value="12">
	</form></div>
