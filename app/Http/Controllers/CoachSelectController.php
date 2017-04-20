<?php

namespace App\Http\Controllers;

use App\Model\TrainingModel;

class CoachSelectController extends BaseGameController
{
    public function index()
    {
        //所持しているのデータを持ってくる
        $this->viewData['coachList'] = $this->Model->exec('Training', 'getUCoach', false, $this->user['id']);
        return viewWrap('coachselect', $this->viewData);
    }
    
    public function setTrainingTime()
    {
	return $this->Lib->redirect('training', 'index');
    }
    
}