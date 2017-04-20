<?php
namespace App\Libs;

class BattleLib extends BaseGameLib
{
    
    // バトルの処理を格納する処理
    public static function battleResult( $pcHand , $enmHand ){
        
        $result = [];   // 初期化
        // 結果を Result に格納
        switch ( $pcHand ) {
            case 'グー':
                switch ($enmHand){
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
        
        switch($winner['Hand']){
            case 'グー':
                $loser['Hp'] = $loser['Hp'] - $winner['GooAtk'];
                break;
            case 'チョキ':
                $loser['Hp'] = $loser['Hp'] - $winner['ChoAtk'];
                break;
            case 'パー':
                $loser['Hp'] = $loser['Hp'] - $winner['PaaAtk'];
                break;
            default;
                exit;
        }
        
        return $loser['Hp'];
    }

}