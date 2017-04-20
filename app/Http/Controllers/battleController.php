<?php

namespace App\Http\Controllers;

//Model
use App\Model\UserBattleModel;

// Lib
use App\Libs\EnemyLib;
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
            $BattleData = $this->Model->exec('UserBattle','getByBattleData',$userId); 
            
            // バトルデータを元にuBattleChar(DB)からキャラデータを読み込み
            $uBattleCharData = $this->Model->exec('UserBattle','getByuBattleCharData',$BattleData['uBattleCharId']); 

            // バトルデータを元にuBattleChar(DB)から敵データを読み込み
            $uBattleEnemyData = $this->Model->exec('UserBattle','getByuBattleEnemyData',$BattleData['uBattleEnemyId']); 
            
        }
        
        // ボタンが押されたらバトル処理を行う
        if (isset($_GET["sub1"])) {
            
            // 押されたボタンのデータをplayersConf['Hand']に格納            
            $uBattleCharData['Hand'] = htmlspecialchars($_GET["sub1"], ENT_QUOTES, "UTF-8");
            
            // 敵キャラデータを元に、敵の出す手を選択
            $uBattleEnemyData['Hand']= EnemyLib::setEnmHand( $uBattleEnemyData );
            
            // 勝敗処理
            $uBattleCharData['Result'] = BattleLib::battleResult($uBattleCharData['Hand'],$uBattleEnemyData['Hand']);
            
            // ダメージ処理
            switch($uBattleCharData['Result']){
                case '勝ち':
                    $uBattleEnemyData['Hp'] = BattleLib::damagecalc($uBattleCharData,$uBattleEnemyData);
                    break;
                case '負け':
                    $uBattleCharData['Hp'] = BattleLib::damagecalc($uBattleEnemyData,$uBattleCharData);
                    break;
                case 'あいこ':
                    break;
                default;
                    exit;
            }
            
            // どちらかのHPが0以下になったらバトルフラグを0にする
            if($uBattleEnemyData['Hp'] <= 0 || $uBattleCharData['Hp'] <= 0){
                
                $BattleData['Flag']=0;
                $this->Model->exec('UserBattle','UpdateuBattleFlag',$BattleData['id']); 
                
            }
                
                
            // バトルキャラデータの上書き処理
            $this->Model->exec('UserBattle','UpdateuBattleCharData',array($uBattleCharData['id'],$uBattleCharData['Hp'])); 
            $this->Model->exec('UserBattle','UpdateuBattleEnemyData',array($uBattleEnemyData['id'],$uBattleEnemyData['Hp']));         
            
        }
        
        // Livraly
        $Data->viewData['BattleData']=$BattleData;
        $Data->viewData['PcData']=$uBattleCharData;
        $Data->viewData['EnmData']=$uBattleEnemyData;
        
       
        return viewWrap('battle', $Data->viewData);        
    }
}


