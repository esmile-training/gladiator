<div><img class="coachSelect_back" src="{{IMG_URL}}background/almighty.jpg" /></div>
{{--CSS--}}
@include('common/css', ['file' => 'coachSelect'])

<div class="coachSelect_all">
	<div class="coachSelect_signboard_info">
		<img src="{{IMG_URL}}signboard/info.png">
		<div class ="coachSelect_signboard_text">
			<font  class="coachSelect_font_serif">{{'コーチを選んでください'}}</font>
		</div>
	</div>
	<div class="coachSelect_signboard">
		 <img src="{{IMG_URL}}signboard/training.png">
	</div>
	<?php $cnt = 0; ?>
	{{--uCoach(DB)から持ってきたデータの表示--}}
	@foreach($viewData['coachList'] as $val)
		<div class="coach_window">
			{{--訓練中ならグレースケール貼る--}}
			@if($val['state'] == 1)
				<div class ="modal_btn trainingPopup{{$cnt}} training_a_none">
					<div class="scale_img">
						<img class="chara_button_frame_img" src="{{IMG_URL}}/training/coachButton{{$val['rare']}}.png">
					</div>
					{{-- 訓練終了までの時間を算出(できてない) --}}
					@foreach( $viewData['infoData'] as $key => $infoval)
						@if( $infoval['uCoachId'] == $val['id'] )
							<?php
								$endDate	= $infoval['endDate'];
								$nowTime	= $viewData['nowTime'];
								$second[$val['id']] = strtotime($endDate)-strtotime($nowTime);
								$hour[$val['id']]	= (int)($second[$val['id']] / 3600);
								$second[$val['id']]	-= $hour[$val['id']] * 3600;
								$minute[$val['id']]	= (int)($second[$val['id']] / 60);
								$second[$val['id']]	-= $minute[$val['id']] * 60;
							?>
						@endif
					@endforeach
					<div class="traing_time">
						{{str_pad($hour[$val['id']],2,0,STR_PAD_LEFT)}}：{{str_pad($minute[$val['id']],2,0,STR_PAD_LEFT)}}：{{str_pad($second[$val['id']],2,0,STR_PAD_LEFT)}}
					</div>
			@else
				<div class ="modal_btn trainingPopup{{$cnt}}">
			@endif
					<img src="{{IMG_URL}}/training/coachButton{{$val['rare']}}.png">
					<div class="coachSelect_font_serif coach_name">
						<font>{{$val['name']}}</font>
					</div>
					<div class="coach_icon">
						<img src="{{IMG_URL}}/chara/icon/icon_{{$val['imgId']}}.png">
						{{--レアリティの表示--}}
						<img class="coachSelect_reritybg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
						<img class="coachSelect_rerity" src="{{IMG_URL}}gacha/{{$val['rare']}}.png" alt="レアリティ">
					</div>
					<div class="coachSelect_text coach_goo_atk">
						{{$val['gooAtk']}}
					</div>
					<div class="coachSelect_text coach_cho_atk">
						{{$val['choAtk']}}
					</div>
					<div class="coachSelect_text coach_paa_atk">
						{{$val['paaAtk']}}
					</div>
				</div>
			@include('popup/wrap', [
				'class'		=> "trainingPopup{$cnt}", 
				'template'	=> 'coachSelect',
				'data'		=> ['uCoach' => $cnt]
			])

			<div class ="modal_btn atkUpProbabilityPopup{{$cnt}}">
				<div class="atkUpProbabilityPopup">
					<img src="{{IMG_URL}}/training/probabilityButton.png">
				</div>
			</div>
			@include('popup/wrap', [
				'class'		=> "atkUpProbabilityPopup{$cnt}", 
				'template'	=> 'atkUpProbability',
				'data'		=> ['cnt' => $cnt]
			])
		</div>
	<?php $cnt++; ?>
	@endforeach
</div>
