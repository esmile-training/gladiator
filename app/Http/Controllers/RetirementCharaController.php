<?php

namespace App\Http\Controllers;

class RetirementCharaController extends BaseGameController
{	
	public function index()
	{
		return viewWrap("retirementChara");
	}
}
