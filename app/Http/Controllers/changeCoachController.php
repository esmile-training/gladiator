<?php

namespace App\Http\Controllers;

class changeCoachController extends BaseGameController
{
	public function index()
	{
		return viewWrap('changeCoach');
	}
}