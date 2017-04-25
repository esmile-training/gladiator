<?php
namespace App\Http\Controllers;

class GachaController extends BaseGameController
{
    public function index()
    {
        
        $this->viewData['chara'] = $this->Lib->exec('RandamChara','getCharaImgId');
                 
        //性別データの格納
        $sexData = $this->viewData['chara']['sex'];
        
      
        //キャラのステータス
        $this->viewData['valueList'] = $this->Lib->exec('RandamChara','getValueConf');

        
        //キャラネーム 
        $this->viewData['name'] = $this->Lib->exec('RandamChara','randamCharaName',[$sexData]);
      
        
        $uCharaId = $this->viewData['chara']['charaId'];
        $uCharaFirstName = $this->viewData['name']['firstname']['name'];
        $uCharaLastName = $this->viewData['name']['lastname']['familyname'];
        $atk1 = $this->viewData['valueList']['atk1'];
        $atk2 = $this->viewData['valueList']['atk2'];
        $atk3 = $this->viewData['valueList']['atk3'];
        $hp = $this->viewData['valueList']['hp'];
        
        
        $this->Model->exec('User','createChara',array($uCharaId,$uCharaFirstName,$uCharaLastName,$hp,$atk1,$atk2,$atk3));
 
        return viewWrap('gacha', $this->viewData);
    
    }
}