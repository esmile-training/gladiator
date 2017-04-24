<?php
namespace App\Libs;

class BattleLib extends BaseGameLib
{
    // 敵の各属性を出す確率ステータスに基づいた手をランダムに選択する処理
    public static function setEnmHand( $EnemyData, $typeData)
    {
        $result = [];   //データ返却用変数の初期化
	
        // ランダムに1～100の数値を選択し格納
        $Hand = rand(1, 100);
        
        // Hand の数値が EnemyData の 'goo' の確率値 'gooPer' 以下の場合
        if ( $Hand <= $EnemyData['gooPer'])
	{
	    // result に 'goo' を格納
            $result = $typeData['goo'];
        }
        // Hand の数値が EnemyData の 'goo' の確率値 'gooPer' と 'cho' の確率値 'choPer' を足した数以下の場合
        else if($Hand <=  $EnemyData['gooPer'] + $EnemyData['choPer'])
	{
	    // result に 'cho' を格納
            $result = $typeData['cho'];
        }
	// Hand の数値が EnemyData の 'goo' の確率値 'gooPer' と 'cho' の確率値 'choPer' を足した数より大きいの場合
        else
	{
	    // result に 'paa' を格納
            $result = $typeData['paa'];
        }    
        
        return $result;
    }
    
    // バトルの処理を格納する処理
    public static function battleResult( $pcHand, $enmHand, $typeData, $resultData )
    {
        $result = [];   // データ返却用変数の初期化
        
	// Chara の 'hand' によって処理を行う
        switch ( $pcHand )
	{    
	    // 'goo' の場合
            case $typeData['goo']:
		// Enemy の 'hand' によって処理を行う
                switch ( $enmHand )
		{
		    // 'goo' の場合
                    case $typeData['goo']:
			// result に 'draw' を格納
                        $result = $resultData['draw'];
                        break;
		    
		    // 'cho' の場合		    
                    case $typeData['cho']:
			// result に 'win' を格納
                        $result = $resultData['win'];
                        break;
		    
		    // 'paa' の場合		    
                    case $typeData['paa']:
			// result に 'lose' を格納
                        $result = $resultData['lose'];
                        break;

                    default:
                        echo 'エラー';
                        exit;
                }
                break;
	    
	    // 'cho' の場合	    
            case  $typeData['cho']:
		// Enemy の 'hand' によって処理を行う
                switch ( $enmHand )
		{
		    // 'goo' の場合
                    case $typeData['goo']:
			// result に 'lose' を格納
                        $result = $resultData['lose'];
                        break;
		    
		    // 'cho' の場合		    
		    case $typeData['cho']:
			// result に 'draw' を格納
                        $result = $resultData['draw'];
                        break;
		    
		    // 'paa' の場合		    
                    case $typeData['paa']:
			// result に 'win' を格納
                        $result = $resultData['win'];
                        break;
		      
                    default:
                        echo 'エラー';
                        exit;
                }
                break;
	    
	    // 'paa' の場合
            case $typeData['paa']:
		// Enemy の 'hand' によって処理を行う		
                switch ( $enmHand )
		{
		    // 'goo' の場合		
                    case $typeData['goo']:
			// result に 'win' を格納
                        $result = $resultData['win'];
                        break;
		    
		    // 'cho' の場合		    
                    case  $typeData['cho']:
			// result に 'lose' を格納
                        $result = $resultData['lose'];
                        break;
		    
		    // 'paa' の場合		    
                    case $typeData['paa']:
			// result に 'draw' を格納
                        $result = $resultData['draw'];
                        break;
		    
                    default:
                        echo 'エラー';
                        exit;
                }
                break;
	    
            default:
                echo 'エラー';
                exit;
        }
        return $result;
    }
    
    // ダメージ計算を行う処理
    public static function damageCalc( $winner, $loser, $typeData )
    {
	// 勝った方の 'hand' によって処理を行う
        switch( $winner['hand'] )
	{
	    // 'goo' の場合
            case $typeData['goo']:
                $loser['hp'] = $loser['hp'] - $winner['gooAtk'];
                break;
	    
	    // 'cho' の場合	    
            case $typeData['cho']:
                $loser['hp'] = $loser['hp'] - $winner['choAtk'];
                break;
	    
	    // 'paa' の場合    
            case $typeData['paa']:
                $loser['hp'] = $loser['hp'] - $winner['paaAtk'];
                break;
	    
            default;
                exit;
        }
        
        return $loser['hp'];
    }

}