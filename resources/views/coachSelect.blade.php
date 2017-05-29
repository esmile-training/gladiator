@include('common/css', ['file' => 'training'])

{{--element/coachListから呼び出し--}}
<div>
	<h3>コーチを選んでください。</h3>
</div>
<?php $cnt = 0; ?>

{{--uCoach(DB)から持ってきたデータの表示--}}
@foreach($viewData['coachList'] as $val)
	<div class="training_coach_window{{$cnt}}">
		<img src="{{IMG_URL}}/training/coachButton.png" class = "modal_btn trainingPopup{{$cnt}}" value="{{$val['id']}}">
		<div class="training_coach_name">
			{{$val['name']}}
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
				<img src="{{IMG_URL}}/battle/hand1.png">
			</div>
			<div class="training_goo_probability">
				{{$val['gooAtk']}}
			</div>
			<div class="training_cho_icon">
				<img src="{{IMG_URL}}/battle/hand2.png">
			</div>
			<div class="training_cho_probability">
				{{$val['choAtk']}}
			</div>
			<div class="training_paa_icon">
				<img src="{{IMG_URL}}/battle/hand3.png">
			</div>
			<div class="training_paa_probability">
				{{$val['paaAtk']}}
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


