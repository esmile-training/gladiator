@include('common/css', ['file' => 'char'])
<div>
	<img class="rate" src="{{IMG_URL_TEST}}{{$viewData['ratio']['hit']}}.png"width= 15% height= 15%>

    {{--画像--}}
     <img class="char" src="{{CHAR_IMG_URL}}{{$viewData['chara']['charaId']}}.png"width= 35% height= 55%>
	 <div>
		<?php echo $viewData['name']['firstname']['name'],'・',$viewData['name']['lastname']['familyname']?>
	</div>
	 
	<div>
		<?php echo $viewData['name']['firstname']['name'],'・',$viewData['name']['lastname']['familyname']?>
	</div>
	<div>
		<?php echo 'hp			',$viewData['valueList']['hp']?>
	</div>
	<div>
		<?php echo 'gu		',$viewData['valueList']['gu']?>
	</div>
	<div>
		<?php echo 'choki		',$viewData['valueList']['choki']?>
	</div>
	<div>
		<?php echo 'paa		',$viewData['valueList']['paa']?>
	</div>
</div>