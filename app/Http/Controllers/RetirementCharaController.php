<?php

namespace App\Http\Controllers;

class RetirementCharaController extends BaseGameController
{	
	public function addCoachView()
	{
		$this->viewData['comment'] = 'コーチに配属しました！';
		return viewWrap('retirementChara',$this->viewData);
	}
	
	public function retireCharaView()
	{
		$this->viewData['comment'] = '引退しました';
		return viewWrap('retirementChara',$this->viewData);
	}
}
