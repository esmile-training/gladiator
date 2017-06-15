スキルを発動しますか？</br>

	<?php
			$charaSkill = \Config::get('chara.imgId');
			$skill = \Config::get('chara.skill');
			$skillNumber = $charaSkill[$charaData['imgId']]['skill'];
	?>
<font style = "position: relative; top: 6vw;">
	{{$skill[$skillNumber]['effect']}}
</font>
<div class="skill_button">
	<a href="{{APP_URL}}battle/updateBattleData?hand=4">
		<img class="image_change" src="{{IMG_URL}}popup/yes_Button.png">
	</a>
</div>