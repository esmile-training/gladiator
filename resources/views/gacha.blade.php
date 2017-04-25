@include('common/css', ['file' => 'char'])
<div>
    <?php var_dump($viewData['name']['firstname']); ?>
    <?php var_dump($viewData['name']['lastname']); ?>
    <?php var_dump('hp',$viewData['valueList']['hp']); ?>
    <?php var_dump('atk1',$viewData['valueList']['atk1']); ?>
    <?php var_dump('atk2',$viewData['valueList']['atk2']); ?>
    <?php var_dump('atk3',$viewData['valueList']['atk3']); ?>
<form action="{{APP_URL}}gacha" method="get" name="gachaButton">
     <input type="image" src="{{IMG_URL_TEST}}button.png" width="100" height="100">
</form>
    </a>
    {{--画像--}}
     <?php var_dump ($viewData['chara']['charaId']); ?>
     <img class="char" src="{{CHAR_IMG_URL}}{{$viewData['chara']['charaId']}}.png">
</div>