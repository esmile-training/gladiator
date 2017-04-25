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
	$this->Model->exec('User', 'createUser', false, null, $player);
	$userId = $this->Model->exec('User','getByName',false, null, $player);
	setcookie('userId',$userId['id'],time() + 60*60*24*365*20, '/');
	var_dump($_COOKIE['userId']);
	return $this->Lib->redirect('mypage', 'index');
    }
}
