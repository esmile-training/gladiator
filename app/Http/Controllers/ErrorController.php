<?php

namespace App\Http\Controllers;

class ErrorController extends BaseGameController
{
    public function index()
    {
	return viewWrap('Error');
    }
}
