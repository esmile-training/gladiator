{{--CSS--}}
@include('common/css', ['file' => 'training'])
@include('common/css', ['file' => 'battleCharaSelect'])

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
	<div class="icon_frame">
		@if($val['trainingState'] == 1)
			<a class="training_a_none" href="{{APP_URL}}training/coachSelect?uCharaId={{$val['id']}}">
			<div class="scale_img"><img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" alt="ボタンの枠"></div>
		@else
			<a href="{{APP_URL}}training/coachSelect?uCharaId={{$val['id']}}">
		@endif
			<img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" alt="ボタンの枠">

			{{--キャラアイコン--}}
			<div class="chara_icon">
				<img src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png"
				alt="キャラアイコン">
			</div>
			<div class="chara_status">
				{{--グー--}}
				<div class="font_serif goo_value">
					<font>{{$val['gooAtk']}}</font>
				</div>

				{{--チョキ--}}
				<div class="font_serif cho_value">
					<font>{{$val['choAtk']}}</font>
				</div>

				{{--パー--}}
				<div class="font_serif paa_value">
					<font>{{$val['paaAtk']}}</font>
				</div>

				{{--キャラ名--}}
				<font class="font_sentury chara_name">{{$val['name']}}</font>
			</div>
		</a>
	</div>
@endforeach
</div>
