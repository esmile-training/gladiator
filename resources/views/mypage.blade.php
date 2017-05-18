{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<?php if($viewData['user'] == null) :?>
	<div>nanimonasi</div>
<?php else:?>

{{var_dump($viewData)}}
<div>
	<a href="{{APP_URL}}training">
		訓練所へ
	</a>
</div>

<div>
	<a href="{{APP_URL}}selectChara">
		キャラ
	</a>
    <a href="{{APP_URL}}battle/selectBattleChara">
	    試合
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
<?php endif; ?>
