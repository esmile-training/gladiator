{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
    <a href="{{APP_URL}}training">
	訓練所へ
    </a>
</div>

<div>
    <a href="{{APP_URL}}selectChara/index">
	    キャラクター選択
    </a>
</div>
<div>
    <a href="{{APP_URL}}gachaselect">
	ガチャ
    </a>
</div>

<div>
    <a href="{{APP_URL}}ranking">
	ranking
    </a>
</div>

