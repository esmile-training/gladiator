<?php

namespace App\Http\Controllers;

class EditController extends BaseGameController
{
    public function index()
    {
	return view('edit');
    }
    
    public function addUser()
    {
	$player = $_GET["teamName"];
	$this->Model->exec('User', 'createUser', false, $player);
	$userId = $this->Model->exec('User','getByName',"",$player);
	var_dump($userId);
//	setcookie('userId',$userId,time() + 60*60*24*365*20, '/');
//	return $this->Lib->redirect('mypage', 'index');
    }
}
