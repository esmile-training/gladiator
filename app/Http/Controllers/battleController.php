<?php

namespace App\Http\Controllers;

// Lib
use App\Libs\BattleLib;

class battleController extends BaseGameController
{
    public function index()
    {      
        // ユーザーIDを持ってくる処理
	$userId = $this->viewData['user']['id'];        // 仮置き ユーザーID：5(実際はCocckieから持ってくる)
        
	// config/battle で指定した三すくみの名前を読み込み
	// 'goo' 'cho' 'paa' じゃんけんの三すくみで指定中
	$TypeData = \Config::get( 'battle.typeStr' );
	
	// config/battle で指定した勝敗結果の名前を読み込み
	// 'win' 'lose' 'draw' で指定中
	$ResultData = \Config::get( 'battle.resultStr' );
	
        // バトルに必要なデータをDBから読み込む処理
        if(isset($userId))
	{            
            // ユーザーIDを元にuBattleInfo(DB)からバトルデータを読み込み
            // BattleData にバトルデータを格納
            $BattleData = $this->Model->exec( 'Battle', 'getBattleData', $userId );
 
            // バトルデータを元にuBattleChar(DB)からキャラデータを読み込み
            // ChaaraData に自キャラデータを格納      
            $CharaData = $this->Model->exec( 'Battle', 'getBattleCharaData', $BattleData['uBattleCharaId'] ); 

            // バトルデータを元にuBattleChar(DB)から敵データを読み込み
            // EnemyData に敵キャラデータを格納        
            $EnemyData = $this->Model->exec( 'Battle', 'getBattleEnemyData', $BattleData['uBattleEnemyId'] ); 
        }      
        
        // ボタンが押されたらバトル処理を行う
        if ( isset( $_GET["sub1"] ) )
	{
            // 押されたボタンのデータを Chara の 'hand' に格納  
	    // 'goo' / 'cho' / 'paa' のどれかが入る
            $CharaData['hand'] = htmlspecialchars( $_GET["sub1"], ENT_QUOTES, "UTF-8" );
            
            // 敵キャラデータを元に、Enemy の 'hand' を格納
	    // 'goo' / 'cho' / 'paa' のどれかが入る
            $EnemyData['hand']= BattleLib::setEnmHand( $EnemyData, $TypeData );
            
            // 勝敗処理
	    // 'win' / 'lose' / 'draw' のどれかが入る
            $CharaData['result'] = BattleLib::battleResult( $CharaData['hand'], $EnemyData['hand'], $TypeData, $ResultData );
            
            // ダメージ処理
	    // CharaData の 'result' によって処理を行う
            switch( $CharaData['result'] )
	    {
		// 'win' の場合
                case $ResultData['win']:
		    // 自キャラデータを元にダメージ量を計算		    
		    $CharaData = BattleLib::damageCalc( $CharaData, $TypeData );
		    // 変動したダメージ量を元にダメージ処理後の敵キャラHPを計算		    
                    $EnemyData['hp'] = BattleLib::hpCalc( $CharaData, $EnemyData, $TypeData );
                    break;
		
 		// 'lose' の場合               
                case $ResultData['lose']:
		    // 敵キャラデータを元にダメージ量を計算
		    $EnemyData = BattleLib::damageCalc( $EnemyData, $TypeData );
		    // 変動したダメージ量を元にダメージ処理後の自キャラHPを計算
                    $CharaData['hp'] = BattleLib::hpCalc( $EnemyData, $CharaData, $TypeData );
                    break;
		
                // 'draw' の場合
                case $ResultData['draw']:
                    break;
                
                default;
                    exit;
            }            
        }
	
	// どちらかのHPが0以下になったらバトルフラグを0にする
	if( $EnemyData['hp'] <= 0 || $CharaData['hp'] <= 0 )
	{
	    // BattleData の 'delFlag' を立てる (viewでリザルト画面への遷移判別に使用)
	    $BattleData['delFlag'] = 1;
	    
	    // uBattleInfo の 'delFlag' を立てる処理
	    $this->Model->exec( 'Battle', 'UpdateInfoFlag', array( $BattleData ) ); 
	    // uBattleChara の 'delFlag' を立てる処理
	    $this->Model->exec( 'Battle', 'UpdateCharaFlag', $BattleData['uBattleCharaId'] );
	    // uBattleEnemy の 'delFlag' を立てる処理
	    $this->Model->exec( 'Battle', 'UpdateEnemyFlag', $BattleData['uBattleEnemyId'] ); 
	    
	}

	// バトルキャラデータの更新処理
	// 自キャラデータの更新処理
	$this->Model->exec( 'Battle', 'UpdateBattleCharaData', array( $CharaData ) );
	// 敵キャラデータの更新処理
	$this->Model->exec( 'Battle', 'UpdateBattleEnemyData', array( $EnemyData ) );
	
        // 全てのデータを viewData に渡す
        $this->viewData['BattleData']	= $BattleData;
        $this->viewData['PcData']	= $CharaData;
        $this->viewData['EnmData']	= $EnemyData;
        $this->viewData['Type']		= $TypeData;
        $this->viewData['Result']	= $ResultData;

        return viewWrap( 'battle', $this->viewData );
    }
}