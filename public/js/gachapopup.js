function yesno($gachaId){
		var param = escape($gachaId);
		location.href = "viewDataSet?gachavalue=" + param;
}
