{{-- 背景 --}}
<div><img class="gacha_back" src="{{IMG_URL}}gacha/selectbackground.jpg" /></div>
{{-- 全体 --}}
<div class = "gacha_all">
	<input type="checkbox" 
			id="check1" 
			style = "opacity: 0;">
	<label for="check1">
		<div>
		{{-- キャラクター全体 --}}
		<div class = "gacha_charabox">
			{{-- キャラクター背景光 --}}
			<div>
				<img class="gacha_charaflash" 
					 src="{{IMG_URL}}gacha/flash.png">
			</div>
			{{-- キャラクター画像 --}}
			<div class = "gacha_charapos">
				<img class="gacha_chara" 
					 src="{{IMG_URL}}chara/{{$viewData['charaId']}}.png">	 
			</div>
			{{-- レア度 --}}
			<div>
				<img class="gacha_chararate"
					 src="{{IMG_URL}}gacha/{{$viewData['rarity']}}.png">
			</div>
			{{-- レア度ロゴの光 --}}
			<div>
				<img class="gacha_charalogoflash"
					 src="{{IMG_URL}}gacha/logoflash.png">
			</div>
		</div>
	</div>
	</label><br>
	<div id="entryBtn">
		{{-- ステータス枠 --}}
		<div class="gacha_charaframe">
			{{-- ステータス枠上 --}}
			<div class = "top">
				<img class="gacha_charatopframe"
					 src="{{IMG_URL}}gacha/wakuUp.png">
			</div>
			{{-- ステータス枠中 --}}
			<div class = "center">
				<img class="gacha_characenterframe"
					 src="{{IMG_URL}}gacha/wakuNaka.png">
			</div>
			{{-- ステータス枠下 --}}
			<div class = "bottom">
				<img class="gacha_charabottomframe"
					 src="{{IMG_URL}}gacha/wakuuUnder.png">
			</div>
		</div>
		{{-- ステータステキスト --}}
		<div class = "gacha_charatextbox">
			{{-- キャラネーム --}}
			<div class="gacha_charaname">
				<?php echo $viewData['firstname'],'・',$viewData['lastname']?>
			</div>
			{{-- キャラHP --}}
			<div class="gacha_charahp">
				<img class = "gacha_hpicon" 
					 src = "{{IMG_URL}}chara/status/hp.png">
				<span class = "gacha_fontgoo">{{$viewData['hp']}}</span>
			</div>
			{{-- キャラ攻撃力 --}}
			<div class="gacha_charastatus">
				<img class = "gacha_guicon" 
					 src = "{{IMG_URL}}chara/status/hand1.png">
				<span class = "gacha_fontgoo">{{$viewData['gu']}}</span>
				<img class = "gacha_guicon" 
					 src = "{{IMG_URL}}chara/status/hand2.png">
				<span class = "gacha_fontchoki">{{$viewData['choki']}}</span>
				<img class = "gacha_guicon" 
					 src = "{{IMG_URL}}chara/status/hand3.png">
				<span class = "gacha_fontpaa">{{$viewData['paa']}}</span>
			</div>
		</div>
	</div>
</div>
{{-- CSS読み込み --}}
@include('common/css', ['file' => 'gacha'])