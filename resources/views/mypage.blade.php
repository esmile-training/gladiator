<div>
    <?php var_dump($viewData); ?>
</div>


{{-- 名前変更 --}}
<form action="{{APP_URL}}mypage/setUserName" method="get">
    <input type="text" name="newName">
    <input type="hidden" name="userId" value="{{$viewData['user']['id']}}">
    <input type="submit" value="名前変更">
</form>