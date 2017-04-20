<?php 
namespace App\Libs;

class RandamCharLib extends BaseGameLib
{

    public static function Randamcharsort($cid)
    {
        //ランダムで画像Ｉｄの抽出
        $cid = rand(1,count($cid));
        return $cid;
       
    }
    public static function getValueConf()
    {
        //configからデータ取ってくる
        $valueListConf = \Config::get('valueList.charst');
        
        //一つ目の攻撃力の処理
        $ratio1 = mt_rand($valueListConf['valueMin'],$valueListConf['valueMax']) * 0.01;
        $atk1 = $valueListConf['SumValueMax'] * $ratio1;
        
       //二つ目の攻撃力の処理
             if($ratio1 * 100 < 100){   $valueListConf['valueMin'] += abs($ratio1 * 100 - 100);    }
        else if($ratio1 * 100 > 100){   $valueListConf['valueMax'] -= abs($ratio1 * 100 - 100);    }
        $ratio2 = mt_rand($valueListConf['valueMin'],$valueListConf['valueMax']) * 0.01;
        $atk2 = $valueListConf['SumValueMax'] * $ratio2;
        
        //三つ目の攻撃力の処理
        $atk3 = $valueListConf['SumValueMax'] * 3 - ($atk1 + $atk2);
        
        //型キャスト
        $valueListConf['atk1'] = (int)$atk1; 
        $valueListConf['atk2'] = (int)$atk2;
        $valueListConf['atk3'] = (int)$atk3;
        
        //特化型
             if($atk1 > $atk2 && $atk1 > $atk3){ echo "atk1特化型";  }
        else if($atk2 > $atk1 && $atk2 > $atk3){ echo "atk2特化型";  }
        else{                                    echo "atk3特化型";  }
            
        //var_dump($atk1,$atk2,$atk3);
        
        return $valueListConf;
    }
}
