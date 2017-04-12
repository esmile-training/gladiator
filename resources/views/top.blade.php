{{-- css  --}}
<link href="{{APP_URL}}css/top.css?var={{time()}}" rel="stylesheet" type="text/css">

{{-- 画像 --}}
<div>
    <img class="title" src="{{IMG_URL}}title.png">
</div>

{{-- ハイパーリンク --}}
<div>
    <a href="{{APP_URL}}top/login?uid=123456">
	MYPAGE
    </a>
</div>

{{-- viewParts  --}}
@include('element/memberList')

{{-- popup --}}