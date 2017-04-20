<?php

namespace App\Http\Controllers;

class TrainingController extends BaseGameController
{
    public function index()
    {
        //所持しているキャラのデータを持ってくる
        $this->viewData['charaList'] = $this->Model->exec('Training', 'getUChara', false, $this->user['id']);
	
        return viewWrap('training',$this->viewData);
    }
    
    public function setCharaId()
    {
	return $this->Lib->redirect('coachselect', 'index');
    }
    
}
