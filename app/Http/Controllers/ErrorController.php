<?php

namespace App\Http\Controllers;

/**
 * エディット画面で不正な入力がされた、ログイン時にバトル中だった時にここに飛ばされます。
 * ポップアップ表示の代わりです。
 */

class ErrorController extends BaseGameController
{
	public function index()
	{
		return viewWrap('Error');
	}
}
