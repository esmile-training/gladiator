<?php

namespace App\Http\Controllers;

class RetirementCharaController extends BaseGameController
{	
	public function addCoachView()
	{
		$text = array('text' => 'aaa');
		return viewWrap("retirementChara", $text);
	}
	
	public function retireCharaView()
	{
		$text = array('text' => 'bbb');
		return viewWrap('retirementChara', $text);
	}
}
