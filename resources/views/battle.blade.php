<div>
    <img class="janken" src="{{IMGTEST_URL}}janken.jpg">
</div>

{{--バトル終了のフラグが立っていたら--}}
@if ($viewData['BattleData']['delFlag'] == 1)

    {{--バトルの終了--}}
    @include('element/battleEnd')
    
@else

    {{--バトルの結果が入っていたら--}}
    @if ($viewData['PcData']['result'] != '未設定')

        {{--勝敗の表示--}}
        @include('element/resultLog')

        {{--ダメージログの表示--}}
        @include('element/damageLog')

    @endif
    
    {{--HPの表示--}}
    @include('element/hpLog')

    {{--それぞれのボタン表示--}}
    <form method="get" action="/battle" onsubmit="doSomething();return false;">
    <input type="image" src="{{IMGTEST_URL}}goo.jpg" value="{{$viewData['Type']['goo']}}" name="sub1">　
    <input type="image" src="{{IMGTEST_URL}}choki.png" value="{{$viewData['Type']['cho']}}" name="sub1">　
    <input type="image" src="{{IMGTEST_URL}}paa.jpg" value="{{$viewData['Type']['paa']}}" name="sub1">　
    </form>

@endif