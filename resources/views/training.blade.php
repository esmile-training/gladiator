{{--CSS--}}
@include('common/css', ['file' => 'training'])
@include('common/css', ['file' => 'battleCharaSelect'])

<div class="training_signboard_info">
	<img src="{{IMG_URL}}/training/signboard_info.png">
	<div class ="training_signboard_text">
		<font  class="training_text">{{'訓練する剣闘士を選んでください'}}</font>
	</div>
</div>

<div class="training_signboard">
	<img src="{{IMG_URL}}/training/signboard.png">
</div>

{{--訓練が終了しているキャラがいたらポップアップ表示--}}
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
<div class="training_charalist">
	@foreach( $viewData['charaList'] as $key => $val)
	<div class="button_margin ">
		{{--ボタンの枠--}}
		<div class="chara_button icon_frame">
			{{--訓練中ならグレースケール貼る--}}
			@if($val['trainingState'] == 1)
			<a class="training_a_none" href="{{APP_URL}}training/coachSelect?uCharaId={{$val['id']}}">
				<div class="scale_img"><img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" alt="ボタンの枠"></div>
			@else
			<a href="{{APP_URL}}training/coachSelect?uCharaId={{$val['id']}}">
			@endif
				<img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" alt="ボタンの枠">

				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png" alt="キャラアイコン">
					{{--レアリティの表示--}}
					<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
					<img class="rarity" src="{{IMG_URL}}gacha/{{$val['rare']}}.png" alt="レアリティ">
				</div>
				
				{{--キャラクターのステータス表示--}}
				<div class="chara_status">
					{{--HP--}}
					<font class="hp_value font_sentury">{{$val['hp']}}</font>
					{{--グー--}}
					<font class="goo_value font_sentury">{{$val['gooAtk']}}</font>
					{{--チョキ--}}
					<font class="cho_value font_sentury">{{$val['choAtk']}}</font>
					{{--パー--}}
					<font class="paa_value font_sentury">{{$val['paaAtk']}}</font>
					{{--キャラ名--}}
					<font class="chara_name font_sentury">{{$val['name']}}</font>
				</div>
			</a>
		</div>
	</div>
	@endforeach
</div>
