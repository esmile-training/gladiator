<font class = "load">
スキルを発動しますか？</br>
</font>
	<?php
			$charaSkill = \Config::get('chara.imgId');
			$skill = \Config::get('chara.skill');
			$skillNumber = $charaSkill[$charaData['imgId']]['skill'];
	?>
<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/load.js"></script>
<div>				
	<img class = "taisya backload"src = "{{IMG_URL}}battle/taisya.gif">
</div>
<font style ='position: relative;top: 3vw;'  class = "load">
	{{$charaSkill[$charaData['imgId']]['skillName']}}</br>
</font>
<font style = "position: relative; top: 6vw;" class = "load">
	{{$skill[$skillNumber]['effect']}}
</font>
<div class="skill_button">
	<a href="{{APP_URL}}battle/updateBattleData?hand=4" class = "load">
		<img class="image_change load" src="{{IMG_URL}}popup/yes_Button.png">
	</a>
</div>