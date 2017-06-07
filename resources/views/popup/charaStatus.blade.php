 {{-- CSS --}}
@include('common/css', ['file' => 'charaStatus'])
<div class="rareImg">
	<img src="{{IMG_URL}}gacha/{{$chara['rare']}}.png">
</div>
<div class="light">
	<img src="{{IMG_URL}}gacha/logoflash.png" alt="レアリティの背景">
</div>
<div class="name">
	{{ $chara['name'] }}
</div>

<div>
	<img class="character" src="{{IMG_URL}}chara/{{$chara['imgId']}}.png">
</div>

<div class="param_box">
	<div>
		<div class="icon_img icon_hp"><img src="{{IMG_URL}}chara/status/hp.png"></div>
		<div class="param_text text_hp">{{$chara['hp']}}</div>
		<div class="icon_img icon_goo"><img src="{{IMG_URL}}chara/status/hand1.png"></div>
		<div class="param_text text_goo">{{$chara['gooAtk']}}</div>
		<div class="icon_img icon_cho"><img src="{{IMG_URL}}chara/status/hand2.png"></div>
		<div class="param_text text_cho">{{$chara['choAtk']}}</div>
		<div class="icon_img icon_paa"><img src="{{IMG_URL}}chara/status/hand3.png"></div>
		<div class="param_text text_paa">{{$chara['paaAtk']}}</div>
	</div>
</div>

<div>
	<div class="button">
		@if($chara['trainingState'] == 0)
		<a href="{{APP_URL}}selectCoach/index?id={{$chara['id']}}&rare={{$chara['rare']}}&imgId={{$chara['imgId']}}&iconFrame={{$chara['iconFrame']}}&name={{$chara['name']}}&attribute={{$chara['attribute']}}&hp={{$chara['hp']}}&gooAtk={{$chara['gooAtk']}}&choAtk={{$chara['choAtk']}}&paaAtk={{$chara['paaAtk']}}">
			<img class="image_change" src="{{IMG_URL}}popup/retire_Button.png" alt="引退"/>
		</a>
		@else
		<p>訓練中です</p>
		@endif
	</div>
</div>