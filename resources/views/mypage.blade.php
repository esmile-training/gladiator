{{-- css  --}}
@include('common/css', ['file' => 'mypage'])
<img class="mypage_borad" src="{{IMG_URL}}mypage/mypageboard.png" />
@if(!is_null($viewData['delFlag']['imgId']))
<div class="user_chara">
	<img src="{{IMG_URL}}chara/{{$viewData['delFlag']['imgId']}}.png">
</div>
@endif