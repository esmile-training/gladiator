<div>

    @if ( $viewData['PcData']['result'] == $viewData['Result']['win'] )
        @if ( $viewData['PcData']['hand'] == $viewData['Type']['goo'] )
            <div>
                {{$viewData['EnmData']['name']}}
                に
                {{$viewData['PcData']['gooAtk']}}
                のダメージ <br />
            </div>
        @elseif ( $viewData['PcData']['hand'] == $viewData['Type']['cho'] )
            <div>
                {{ $viewData['EnmData']['name'] }}
                に
                {{ $viewData['PcData']['choAtk'] }}
                のダメージ <br />
            </div>
        @elseif ( $viewData['PcData']['hand'] == $viewData['Type']['paa'] )
            <div>
                {{ $viewData['EnmData']['name'] }}
                に
                {{ $viewData['PcData']['paaAtk'] }}
                のダメージ <br />
            </div>
        @endif
    @elseif ( $viewData['PcData']['result'] == $viewData['Result']['lose'] )
        @if ( $viewData['EnmData']['hand'] == $viewData['Type']['goo'] )
            <div>
                {{$viewData['PcData']['cName']}}
                に
                {{$viewData['EnmData']['gooAtk']}}
                のダメージ <br />
            </div>
        @elseif ( $viewData['EnmData']['hand'] == $viewData['Type']['cho'] )
            <div>
                {{ $viewData['PcData']['cName'] }}
                に
                {{ $viewData['EnmData']['choAtk'] }}
                のダメージ <br />
            </div>
        @elseif ( $viewData['EnmData']['hand'] == $viewData['Type']['paa'] )
            <div>
                {{ $viewData['PcData']['cName'] }}
                に
                {{ $viewData['EnmData']['paaAtk'] }}
                のダメージ <br />
            </div>
        @endif
    @elseif ( $viewData['PcData']['result'] == $viewData['Result']['draw'] )
        <div>
            お互いにダメージなし<br />
        </div>
    @endif

</div>