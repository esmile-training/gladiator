<div>
		<h3>訓練時間を選択してください</h3>
</div>
<div>
	<script type="text/javascript">	
		var uCoachHp	= 0;
		var trainingFee = 0;

		$(function()
		{
			uCoachHp	= <?php echo $viewData['coachList'][$uCoach]['hp']; ?>;
			trainingFee = uCoachHp * 10;
			<?php
				$trainingFee = '<script type="text/javascript">document.write(trainingFee);</script>';
				echo $trainingFee;
			?>
		});

		function feeCalcuration{{$cnt}}(select)
		{
			var time		= select.value;
			uCoachHp	= <?php echo $viewData['coachList'][$uCoach]['hp']; ?>;
			trainingFee = uCoachHp * 10 *  time * (100 - (time - 1) * 3) / 100;
			<?php
				$trainingFee = '<script type="text/javascript">document.write(trainingFee);</script>';
				echo $trainingFee;
			?>
		}
	</script>
</div>

<form name="trainingInfo" action="{{APP_URL}}training/infoSet" method="get">
	<select name="trainingTime" onchange="feeCalcuration{{$cnt}}(this)">
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
		<option>7</option>
		<option>8</option>
		<option>9</option>
		<option>10</option>
	</select>
	
	<div class="training_submit">
		<img src="{{IMG_URL}}/popup/ok_Button.png">
	</div>
	<input type = "hidden" name = "uCoachId" value = "{{$viewData['coachList'][$uCoach]['id']}}">
	<input type = "hidden" name = "uCharaId" value = "{{$viewData['uCharaId']}}">
	<input type = "hidden" name = "uCoachHp" value = "{{$viewData['coachList'][$uCoach]['hp']}}">
</form>
