{{-- CSS --}}
@include('common/css', ['file' => 'charaStatus'])

<div class="rareImg">
	<img class="rare" src="{{IMG_URL_GACHA}}{{$chara['rare']}}.png">
</div>

<div class="name">
	{{ $chara['name'] }}
</div>

<div class="character">
	<img class="character" src="{{IMG_URL_CHARA}}{{$chara['imgId']}}.png">
</div>

<div class="test_div">
	<div class="test_img img_1"><img src="{{IMG_URL}}chara/status/hp.png"></div>
	<div class="test_text text_1">{{$chara['hp']}}</div>
	<div class="test_img img_2"><img src="{{IMG_URL}}chara/status/hand1.png"></div>
	<div class="test_text text_2">{{$chara['gooAtk']}}</div>
	<div class="test_img img_3"><img src="{{IMG_URL}}chara/status/hand2.png"></div>
	<div class="test_text text_3">{{$chara['choAtk']}}</div>
	<div class="test_img img_4"><img src="{{IMG_URL}}chara/status/hand3.png"></div>
	<div class="test_text text_4">{{$chara['paaAtk']}}</div>
</div>

<div class="retire">
	@if($chara['trainingState'] == 0)
	<div class="button">
		<a href="{{APP_URL}}selectCoach/index?id={{$chara['id']}}&rare={{$chara['rare']}}&imgId={{$chara['imgId']}}&name={{$chara['name']}}&attribute={{$chara['attribute']}}&hp={{$chara['hp']}}&gooAtk={{$chara['gooAtk']}}&choAtk={{$chara['choAtk']}}&paaAtk={{$chara['paaAtk']}}">
			<img class="image_change" src="{{SERVER_URL}}img/popup/retire_Button.png" alt="引退"/>
		</a>
	</div>
	@else
		<p>訓練中です</p>
	@endif
</div>