{{-- css  --}}
@include('common/css', ['file' => 'mypage'])

<img class="mypage_borad" src="{{IMG_URL}}mypage/mypageboard.png" />
@if(1 <= $viewData['delFlag']['count'])
<div class="user_chara">
	<img src="{{IMG_URL_CHARA}}{{$viewData['user']['imgId']}}.png">
</div>
@endif