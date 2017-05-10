{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
    <?php var_dump($viewData)?>
</div>

<div>
	<a href="{{APP_URL}}training">
		訓練所へ
	</a>
</div>

<div>

    <a href="{{APP_URL}}battle/selectBattleChara">
	    キャラクター選択
    </a>
</div>
<div>
    <a href="{{APP_URL}}battle">
	バトルスタンバイ画面
    </a>
</div>

<div>
    <a href="{{APP_URL}}ranking">
	ranking
    </a>
	<a href="{{APP_URL}}gacha/select">
		ガチャ
	</a>
</div>

