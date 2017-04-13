{{-- css  --}}
@include('common/css', ['file' => 'top'])

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