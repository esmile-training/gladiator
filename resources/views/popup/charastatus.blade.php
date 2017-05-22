{{-- CSS --}}
@include('common/css', ['file' => 'chara'])

<div  Align="leftt">
	<img class="rare" src="{{IMG_URL_GACHA}}{{$chara['rare']}}.png">
</div>
<div>
	<img class="character" src="{{IMG_URL_CHARA}}{{$chara['imgId']}}.png">
</div>
	<?PHP
		echo $chara['name'].'<br>';
		echo $chara['attribute'].'<br>';
		echo '体力:'.$chara['hp'].'<br>';
		echo 'グー:'.$chara['gooAtk'].'<br>';
		echo 'チョキ:'.$chara['choAtk'].'<br>';
		echo 'パー:'.$chara['paaAtk'].'<br>';
	 if($chara['trainingState'] == 0) {?>
	<form action="{{APP_URL}}selectCoach" method="get">
		<input type="hidden" name="id" value=<?php echo $chara['id'] ?>>
		<input type="hidden" name="rare" value=<?php echo $chara['rare'] ?>>
		<input type="hidden" name="imgId" value=<?php echo $chara['imgId'] ?>>
		<input type="hidden" name="name" value=<?php echo $chara['name']; ?>>
		<input type="hidden" name="attribute" value=<?php echo $chara['attribute'] ?>>
		<input type="hidden" name="hp" value=<?php echo $chara['hp'] ?>>
		<input type="hidden" name="gooAtk" value=<?php echo $chara['gooAtk'] ?>>
		<input type="hidden" name="choAtk" value=<?php echo $chara['choAtk'] ?>>
		<input type="hidden" name="paaAtk" value=<?php echo $chara['paaAtk'] ?>>
		<input type="submit" value="引退" >
	</form>
	 <?php } else { echo '<br>'.'訓練中です'; }?>