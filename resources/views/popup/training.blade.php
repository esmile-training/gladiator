<div class="training_init">
	{{'訓練が完了しました!'}}<br>
	@foreach($viewData['endTrainingChara'] as $val)
	
	<div class="training_chara_frame">
		<img class="training_chara_board" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" />
		<div class="training_chara">
<!--			<img class="training_status_board" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" />-->
			<img class="training_chara_icon" src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png" />
			<div class="training_rare_frame">
				<img class="training_chara_rare" src="{{IMG_URL}}gacha/{{$val['rare']}}.png" />
				<img class="training_chara_rare_bg" src="{{IMG_URL}}battle/rarity_bg.png" />
			</div>
		</div>

		<div class="training_chara_name">{{$val['name']}}</div>
		
		<div class="training_status">
			<ul>
				<li class="training_list">{{$val['hp']}}</li>
				<li class="training_list">{{$val['gooAtk']}}</li>
				<li class="training_list">{{$val['choAtk']}}</li>
				<li class="training_list">{{$val['paaAtk']}}</li>
			</ul>
		</div>
	</div>

	@endforeach
</div>

