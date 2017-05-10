<?php

namespace App\Http\Controllers;

//エディット画面で不正な入力がされた場合に呼び出される

class CommonErrorController extends BaseGameController
{
	public function index()
	{
		return view('Error');
	}
}
