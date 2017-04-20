<div>

    @if ($viewData['PcData']['Result']=='勝ち')
        @if ($viewData['PcData']['Hand']=='グー')
            <div>
                {{$viewData['EnmData']['Name']}}
                に
                {{$viewData['PcData']['GooAtk']}}
                のダメージ <br />
            </div>
        @elseif ($viewData['PcData']['Hand']=='チョキ')
            <div>
                {{ $viewData['EnmData']['Name'] }}
                に
                {{ $viewData['PcData']['ChoAtk'] }}
                のダメージ <br />
            </div>
        @elseif ($viewData['PcData']['Hand']=='パー')
            <div>
                {{ $viewData['EnmData']['Name'] }}
                に
                {{ $viewData['PcData']['PaaAtk'] }}
                のダメージ <br />
            </div>
        @endif
    @elseif ($viewData['PcData']['Result']=='負け')
        @if ($viewData['EnmData']['Hand']=='グー')
            <div>
                {{$viewData['PcData']['Name']}}
                に
                {{$viewData['EnmData']['GooAtk']}}
                のダメージ <br />
            </div>
        @elseif ($viewData['EnmData']['Hand']=='チョキ')
            <div>
                {{ $viewData['PcData']['Name'] }}
                に
                {{ $viewData['EnmData']['ChoAtk'] }}
                のダメージ <br />
            </div>
        @elseif ($viewData['EnmData']['Hand']=='パー')
            <div>
                {{ $viewData['PcData']['Name'] }}
                に
                {{ $viewData['EnmData']['PaaAtk'] }}
                のダメージ <br />
            </div>
        @endif
    @elseif ($viewData['PcData']['Result']=='あいこ')
        <div>
            お互いにダメージなし<br />
        </div>
    @endif

</div>