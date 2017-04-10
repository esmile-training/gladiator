<?php

namespace App\Http\Controllers;

use App\User;
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
         $this->viewData['appAliassConf']           =   \Config::get('app.aliases');
         $this->viewData['dbRedisDefaultConfig']    = \Config::get('database.redis.default');
        
         //foreach

         //Libraly

        return viewWrap('top', $this->viewData);
    }
}