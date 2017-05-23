{{-- css  --}}
@include('common/css', ['file' => 'mypage'])

<?php if($viewData['user'] == null) :?>
	<div>nanimonasi</div>
<?php else:?>
<div class="user_chara">
	<img src="{{IMG_URL_CHARA}}{{$viewData['user']['imgId']}}.png">
</div>
	
<?php endif; ?>
