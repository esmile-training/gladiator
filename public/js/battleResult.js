 if(Date())
 {		
	$(".cap").removeClass("act");
	document.form1.btn.disabled = "";
 } else {
	$(".cap").addClass("act");
	document.form1.btn.disabled = "true";
 }