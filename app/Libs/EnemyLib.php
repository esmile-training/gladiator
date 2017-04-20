<?php
namespace App\Libs;

class EnemyLib{
    
    // 敵の各属性を出す確率ステータスに基づいた手をランダムに選択する処理
    public static function setEnmHand( $EnemyData ){

        $result = [];   //初期化
        // ランダムに1～100の数値を選択
        $Random = rand(1, 100);
        
//        var_dump($enemiesConf);         // デバッグ データ受け渡し確認
        // Enm の gu の確率値以下の場合
        if ( $Random <= $EnemyData['GooPer']){
            $result = 'グー';
        }
        // Enm の Gu の確率値と Enm の Ch を足した数以下の場合
        else if($Random <=  $EnemyData['GooPer'] + $EnemyData['ChoPer']){
            $result = 'チョキ';
        }
        // Enm の Gu の確率値と Enm の Ch を足した数より大きい場合
        else {
            $result = 'パー';
        }    
        
        
        return $result;
    }
}

