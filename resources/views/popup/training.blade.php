<div>
	{{'訓練が完了しました!'}}<br>
	<table>
	@foreach($viewData['endTrainingChara'] as $val)
	
	<div class="training_chara_frame">
		<div class="training_chara">
<!--			<img class="training_status_board" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" />-->
			<img class="training_chara_icon" src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png" />
			<img class="training_chara_rare" src="{{IMG_URL}}gacha/{{$val['rare']}}.png" />
			<img class="training_chara_rare_bg" src="{{IMG_URL}}battle/rarity_bg.png" />
		</div>

		<div class="training_chara_name">{{$val['name']}}</div>
		
		<div class="training_status">
			<div class="training_status_hp">{{$val['hp']}}</div>
			<div class="training_stutas_goo">{{$val['gooAtk']}}</div>
			<div class="training_status_cho">{{$val['choAtk']}}</div>
			<div class="training_stutas_paa">{{$val['paaAtk']}}</div>
		</div>
	</div>

	@endforeach
	</table>
</div>

<!--		<img class="training_status_board" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" />
		<tr>
			<td><img class="training_chara_icon" src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png" /></td>
			<td><img class="training_rare" src="{{IMG_URL}}gacha/{{$val['rare']}}.png" /></td>
			<td><img class="training_rare_bg" src="{{IMG_URL}}battle/rarity_bg.png" /></td>
		</tr>
		<tr>
			<td class="training_chara_name">{{$val['name']}}</td>
			<td class="training_chara_hp">{{$val['hp']}}</td>
			<td class="training_chara_goo">{{$val['gooAtk']}}</td>
			<td class="training_chara_cho">{{$val['choAtk']}}</td>
			<td class="training_chara_paa">{{$val['paaAtk']}}</td>
		</tr>-->

<!--	<div class="training_chara_frame">
		<img class="training_status_board" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" />
		<img class="training_chara_icon" src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png" />
		<div class="training_rarelty">
			<img class="training_rare" src="{{IMG_URL}}gacha/{{$val['rare']}}.png" />
			<img class="training_rare_bg" src="{{IMG_URL}}battle/rarity_bg.png" />
		</div>
		<div class="training_chara_name">{{$val['name']}}</div>
		<div class="training_chara_hp">{{$val['hp']}}</div>
		<div class="training_chara_goo">{{$val['gooAtk']}}</div>
		<div class="training_chara_cho">{{$val['choAtk']}}</div>
		<div class="training_chara_paa">{{$val['paaAtk']}}</div>
	</div>-->