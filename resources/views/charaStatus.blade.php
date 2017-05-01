<dib>
	<img class="rate" src="{{IMG_URL_TEST}}{{$_GET['rare']}}.png"width= 15% height= 15%><br>
	<img class="char" src="{{CHAR_IMG_URL}}{{$_GET['imgId']}}.png"width= 15% height= 15%><br>
	<?PHP			
		echo urldecode($_GET['name']).'<br>';
		echo $_GET['attribute'].'<br>';
		echo '体力:'.$_GET['hp'].'<br>';
		echo '攻(斬)'.$_GET['gooAtk'].'<br>';
		echo '攻(打)'.$_GET['choAtk'].'<br>';
		echo '攻(貫)'.$_GET['paaAtk'].'<br>';
	 ?>
	<form action="retirementChara/searchCoach" method="get">
		<input type="hidden" name="id" value=<?php echo $_GET['id'] ?>>
		<input type="hidden" name="rare" value=<?php echo $_GET['rare'] ?>>
		<input type="hidden" name="imgId" value=<?php echo $_GET['imgId'] ?>>
		<input type="hidden" name="name" value=<?php echo urldecode($_GET['name']); ?>>
		<input type="hidden" name="attribute" value=<?php echo $_GET['attribute'] ?>>
		<input type="hidden" name="hp" value=<?php echo $_GET['hp'] ?>>
		<input type="hidden" name="gooAtk" value=<?php echo $_GET['gooAtk'] ?>>
		<input type="hidden" name="choAtk" value=<?php echo $_GET['choAtk'] ?>>
		<input type="hidden" name="paaAtk" value=<?php echo $_GET['paaAtk'] ?>>
		<input type="submit" value="引退" >
	</form>
	<?php //ポップアップを閉じるボタンになる予定 ?>
	<button type="button" onclick="history.back()">閉じる</button>
</dib>
