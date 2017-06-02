@include('common/css', ['file' => 'retirementChara'])
<div id='main'>
<br>
<div class="textfont">
	{{$viewData['comment']}}
</div>
<br>
<div>
	<a href="{{APP_URL}}charaSelect">
		<img class="backButton image_change" src="{{IMG_URL}}popup/back_Button.png" alt="戻る">
	</a>
</div>
</div>
