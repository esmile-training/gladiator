@include('common/css', ['file' => 'retirementChara'])

<br>
<div class="text">
	{{$viewData['comment']}}
</div>
<br>
<div>
	<a href="{{APP_URL}}selectChara">
		<img class="backButton image_change" src="{{IMG_URL}}popup/back_Button.png" alt="戻る">
	</a>
</div>
