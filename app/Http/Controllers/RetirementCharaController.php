<?php

namespace App\Http\Controllers;

class RetirementCharaController extends BaseGameController
{	
	public function addCoachView()
	{
		$this->viewData['text'] = "コーチに配属しました！";
		viewWrap("retirementChara", $this->viewData);
	}
	
	public function retireCharaView()
	{
		$this->viewData['text'] = "引退しました";
		viewWrap('retirementChara', $this->viewData);
	}
}
