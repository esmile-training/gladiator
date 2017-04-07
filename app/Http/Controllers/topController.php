<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class topController extends Controller
{
    /**
     * 指定ユーザーのプロフィール表示
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        return view('top');
    }
}