<div>
    <img class="janken" src="{{IMGTEST_URL}}janken.jpg">
</div>

{{--バトルフラグが1だったら--}}
@if ($viewData['BattleData']['Flag'] == 1)

    {{--バトルの結果が入っていたら--}}
    @if ($viewData['PcData']['Result']!='未設定')
    
        {{--勝敗の表示--}}
        @include('element/resultLog')

        {{--ダメージログの表示--}}
        @include('element/damageLog')

    @endif
    
    {{--HPの表示--}}
    @include('element/hpLog')

    {{--それぞれのボタン表示--}}
    <form method="get" action="/battle" onsubmit="doSomething();return false;">
    <input type="image" src="{{IMGTEST_URL}}goo.jpg" value="グー" name="sub1">　
    <input type="image" src="{{IMGTEST_URL}}choki.png" value="チョキ" name="sub1">　
    <input type="image" src="{{IMGTEST_URL}}paa.jpg" value="パー" name="sub1">　
    </form>

{{--バトルフラグが0だったら--}}
@elseif($viewData['BattleData']['Flag'] == 0)
    
    {{--バトルの終了画面表示--}}
    @include('element/battleEnd')
    
@endif