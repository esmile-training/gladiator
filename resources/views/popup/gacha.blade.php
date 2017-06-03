<div>
	<?php 
		// ユーザーキャラクターのIDを取得する
		$gachaCost = \Config::get('gacha.eRate');
		$cost = number_format($gachaCost[$data['gachaId']]['money']);
		$money = number_format($data['money']);
	?>
	スカウト費用：{{$cost}}</br>
	所持ゴールド：{{$money}}</br>
	@if($data['money'] < $gachaCost[$data['gachaId']]['money'])
		<div style="color:#F00">
			残高が足りません
		</div>
		<img class="gacha_popup image_change" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/popup/yes_ButtonDown.png">
	@else
		<a class="clickfalse" href="{{APP_URL}}gacha/viewDataSet?gachavalue={{$data['gachaId']}}">
			<img class="gacha_popup image_change" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/popup/yes_Button.png">
		</a>
	@endif
</div>
