<?php
namespace App\Libs;

class BattleLib extends BaseGameLib
{
    // 敵の各属性を出す確率ステータスに基づいた手をランダムに選択する処理
    public static function setEnmHand( $EnemyData ){

        $result = [];   //初期化
        // ランダムに1～100の数値を選択
        $Hand = rand(1, 100);
        
//        var_dump($enemiesConf);         // デバッグ データ受け渡し確認
        // Enm の gu の確率値以下の場合
        if ( $Hand <= $EnemyData['gooPer']){
            $result = 'グー';
        }
        // Enm の Gu の確率値と Enm の Ch を足した数以下の場合
        else if($Hand <=  $EnemyData['gooPer'] + $EnemyData['choPer']){
            $result = 'チョキ';
        }
        // Enm の Gu の確率値と Enm の Ch を足した数より大きい場合
        else {
            $result = 'パー';
        }    
        
        return $result;
    }
    
    // バトルの処理を格納する処理
    public static function battleResult( $pcHand , $enmHand ){
        
        $result = [];   // 初期化
        // 結果を Result に格納
        switch ( $pcHand ) {
            case 'グー':
                switch ( $enmHand ){
                    case 'グー':
                        $result = 'あいこ';
                        break;
                    case 'チョキ':
                        $result = '勝ち';
                        break;
                    case 'パー':
                        $result = '負け';
                        break;
                    default:
                        echo 'エラー';
                        exit;
                }
                break;      
            case 'チョキ':
                switch ($enmHand){
                    case 'グー':
                        $result = '負け';
                        break;
                    case 'チョキ':
                        $result = 'あいこ';
                        break;
                    case 'パー':
                        $result = '勝ち';
                        break;
                    default:
                        echo 'エラー';
                        exit;
                }
                break;
            case 'パー':
                switch ($enmHand){
                    case 'グー':
                        $result = '勝ち';
                        break;
                    case 'チョキ':
                        $result = '負け';
                        break;
                    case 'パー':
                        $result = 'あいこ';
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
    public static function damagecalc( $winner,$loser){
        
        switch($winner['hand']){
            case 'グー':
                $loser['hp'] = $loser['hp'] - $winner['gooAtk'];
                break;
            case 'チョキ':
                $loser['hp'] = $loser['hp'] - $winner['choAtk'];
                break;
            case 'パー':
                $loser['hp'] = $loser['hp'] - $winner['paaAtk'];
                break;
            default;
                exit;
        }
        
        return $loser['hp'];
    }

}