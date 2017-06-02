{{--CSS--}}
@include('common/css', ['file' => 'training'])

<div class="training_signboard">
	 <img src="{{IMG_URL}}/training/signboard.png">
</div>

<?php $cnt = 0; ?>
{{--uCoach(DB)から持ってきたデータの表示--}}
@foreach($viewData['coachList'] as $val)
	<div class="training_coach_window{{$cnt}}">
		<div class ="modal_btn trainingPopup{{$cnt}}">
			<img src="{{IMG_URL}}/training/coachButton.png" value="{{$val['id']}}">
			<div class="training_text training_coach_name">
				<font>{{$val['name']}}</font>
			</div>
			<div class="training_gooprobability_text">
				{{'グー攻撃力'}}
			</div>
			<div class="training_choprobability_text">
				{{'チョキ攻撃力'}}
			</div>
			<div class="training_paaprobability_text">
				{{'パー攻撃力'}}
			</div>

			<div class="training_coach_icon{{$cnt}}">
				<img src="{{IMG_URL}}/chara/icon/icon_{{$val['imgId']}}.png">
				<div class="training_goo_icon">
					<img src="{{IMG_URL}}/chara/status/hand1.png">
				</div>
				<div class="training_text training_coach_goo_atk">
					{{$val['gooAtk']}}
				</div>
				<div class="training_cho_icon">
					<img src="{{IMG_URL}}/chara/status/hand2.png">
				</div>
				<div class="training_text training_coach_cho_atk">
					{{$val['choAtk']}}
				</div>
				<div class="training_paa_icon">
					<img src="{{IMG_URL}}/chara/status/hand3.png">
				</div>
				<div class="training_text training_coach_paa_atk">
					{{$val['paaAtk']}}
				</div>
			</div>
		</div>
	</div>
@include('popup/wrap', [
	'class'		=> "trainingPopup{$cnt}", 
	'template'	=> 'coachSelect',
	'data'		=> ['uCoach' => $cnt]
])
<?php $cnt++; ?>
@endforeach


