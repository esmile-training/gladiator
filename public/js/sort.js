//メッセージの表示
function onSortChange() {
	$("#roadCover").removeClass("offCover");
	console.log("a");
}
//select内容の取得
function getType(){
	$('[name=type] option').change(function() {
		var txt = $('[name=type] option:selected').value();
		console.log(txt);
//		return txt;.append
	});
}
