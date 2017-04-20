<?php
namespace App\Http\Controllers;

class GachaController extends BaseGameController
{
    public function index()
    {
        //キャラの画像
        $cid = $this->Model->exec('User','getByCharaId');
        $this->viewData['cid'] = $this->Lib->exec('RandamChar','Randamcharsort',[$cid]);
        
        
        //キャラのステータス
        $this->viewData['valueList'] = $this->Lib->exec('RandamChar','getValueConf');

        
        //キャラネーム
        $nameId = rand(1,4);
        $name = $this->Model->exec('User','getByCharaNameId',$nameId);
        $this->viewData['cname'] = $name['cName'];
        var_dump($this->viewData['cname']);
        return view('gacha', $this->viewData);
    }
}