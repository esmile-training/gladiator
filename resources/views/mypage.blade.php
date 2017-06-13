{{-- css  --}}
@include('common/css', ['file' => 'mypage'])
<img class="mypage_board" src="{{IMG_URL}}mypage/mypageboard.png" />
@if(!is_null($viewData['delFlag']['imgId']))
<div class="user_chara">
	<img src="{{IMG_URL}}chara/{{$viewData['delFlag']['imgId']}}.png">
</div>
<div class="test">
	<img src="{{IMG_URL}}training/presentIcon.png">
</div>
<?php $act = $viewData['feverTimeFlug'] == 1 ? 'act' : '' ?>
<div class="fever cap {{$act}}">
	<img class='fever_img' src="{{IMG_URL}}battle/feverIcon.png">
	<p class="fever_text"><script>document.write(60 - new Date().getMinutes())</script>分</p>
</div>
@endif
