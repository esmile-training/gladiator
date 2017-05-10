@include('common/css', ['file' => 'char'])

<div>
	<img class="rate" src="{{IMG_URL_TEST}}{{$viewData['rarity']}}.png"width= 15% height= 15%>

    {{--画像--}}
     <img class="char" src="{{CHAR_IMG_URL}}{{$viewData['charaId']}}.png"width= 35% height= 55%>	 
	<div>
		<?php echo $viewData['firstname'],'・',$viewData['lastname']?>
	</div>
	<div>
		<?php echo 'hp			',$viewData['hp']?>
	</div>
	<div>
		<?php echo 'gu		',$viewData['gu']?>
	</div>
	<div>
		<?php echo 'choki		',$viewData['choki']?>
	</div>
	<div>
		<?php echo 'paa		',$viewData['paa']?>
	</div>
</div>