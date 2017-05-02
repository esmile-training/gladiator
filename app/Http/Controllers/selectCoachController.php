<?php

namespace App\Http\Controllers;

class selectCoachController extends BaseGameController
{
	public function index(){
		return viewWrap('selectCoach');
	}
}
