<?php

namespace App\Http\Controllers;

class CharaStatusController {
	public function index()
	{
		return viewWrap('charastatus');
	}
}
