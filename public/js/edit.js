function disbtn(b)
{	
	b.form.submit();
}

function check_text()
{
	 if((document.form1.teamName.value.match(/^[^ -~｡-ﾟ]*$/) || document.form1.teamName.value.match(/\"\'/)) && document.form1.teamName.value.length < 9 && document.form1.teamName.value.length > 0)
	 {		
		$(".cap").removeClass("act");
		document.form1.btn.disabled = "";
	 } else {
		$(".cap").addClass("act");
		document.form1.btn.disabled = "true";
	 }
}