<div>

    @if ($viewData['PcData']['result']=='勝ち')
        @if ($viewData['PcData']['hand']=='グー')
            <div>
                {{$viewData['EnmData']['name']}}
                に
                {{$viewData['PcData']['gooAtk']}}
                のダメージ <br />
            </div>
        @elseif ($viewData['PcData']['hand']=='チョキ')
            <div>
                {{ $viewData['EnmData']['name'] }}
                に
                {{ $viewData['PcData']['choAtk'] }}
                のダメージ <br />
            </div>
        @elseif ($viewData['PcData']['hand']=='パー')
            <div>
                {{ $viewData['EnmData']['name'] }}
                に
                {{ $viewData['PcData']['paaAtk'] }}
                のダメージ <br />
            </div>
        @endif
    @elseif ($viewData['PcData']['result']=='負け')
        @if ($viewData['EnmData']['hand']=='グー')
            <div>
                {{$viewData['PcData']['name']}}
                に
                {{$viewData['EnmData']['gooAtk']}}
                のダメージ <br />
            </div>
        @elseif ($viewData['EnmData']['hand']=='チョキ')
            <div>
                {{ $viewData['PcData']['name'] }}
                に
                {{ $viewData['EnmData']['choAtk'] }}
                のダメージ <br />
            </div>
        @elseif ($viewData['EnmData']['hand']=='パー')
            <div>
                {{ $viewData['PcData']['name'] }}
                に
                {{ $viewData['EnmData']['paaAtk'] }}
                のダメージ <br />
            </div>
        @endif
    @elseif ($viewData['PcData']['result']=='あいこ')
        <div>
            お互いにダメージなし<br />
        </div>
    @endif

</div>