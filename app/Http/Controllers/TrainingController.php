<?php

namespace App\Http\Controllers;

class TrainingController extends BaseGameController
{

    public function index()
    {
        //所持しているキャラのデータを持ってくる
        $this->viewData['charaList'] = $this->Model->exec('Training', 'getUserChara', false, $this->user['id']);
	
        return viewWrap('training',$this->viewData);
    }
    
    public function coachSelect()
    {
	//uCharaIdをGETしviewDataに保持
	$uCharaId = (int)filter_input(INPUT_GET,"uCharaId");
	$this->viewData['uCharaId'] = $uCharaId;
	
	//所持しているコーチのデータを持ってくる
	$this->viewData['coachList'] = $this->Model->exec('Training', 'getUserCoach', false, $this->user['id']);
	
	return viewWrap('coachSelect',$this->viewData);
    }
    
    public function setTrainingFinishDate()
    {
	//訓練時刻をGETする
	$trainingTime = (int)filter_input(INPUT_GET,"trainingTime");
	
	//viewに渡したuCharaIdと選択されたuCoachIdをGET
	$uCoachId = (int)filter_input(INPUT_GET,"uCoachId");
	$uCharaId = (int)filter_input(INPUT_GET,"uCharaId");
	
	//訓練開始時刻を入れる
	$trainingStartDate = $this->viewData['nowTime'];
	//訓練開始時刻をタイムスタンプに直し時間を加算
	$trainingFinishTs = strtotime("$trainingStartDate +$trainingTime hours");
	//タイムスタンプにした時間を元に戻す
	$trainingFinishDate = date('Y-m-d H:i:s',$trainingFinishTs);
	
	//uCharaIdとuCoachIdとtrainingFinishDateをModelに渡す
	$this->Model->exec('Training','setFinishDate',array($uCharaId,$uCoachId,$trainingStartDate,$trainingFinishDate));
	
	//リダイレクト
	return $this->Lib->redirect('training', 'index');
	
    }
}
