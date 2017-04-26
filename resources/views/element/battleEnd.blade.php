<div>
    試合結果
</div>

@if ($viewData['EnmData']['hp']<=0)
<div>勝利！</div>
@else
<div>敗北...</div>
@endif

<div>
    <a href="{{APP_URL}}battleStanby">
		バトルスタンバイ画面
    </a>
</div>