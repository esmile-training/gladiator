<?php

namespace App\Http\Controllers;

use App\Libs\DevelopMemberLib;
use App\Http\Controllers\Controller;

class topController extends Controller
{
    /**
     * 指定ユーザーのプロフィール表示
     *
     * @param  int  $id3
     * @return Response
     */
    public function index()
    {
        //DBからとってくる

        //configからとってくる
        $membersConf          =   \Config::get('members.profile');

        //Libraly
        $this->viewData['memberList'] = DevelopMemberLib::sortMemberConf( $membersConf );

        return viewWrap('top', $this->viewData);
    }
    public function test()
    {
        //DBからとってくる

        //configからとってくる
        $membersConf          =   \Config::get('members');

        //Libraly
        $this->viewData['memberList'] = DevelopMemberLib::sortMemberConf( $membersConf );

        return viewWrap('top', $this->viewData);
    }
}