//メッセージの表示
function onSortChange() {
	$("#roadCover").removeClass("offCover");
}
//select内容の取得
function getType(){
	$('[name=type]').change(function() {
		var txt = $('[name=type] option:selected').text();
		$("#roadCover p span").append(txt);
		console.log(txt);
//		return txt;.append
	});
}
