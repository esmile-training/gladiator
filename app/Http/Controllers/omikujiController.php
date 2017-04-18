<?php

namespace App\Http\Controllers;

class omikujiController extends Controller
{
	public function index()
	{
		return viewWrap('omikuji', $this->viewData);
		//return view('omikuji');
	}
}
