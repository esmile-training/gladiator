@include('common/css', ['file' => 'char'])

<div>
    <?php var_dump ($valueList); ?>
</div>

<div>
    <a href="{{APP_URL}}char">
<form action="{{APP_URL}}gacha" method="get" name="gachaButton">
     <input type="image" src="{{IMG_URL_TEST}}button.png" width="300" height="300">
</form>
    </a>
    {{--画像表示--}}
     <img class="char" src="{{CHAR_IMG_URL}}{{$cid}}.jpg">
</div>