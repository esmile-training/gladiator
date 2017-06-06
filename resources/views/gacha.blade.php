<div><img class="gacha_back" src="{{IMG_URL}}gacha/selectbackground.jpg" /></div>
@include('common/css', ['file' => 'gacha'])
<div class = "gacha_all">
	<input type="checkbox" 
		   id="check1" 
		   style = "opacity: 0;">
	<label for="check1">
		<div>
		{{--画像--}}
		<div class = "gacha_charabox">
			<div>
				<img class="gacha_charaflash" 
					 src="{{IMG_URL}}gacha/flash.png">
			</div>
			<div class = "gacha_charapos">
				<img class="gacha_chara" 
					 src="{{IMG_URL}}chara/{{$viewData['charaId']}}.png">	 
			</div>
			{{--レア度--}}
			<div>
				<img class="gacha_chararate"
					 src="{{IMG_URL}}gacha/{{$viewData['rarity']}}.png">
			</div>
			<div>
				<img class="gacha_charalogoflash"
					 src="{{IMG_URL}}gacha/logoflash.png">
			</div>
		</div>
	</div>
	</label><br>
	<div id="entryBtn">
		<div class="gacha_charaframe">
			<div class = "top">
				<img class="gacha_charatopframe"
					 src="{{IMG_URL}}gacha/wakuUp.png">
			</div>
			<div class = "center">
				<img class="gacha_characenterframe"
					 src="{{IMG_URL}}gacha/wakuNaka.png">
			</div>
			<div class = "bottom">
				<img class="gacha_charabottomframe"
					 src="{{IMG_URL}}gacha/wakuuUnder.png">
			</div>
		</div>
		<div class = "gacha_charatextbox">
			<div class="gacha_charaname">
				<?php echo $viewData['firstname'],'・',$viewData['lastname']?>
			</div>
			<div class="gacha_charahp">
				<img class = "gacha_hpicon" 
					 src = "{{IMG_URL}}chara/status/hp.png">
				<span class = "gacha_fontgoo">{{$viewData['hp']}}</span>
			</div>
			<div class="gacha_charastatus">
				<img class = "gacha_guicon" 
					 src = "{{IMG_URL}}chara/status/hand1.png">
				<span class = "gacha_fontgoo">{{$viewData['gu']}}</span>
				<img class = "gacha_guicon" 
					 
					 src = "{{IMG_URL}}chara/status/hand2.png">
				<span class = "gacha_fontchoki">{{$viewData['choki']}}</span>
				<img class = "gacha_guicon" src = "{{IMG_URL}}chara/status/hand3.png">
				<span class = "gacha_fontpaa">{{$viewData['paa']}}</span>
			</div>
		</div>
	</div>
</div>