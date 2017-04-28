<?php

namespace App\Http\Controllers;

//エディット画面で不正な入力がされた場合に呼び出される

class ErrorController extends BaseGameController
{
	public function index()
	{
	return viewWrap('Error');
	}
}
