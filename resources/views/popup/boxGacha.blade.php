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
		<img  class = "gold2" src = "{{IMG_URL}}user/gold.png">
		</br>
		スカウト:
		{{$cost}}
		<img  class = "gold1" src = "{{IMG_URL}}user/gold.png">
		</br>
	@if($data['money'] < $gachaCost[$data['gachaId']]['money'])
		<div style="color:#F00">
			残高が足りません
		</div>
		<img class="gacha_popup image_change" src = "{{IMG_URL}}popup/scoutDown.png">
	@else
		<a class="clickfalse" href="{{APP_URL}}gacha/viewDataSet?gachavalue={{$data['gachaId']}}">
			<img class="gacha_popup image_change" src = "{{IMG_URL}}popup/scout.png">
		</a>
	@endif
		<table border="1">
				<p>ガチャ残り枚数</p>
			<tr>
				<th>レア度</th>
				<th>残数</th>
			</tr>
			<tr>
				<td><image src='{{IMG_URL}}gacha/1.png'></td>
				<td>１</td>
			</tr>
			<tr>
				<td>SSR</td>
				<td>9</td>
			</tr>
			<tr>
				<td>SR</td>
				<td>30</td>
			</tr>
			<tr>
				<td>R</td>
				<td>110</td>
			</tr>
			<tr>
				<td>N</td>
				<td>150</td>
			</tr>
		</table>
	</div>
</div>