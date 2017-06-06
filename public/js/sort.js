function onSortChange() {
	$("#roadCover").removeClass("offCover");
}

function getType(type){
	var mes;
	switch (type){
		case "id":
			mes = "入手";
			break;
		case "name":
			mes = "名前";
			break;
		case "rare":
			mes = "レア度";
			break;
		case "gooAtk":
			mes = "グー 攻撃力";
			break;
		case "choAtk":
			mes = "チョキ 攻撃力";
			break;
		case "paaAtk":
			mes = "パー 攻撃力";
			break;
	}
	return mes;
}
