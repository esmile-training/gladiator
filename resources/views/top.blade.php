{{-- css  --}}
@include('common/css', ['file' => 'top'])

{{-- 画像 --}}
<div>
    <img class="title" src="{{IMG_URL}}title.png">
</div>

{{-- ハイパーリンク --}}
<div>
    <a href="{{APP_URL}}top/login?uid=123456">
	ログイン
    </a>
</div>

{{-- ユーザ削除 --}}
<form action="{{APP_URL}}top/deleteUser" method="get">
    <input type="text" name="userId">
    <input type="submit" value="削除">
</form>


{{-- viewParts  --}}
@include('element/memberList')

{{-- popup --}}