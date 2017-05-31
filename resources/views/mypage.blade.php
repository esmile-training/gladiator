{{-- css  --}}
@include('common/css', ['file' => 'mypage'])

@if($viewData['user']['imgId'] == null)
	
@else
<img class="mypage_borad" src="{{IMG_URL}}ranking/mypagegboard.png" />
<div class="user_chara">
	<img src="{{IMG_URL_CHARA}}{{$viewData['user']['imgId']}}.png">
</div>
@endif
