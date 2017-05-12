<div>
    {{ $viewData['CharaData']['name'] }}
    は    
    {{ $viewData['Type'][$viewData['CharaData']['hand']] }}
    を出した！<br />
    {{ $viewData['EnemyData']['name'] }}
    は    
    {{ $viewData['Type'][$viewData['EnemyData']['hand']] }}
    を出した！<br />
    
    結果は{{ $viewData['CharaData']['result'] }}！<br />
</div>
