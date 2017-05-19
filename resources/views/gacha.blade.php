@include('common/css', ['file' => 'gacha'])
<div class = "gacha_all">
	<div>
		{{--画像--}}
		<div class = "gacha_charabox">
			<div>
				<img class="gacha_charaflash" src="{{IMG_URL_GACHA}}flash.png">
			</div>
			<div class = "gacha_charapos">
				<img class="gacha_chara" src="{{IMG_URL_CHARA}}{{$viewData['charaId']}}.png">	 
			</div>
			{{--レア度--}}
			<div>
				<img class="gacha_chararate" src="{{IMG_URL_GACHA}}{{$viewData['rarity']}}.png">
			</div>
			<div>
				<img class="gacha_charalogo"src="{{IMG_URL_GACHA}}logo.png">
			</div>
		</div>
	</div>
	<div>
		<div class="gacha_charaframe">
			<img class="gacha_charatopframe"src="{{IMG_URL_GACHA}}wakuUp.png">
			<img class="gacha_characenterframe"src="{{IMG_URL_GACHA}}wakuNaka.png"><img class="gacha_charabottomframe"src="{{IMG_URL_GACHA}}wakuuUnder.png">
		</div>
		<div class = "gacha_charatextbox">
			<div class="gacha_charaname">
				<?php echo $viewData['firstname'],'・',$viewData['lastname']?>
			</div>
			<div class="gacha_charahp">
				<?php echo 'HP:			',$viewData['hp']?>
			</div>
			<div class="gacha_charastatus">
				<?php echo 'グー:		',$viewData['gu']?>
				<?php echo 'チョキ:		',$viewData['choki']?>
				<?php echo 'パー:		',$viewData['paa']?>
			</div>
		</div>
	</div>
</div>