<div>

    @if ($viewData['PcData']['Result']==='勝ち')
        @if ($viewData['PcData']['Hand']==='グー')
            <div>
                {{$viewData['EnmData']['Name']}}
                に
                {{$viewData['PcData']['RockAtk']}}
                のダメージ <br />
            </div>
        @elseif ($viewData['PcData']['Hand']==='チョキ')
            <div>
                {{ $viewData['EnmData']['Name'] }}
                に
                {{ $viewData['PcData']['ScissAtk'] }}
                のダメージ <br />
            </div>
        @elseif ($viewData['PcData']['Hand']==='パー')
            <div>
                {{ $viewData['EnmData']['Name'] }}
                に
                {{ $viewData['PcData']['PaperAtk'] }}
                のダメージ <br />
            </div>
        @endif
    @elseif ($viewData['PcData']['Result']==='負け')
        @if ($viewData['EnmData']['Hand']==='グー')
            <div>
                {{$viewData['PcData']['Name']}}
                に
                {{$viewData['EnmData']['RockAtk']}}
                のダメージ <br />
            </div>
        @elseif ($viewData['EnmData']['Hand']==='チョキ')
            <div>
                {{ $viewData['PcData']['Name'] }}
                に
                {{ $viewData['EnmData']['ScissAtk'] }}
                のダメージ <br />
            </div>
        @elseif ($viewData['EnmData']['Hand']==='パー')
            <div>
                {{ $viewData['PcData']['Name'] }}
                に
                {{ $viewData['EnmData']['PaperAtk'] }}
                のダメージ <br />
            </div>
        @endif
    @elseif ($viewData['PcData']['Result']==='あいこ')
        <div>
            お互いにダメージなし<br />
        </div>
    @endif

</div>