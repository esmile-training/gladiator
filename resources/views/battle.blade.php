{{-- サイズ等指定 --}}
@include('common/battle')

<div>
    <img class="janken" src="{{IMG_URL_TEST}}janken.jpg">
</div>

{{--攻撃の結果が入っていたら--}}
@if ($viewData['CharaData']['result'] != 0)

	{{--勝敗の表示--}}
	@include('element/resultLog')

	{{--ダメージログの表示--}}
	@include('element/damageLog')

@endif

{{--HPの表示--}}
@include('element/hpLog')

{{--バトル終了のフラグが立っていたら--}}
@if ($viewData['BattleData']['delFlag'] == 1)
		
	<div>
		<a href="{{APP_URL}}battle/makeResultData">
			バトルリザルト画面へ
		</a>
	</div>

{{--立っていなければ次の攻撃の受け付け--}}
@else

	{{--それぞれのボタン表示--}}
	<form method="get" action="{{APP_URL}}battle/updateBattleData" onsubmit="doSomething();return false;">
		<input type="image" src="{{IMG_URL_TEST}}goo.jpg" value="1" name="sub1">　
		<input type="image" src="{{IMG_URL_TEST}}choki.png" value= "2" name="sub1">　
		<input type="image" src="{{IMG_URL_TEST}}paa.jpg" value= "3" name="sub1">　
	</form>

@endif