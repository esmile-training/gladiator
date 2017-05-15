@include('common/css', ['file' => 'gacha'])

<img class="rate" src="{{IMG_URL_TEST}}{{$viewData['rarity']}}.png">

{{--画像--}}
<div style="text-align:center;">
	<img class="char" src="{{CHAR_IMG_URL}}{{$viewData['charaId']}}.png">	 
</div>


<img class="waku" src="{{IMG_URL_TEST}}statuswaku.jpg">
<div>
	<div class="name">
		<?php echo $viewData['firstname'],'・',$viewData['lastname']?>
	</div>
	<div class="hp">
		<?php echo 'HP:			',$viewData['hp']?>
	</div>
	<div class="font">
		<?php echo 'グー:		',$viewData['gu']?>
		<?php echo 'チョキ:		',$viewData['choki']?>
		<?php echo 'パー:		',$viewData['paa']?>
	</div>
</div>