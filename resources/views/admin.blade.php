{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

{{-- 画像 --}}
<div>
    <img class="admin_title" src="{{IMG_URL}}title.png">
</div>

{{-- ユーザエディット  --}}
<div class="userEdit">
    <form action="{{APP_URL}}admin/editUser" method="get">
	{{-- ユーザID入力 --}}
	<div>
	    ユーザID：<input type="text" name="userId">
	</div>
	
	{{-- 名前変更 --}}
	<div>
	    <input type="text" name="newName">
	    <input type="submit" name="rename" value="名前変更" onclick="return renameCheck();">
	</div>

	{{-- ユーザ削除 --}}
	<div>
	    <input type="submit" name="delete" value="ユーザ削除" onclick="return deleteCheck();">
	</div>
    </form>
</div>

{{-- 戻る  --}}
<div class="returnLink">
    <a href="{{APP_URL}}top">
	⇒TOPに戻る
    </a>
</div>


{{-- viewParts  --}}
@include('element/memberList')

{{-- popup --}}