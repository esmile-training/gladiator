<div>
    バトルリザルト
</div>

@if ($viewData['Prize'] > 0)
<div>
	勝利！
</div>
<div>
	{{$viewData['Prize']}} の賞金を獲得！
</div>
<div>
	現在のウィークリーポイント　{{$viewData['RankingData']['weeklyAward']}}
</div>
@else
<div>
	敗北...
</div>
@endif

<div>
    <a href="{{APP_URL}}battle/battleStandby">
		バトルスタンバイ画面へ戻る
    </a>
</div>
