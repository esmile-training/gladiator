{{-- CSS --}}
@include('common/css', ['file' => 'chara'])

<div class="rareImg">
	<img class="rare" src="{{IMG_URL_GACHA}}{{$chara['rare']}}.png">
</div>

<div class="name">
	{{ $chara['name'] }}
</div>

<div class="character">
	<img class="character" src="{{IMG_URL_CHARA}}{{$chara['imgId']}}.png">
</div>

<div class="status">
		{{$chara['attribute']}}<br>
		体力:{{$chara['hp']}}<br>
		グー:{{$chara['gooAtk']}}<br>
		チョキ:{{$chara['choAtk']}}<br>
		パー:{{$chara['paaAtk']}}<br>
</div>

<div class="retire">
	@if($chara['trainingState'] == 0)
	<div class="button">
		<a href="{{APP_URL}}selectCoach/index?id={{$chara['id']}}&rare={{$chara['rare']}}&imgId={{$chara['imgId']}}&name={{$chara['name']}}&attribute={{$chara['attribute']}}&hp={{$chara['hp']}}&gooAtk={{$chara['gooAtk']}}&choAtk={{$chara['choAtk']}}&paaAtk={{$chara['paaAtk']}}">
			<img src="{{SERVER_URL}}img/popup/popupbutton.png" />
			<p class="text">引退</p>
		</a>
	</div>
	@else
		<p>訓練中です</p>
	@endif
</div>