<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class topController extends Controller
{
    /**
     * �w�胆�[�U�[�̃v���t�B�[���\��
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('top');
    }
}