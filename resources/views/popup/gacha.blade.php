<div>
	<?php 
		// ユーザーキャラクターのIDを取得する
		$gachaCost = \Config::get('gacha.eRate');
		$cost = number_format($gachaCost[$data['gachaId']]['money']);
		$money = number_format($data['money']);
	?>
	<div class = "gacha_popupbox">
		所持:
		{{$money}}
		<img  class = "gold2" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/gacha/gold.png">
		</br>
		スカウト:
		{{$cost}}
		<img  class = "gold1" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/gacha/gold.png">
		</br>
	
	@if($data['money'] < $gachaCost[$data['gachaId']]['money'])
		<div style="color:#F00">
			残高が足りません
		</div>
		<img class="gacha_popup image_change" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/popup/scoutDown.png">
	@else
		<a class="clickfalse" href="{{APP_URL}}gacha/viewDataSet?gachavalue={{$data['gachaId']}}">
			<img class="gacha_popup image_change" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/popup/scout.png">
		</a>
	@endif
	</div>
</div>
