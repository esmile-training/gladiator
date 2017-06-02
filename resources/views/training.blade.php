{{--CSS--}}
@include('common/css', ['file' => 'training'])
@include('common/css', ['file' => 'battleCharaSelect'])

<div class="training_signboard">
	 <img src="{{IMG_URL}}/training/signboard.png">
</div>

<script>
	 var popup = Boolean(<?php echo $viewData['isTrainingEndFlag'] ?>);
	 $(function (){
		 if(popup)
		 {
			$('.trainingResult').css('display','block');
		 }
		 else
		 {
			 $('.trainingResult').css('display','none');
		 }
	 });
</script>

@if($viewData['isTrainingEndFlag'])
	<div class="modal trainingResult">
		{{--ポップアップウィンドウ--}}
		@include('popup/wrap', [
			'class'		=> "trainingResult",
			'template'	=> 'training',
		])
	</div>
@endif

{{--uChara(DB)から持ってきたデータの表示--}}
@foreach( $viewData['charaList'] as $key => $val)
	<div class = "chara_button">
		{{--ボタンの枠--}}
		<div class="chara_frame">
			<a href="{{APP_URL}}training/coachSelect?uCharaId={{$val['id']}}">
				<img class="chara_frame_img" src="{{IMG_URL}}battle/chara_button_frame.png" alt="ボタンの枠">

				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png"
					alt="キャラアイコン">
				</div>

				{{--グー--}}
				<div class="goo_icon">
					<img src="{{IMG_URL}}/chara/status/hand1.png" alt="グーアイコン">
				</div>
				<div class="status_value goo_pos">
					<font>{{$val['gooAtk']}}</font>
				</div>

				{{--チョキ--}}
				<div class="cho_icon">
					<img src="{{IMG_URL}}/chara/status/hand2.png" alt="チョキアイコン">
				</div>
				<div class="status_value cho_pos">
					<font>{{$val['choAtk']}}</font>
				</div>

				{{--パー--}}
				<div class="paa_icon">
					<img src="{{IMG_URL}}/chara/status/hand3.png" alt="チョキアイコン">
				</div>
				<div class="status_value paa_pos">
					<font>{{$val['paaAtk']}}</font>
				</div>

				{{--キャラ名--}}
				<font class="chara_name">{{$val['name']}}</font>
			</a>
		</div>
	</div>
@endforeach