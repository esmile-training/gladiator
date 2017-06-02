<div class="training_text">
	{{'訓練時間を選択してください'}}
</div>

<div>
	<script type="text/javascript">	
		var uCoachHp		= 0;
		var trainingFee		= 0;

		$(function()
		{
			uCoachHp	= <?php echo $viewData['coachList'][$uCoach]['hp']; ?>;
			trainingFee = uCoachHp * 10;
			
			trainingFee{{$cnt}}				= document.getElementById("trainingFee{{$cnt}}");
			trainingFee{{$cnt}}.innerHTML	= trainingFee;
		});

		function feeCalcuration{{$cnt}}(select)
		{
			var time	= select.value;
			uCoachHp	= <?php echo $viewData['coachList'][$uCoach]['hp']; ?>;
			trainingFee = uCoachHp * 10 * time * (100 - (time - 1) * 3) / 100;
			
			trainingFee{{$cnt}}				= document.getElementById("trainingFee{{$cnt}}");
			trainingFee{{$cnt}}.innerHTML	= trainingFee;
		}
	</script>
</div>

<body>
	<div class ="training_fee_img">
		<img src="{{IMG_URL}}/header/money.png">
	</div>
	<div class="training_first_probability_text">
		{{'初回強化成功率'}}
	</div>
	<div class="training_text">
		<p id="trainingFee{{$cnt}}" class="training_fee_text"><p>
	</div>
</body>

<div class="training_popup_goo_icon">
	<img src="{{IMG_URL}}/chara/status/hand1.png">
</div>

<div class="training_popup_cho_icon">
	<img src="{{IMG_URL}}/chara/status/hand2.png">
</div>

<div class="training_popup_paa_icon">
	<img src="{{IMG_URL}}/chara/status/hand3.png">
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
	
	<input class="training_submit" type="image" src="{{IMG_URL}}/popup/ok_Button.png">
	
	<input type = "hidden" name = "uCoachId" value = "{{$viewData['coachList'][$uCoach]['id']}}">
	<input type = "hidden" name = "uCharaId" value = "{{$viewData['uCharaId']}}">
	<input type = "hidden" name = "uCoachHp" value = "{{$viewData['coachList'][$uCoach]['hp']}}">
</form>
