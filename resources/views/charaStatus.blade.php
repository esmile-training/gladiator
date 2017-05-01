<dib>
	<img class="rate" src="{{IMG_URL_TEST}}{{$_GET['rare']}}.png"width= 15% height= 15%><br>
	<img class="char" src="{{CHAR_IMG_URL}}{{$_GET['imgId']}}.png"width= 15% height= 15%><br>
	<?PHP			
		echo urldecode($_GET['name']).'<br>';
		echo $_GET['rare'].'<br>';
		echo $_GET['attribute'].'<br>';
		echo '体力:'.$_GET['hp'].'<br>';
		echo '攻(斬)'.$_GET['gooAtk'].'<br>';
		echo '攻(打)'.$_GET['choAtk'].'<br>';
		echo '攻(貫)'.$_GET['paaAtk'].'<br>';
	 ?>
	<form action="retirementChara/index" method="get">
		<input type="submit" value="引退" >
	</form>
	<?php //ポップアップを閉じるボタンになる予定 ?>
	<button type="button" onclick="history.back()">閉じる</button>
</dib>
