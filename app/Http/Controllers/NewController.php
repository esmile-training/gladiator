<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib
use App\Libs\DevelopMemberLib;

class NewController extends BaseGameController
{
    /**
     * TOP画面表示
     * 
     */
    public function index()
    {
		return viewWrap('new', $this->viewData);
    }
}