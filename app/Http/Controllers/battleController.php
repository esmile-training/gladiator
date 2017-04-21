<?php

namespace App\Http\Controllers;

// Lib
use App\Libs\BattleLib;

class battleController extends BaseGameController
{
    public function index()
    {      

        // ユーザーIDを持ってくる処理を入れる
	$userId = 2;        // 仮置き ユーザーID：2
        
        // バトルに必要なデータをDBから読み込む
        if(isset($userId)){
            
            // ユーザーIDを元にuBattleInfo(DB)からバトルデータを読み込み
            // $BattleDataにバトルデータを入れる
            $BattleData = $this->Model->exec('Battle','getBattleData',$userId); 
            
            // バトルデータを元にuBattleChar(DB)からキャラデータを読み込み
            // $ChaaraDataに自キャラデータを入れる            
            $CharaData = $this->Model->exec('Battle','getBattleCharaData',$BattleData['uBattleCharaId']); 

            // バトルデータを元にuBattleChar(DB)から敵データを読み込み
            // $EnemyDataに敵キャラデータを入れる            
            $EnemyData = $this->Model->exec('Battle','getBattleEnemyData',$BattleData['uBattleEnemyId']); 
            
        }      
        
        // ボタンが押されたらバトル処理を行う
        if (isset($_GET["sub1"])) {
            
            // 押されたボタンのデータをplayersConf['Hand']に格納            
            $CharaData['hand'] = htmlspecialchars($_GET["sub1"], ENT_QUOTES, "UTF-8");
            
            // 敵キャラデータを元に、敵の出す手を選択
            $EnemyData['hand']= BattleLib::setEnmHand( $EnemyData );
            
            // 勝敗処理
            $CharaData['result'] = BattleLib::battleResult($CharaData['hand'],$EnemyData['hand']);
            
            // ダメージ処理
            switch($CharaData['result']){
                
                case '勝ち':
                    $EnemyData['hp'] = BattleLib::damagecalc($CharaData,$EnemyData);
                    break;
                
                case '負け':
                    $CharaData['hp'] = BattleLib::damagecalc($EnemyData,$CharaData);
                    break;
                
                case 'あいこ':
                    break;
                
                default;
                    exit;
            }            
            
            // どちらかのHPが0以下になったらバトルフラグを0にする
            if($EnemyData['hp'] <= 0 || $CharaData['hp'] <= 0){
                
                $BattleData['delFlag'] = 1;
                $this->Model->exec('Battle','UpdateBattleFlag',$BattleData['id']); 
                
            }
                
            // バトルキャラデータの上書き処理
            $this->Model->exec('Battle','UpdateBattleCharData',array($CharaData['id'],$CharaData['hp'])); 
            $this->Model->exec('Battle','UpdateBattleEnemyData',array($EnemyData['id'],$EnemyData['hp']));         
            
        }         
        
        // Livraly
        $Data->viewData['BattleData']=$BattleData;
        $Data->viewData['PcData']=$CharaData;
        $Data->viewData['EnmData']=$EnemyData;
       
        return viewWrap('battle', $Data->viewData);        
    }
}