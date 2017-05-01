<div>
    バトルリザルト
</div>

@if ($viewData['EnemyData']['bHp'] <= 0)
<div>
	勝利！
</div>
<div>
	{{$viewData['Prize']}} の賞金を獲得！
</div>
@else
<div>
	敗北...
</div>
@endif

<div>
    <a href="{{APP_URL}}battleStanby">
		バトルスタンバイ画面へ戻る
    </a>
</div>
