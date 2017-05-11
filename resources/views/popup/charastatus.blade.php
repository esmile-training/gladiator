<div>
	<img class="rate" src="{{IMG_URL_TEST}}{{$chara['rare']}}.png"width= 5% height= 5%><br>
	<img class="char" src="{{CHAR_IMG_URL}}{{$chara['imgId']}}.png"width= 15% height= 15%><br>
	<?PHP			
		echo $chara['name'].'<br>';
		echo $chara['attribute'].'<br>';
		echo '体力:'.$chara['hp'].'<br>';
		echo '攻(斬)'.$chara['gooAtk'].'<br>';
		echo '攻(打)'.$chara['choAtk'].'<br>';
		echo '攻(貫)'.$chara['paaAtk'].'<br>';
	 ?>
	<form action="SelectCoach/index" method="get">
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
</div>