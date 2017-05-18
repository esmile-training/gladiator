@include('common/css', ['file' => 'gacha'])
<div class = "all">
	<div>
		{{--画像--}}
		<div class = "charabox">
			<div>
				<img class="flash" src="{{IMG_URL_GACHA}}flash.png">
			</div>
			<div class = "chara">
				<img class="char" src="{{IMG_URL_CHARA}}{{$viewData['charaId']}}.png">	 
			</div>
			{{--レア度--}}
			<div>
				<img class="rate" src="{{IMG_URL_GACHA}}{{$viewData['rarity']}}.png">
			</div>
			<div>
				<img class="logo"src="{{IMG_URL_GACHA}}logo.png">
			</div>
		</div>
	</div>
	<div class = "absolute">
		<div class="waku">
			<img class="waku1"src="{{IMG_URL_GACHA}}wakuUp.png"><img class="waku2"src="{{IMG_URL_GACHA}}wakuNaka.png"><img class="waku3"src="{{IMG_URL_GACHA}}wakuuUnder.png">
		</div>
		<div class = "textbox">
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
	</div>
</div>