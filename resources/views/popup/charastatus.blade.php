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
	<?PHP
		echo $chara['attribute'].'<br>';
		echo '体力:'.$chara['hp'].'<br>';
		echo 'グー:'.$chara['gooAtk'].'<br>';
		echo 'チョキ:'.$chara['choAtk'].'<br>';
		echo 'パー:'.$chara['paaAtk'].'<br>'; 
	?>
</div>

<div class="retire">
	<?php if($chara['trainingState'] == 0) {?>
		<a href="{{APP_URL}}selectCoach?id={{$chara['id']}}&rare={{$chara['rare']}}&imgId={{$chara['imgId']}}&name={{$chara['name']}}&attribute={{$chara['attribute']}}&hp={{$chara['hp']}}&gooAtk={{$chara['gooAtk']}}&choAtk={{$chara['choAtk']}}&paaAtk={{$chara['paaAtk']}}">引退</a>	
	<?php } else { echo '<br>'.'訓練中です'; }?>
</div>