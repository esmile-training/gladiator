<?php 
namespace App\Libs;

class RandamCharaLib extends BaseGameLib
{
    
    public static function getCharaImgId()
    {
       //configからデータ取ってくる
       $charaConf = \Config::get('chara.imgCharaId');
       //ランダム処理
       $charaId = rand(1,count($charaConf));
       //ランダムできまった数値を配列に入れる
       $charaConf['charaId'] = $charaId;
       //ランダムで決まったキャラの性別も配列に入れる
       $charaConf['sex']    = $charaConf[$charaId]['sex'];
       return $charaConf;
    }
    
    public static function getValueConf()
    {
        //configからデータ取ってくる
        $valueListConf = \Config::get('valueList.charaStatus');
        
        //一つ目の攻撃力の処理
        $ratio1 = mt_rand($valueListConf[2]['valueMin'],$valueListConf[2]['valueMax']) * 0.01;
        $atk1 = $valueListConf[2]['sumValueMax'] * $ratio1;
        
       //二つ目の攻撃力の処理
        if($ratio1 * 100 < 100){  
            $valueListConf[2]['valueMin'] += abs($ratio1 * 100 - 100);    
            
        }
        else if($ratio1 * 100 > 100)
        {  
            $valueListConf[2]['valueMax'] -= abs($ratio1 * 100 - 100);   
        }
        $ratio2 = mt_rand($valueListConf[2]['valueMin'],$valueListConf[2]['valueMax']) * 0.01;
        $atk2 = $valueListConf[2]['sumValueMax'] * $ratio2;
        
        //三つ目の攻撃力の処理
        $atk3 = $valueListConf[2]['sumValueMax'] * 3 - ($atk1 + $atk2);
        
        //型キャスト
        $valueListConf['atk1'] = (int)$atk1; 
        $valueListConf['atk2'] = (int)$atk2;
        $valueListConf['atk3'] = (int)$atk3;
        $valueListConf['hp'] =  $valueListConf['atk1'] +  $valueListConf['atk2'] +  $valueListConf['atk3'];
        if($valueListConf['hp'] <= $valueListConf[2]['sumValueMax'] * 3 - 1){
            
            $valueListConf['hp'] += 1;
        }
        
        //var_dump($valueListConf['hp']);exit;
        //特化型
        if($atk1 > $atk2 && $atk1 > $atk3)
        { 
            echo "atk1特化型";
        }else if($atk2 > $atk1 && $atk2 > $atk3)
        {
            echo "atk2特化型";  
        }else{
            echo "atk3特化型";  
            
        } 
        return $valueListConf;
    }
    public static function randamCharaName($sexData)
    {
        
        //configからデータ取ってくる
        $charanameConf = \Config::get('charaname.allname');
        //ファーストネーム配列の中からひとつランダムで取る
        $charaFirstNameNumber = array_rand($charanameConf['firstname'][$sexData]);
        //ラストネーム
        $charaLastNameNumber = array_rand($charanameConf['lastname']);
        $charanameConf['firstname'] = $charanameConf['firstname'][$sexData][$charaFirstNameNumber];
        $charanameConf['lastname'] = $charanameConf['lastname'][$charaLastNameNumber];
    
        return $charanameConf;
    }
              
    

}
