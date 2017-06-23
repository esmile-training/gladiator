
<?php 
	// ユーザーキャラクターのIDを取得する
	$gachaCost = \Config::get('gacha.eRate');
	$cost = number_format($gachaCost[$data['gachaId']]['money']);
	$money = number_format($data['money']);
	$deck = $viewData['deck'];
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
	<!--<img class="gacha_popup image_change" src = "{{IMG_URL}}popup/scoutDown.png">-->
@else
	<a class="clickfalse" href="{{APP_URL}}gacha/viewDataSet?gachavalue={{$data['gachaId']}}">
		<img class="gacha_popup image_change" src = "{{IMG_URL}}popup/scout.png" style='top: 78%'>
	</a>
@endif
	<table border="1" class='boxGacha_table'>
		<tr>
			<th>レア度</th>
			<th colspan="3">出現率</th>
		</tr>
		<tr>
			<td><image class="boxGacha_table_image" src='{{IMG_URL}}gacha/5.png'></td>
			<td></td>
			<td>{{round(((int)$gachaCost[$data['gachaId']]['deck'][5] - $deck['LR']) / ((int)$gachaCost[$data['gachaId']]['deck'][0] - $deck['count'])* 100, 2)}}%</td>
			<td></td>
		</tr>
		<tr>
			<td><image class="boxGacha_table_image" src='{{IMG_URL}}gacha/4.png'></td>
			<td></td>
			<td>{{round(((int)$gachaCost[$data['gachaId']]['deck'][4] - $deck['SSR']) / ((int)$gachaCost[$data['gachaId']]['deck'][0] - $deck['count'])* 100, 2)}}%</td>
			<td></td>
		</tr>
		<tr>
			<td><image class="boxGacha_table_image" src='{{IMG_URL}}gacha/3.png'></td>
			<td></td>
			<td>{{round(((int)$gachaCost[$data['gachaId']]['deck'][3] - $deck['SR']) / ((int)$gachaCost[$data['gachaId']]['deck'][0] - $deck['count'])* 100, 2)}}%</td>
			<td></td>
		</tr>
		<tr>
			<td><image class="boxGacha_table_image" src='{{IMG_URL}}gacha/2.png'></td>
			<td></td>
			<td>{{round(((int)$gachaCost[$data['gachaId']]['deck'][2] - $deck['R']) / ((int)$gachaCost[$data['gachaId']]['deck'][0] - $deck['count'])* 100, 2)}}%</td>
			<td></td>
		</tr>
		<tr>
			<td><image class="boxGacha_table_image" src='{{IMG_URL}}gacha/1.png'></td>
			<td></td>
			<td>{{round(((int)$gachaCost[$data['gachaId']]['deck'][1] - $deck['N']) / ((int)$gachaCost[$data['gachaId']]['deck'][0] - $deck['count'])* 100, 2)}}%</td>
			<td></td>
		</tr>
	</table>
</div>
