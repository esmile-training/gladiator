$(function(){
    $('img.image_change').click(function(){
	//
	var getClass = $(this);
	var getSrc = $(this).attr('src');	
	var beforeImage = getSrc.split("/");
	beforeImage = beforeImage[beforeImage.length - 1];

	if(beforeImage.match('Down'))
	{
	    return false;
	}

	var afterImage = beforeImage.split(".");
	afterImage = afterImage[0] + 'Down.' + afterImage[1];
	

	var changeL = getSrc.replace(beforeImage , afterImage);
	$(this).attr('src', changeL);

	setTimeout(function(){
	    var changeL = getSrc.replace(afterImage , beforeImage);
	    $(getClass).attr('src', changeL);
	}, 500);
    });
});
