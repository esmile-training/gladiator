{{var_dump($viewData['BattleData'])}}

<div>
    試合結果
</div>

@if ($viewData['EnmData']['Hp']<=0)
    <div>勝利！</div>
@else
    <div>敗北...</div>
    
<div>
    <a href="<?= APP_URL ?>mypage">
        マイページへ戻る
    </a>
</div>