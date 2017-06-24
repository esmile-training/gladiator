{{-- css  --}}
@include('common/css', ['file' => 'mypage'])

{{-- フィーバータイムのフラグを立てる --}}
<?php $act = $viewData['feverTimeFlug'] == 1 ? 'act' : '' ?>

<img class="mypage_board" src="{{IMG_URL}}signboard/myPage.png" />

@if(!is_null($viewData['delFlag']['imgId']))
	{{-- キャラ画像 --}}
	<div class="user_chara">
		<img src="{{IMG_URL}}chara/{{$viewData['delFlag']['imgId']}}.png">
	</div>
@endif

{{-- プレゼントBOX --}}
<a href="{{APP_URL}}presentbox" class="presentbox">
	<img src="{{IMG_URL}}mypage/presentIcon.png">
</a>

{{-- フィーバータイム表示 --}}
<div class="modal_btn feverHelp fever cap2 {{$act}}">
	<img class='fever_img' src="{{IMG_URL}}mypage/feverIcon.png">
	<p class="fever_text"><script>document.write(60 - new Date().getMinutes())</script>分</p>
</div>

<div class="modal feverHelp">
	<div class="modal_top">
		<div class="close editload">
			<img src="{{IMG_URL}}popup/closebutton.png">
			<span>close</span>
		</div>
	</div>
	<img class="modal_middle" src="{{IMG_URL}}mypage/fever_tutorial.png">
</div>

@if($viewData['loginBonusFlag'])
	{{--今日まだログインしていなければログインボーナスのポップアップ表示--}}
	<script>
		$(function ()
		{
			$('.loginBonus').css('display','block');
		});
	</script>

	<div class="modal loginBonus">
		{{--ポップアップウィンドウ--}}
		@include('popup/wrap', [
			'class'		=> 'loginBonus',
			'template'	=> 'loginBonus',
			'data'		=>	['loginBonusData' => $viewData['loginBonus']]
		])
	</div>
@endif

