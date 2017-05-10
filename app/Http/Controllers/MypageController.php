<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
	// ユーザーデータの取得
	$userData = $this->Model->exec('Mypage', 'getUserData', $this->user['id']);
	$this->viewData['user'] = $userData[0];
	
	// チケット情報を配列化
	$ticketData = [$this->user['id'],  $this->viewData['nowTime'], $this->user['battleTicket'], $this->user['ticketLossTime']];
	
	// チケットの回復処理
	$this->Lib->exec('Ticket', 'confirmation', $ticketData);
	
	$this->Lib->exec('WeekRange', 'rangeState', $this->user['id']);
	return viewWrap('mypage', $this->viewData);
    }
}

