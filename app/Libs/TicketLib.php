<?php

namespace App\Libs;

class TicketLib extends BaseGameLib
{
    /*
     * 枚数確認
     */
    public function confirmation($userId, $nowTime, $battleTicket, $ticketLossTime)
    {	
	// チケットの上限値を取得
	$maxticket = \Config::get('ticket','ticketMax');
	
	// 回復時間の30分を加算させる。
	$recoveryTime = date("Y-m-d H:i:s",strtotime("$ticketLossTime +30 minute"));
	
	var_dump($maxticket);
	
	// チケット枚数が上限より小さい時と、現在の時間が回復時間を上回っているとき実行
	if($battleTicket < $maxticket['ticketMax'] && $recoveryTime <= $nowTime)
	{
	    TicketLib::ticketRecovery($userId, $battleTicket, $recoveryTime);
	}
    }
    
    /*
     * チケット回復
     */
    public function ticketRecovery($userId, $battleTicket, $recovery)
    {
	// チケットを1枚回復させる。
	$ticket = $battleTicket + 1;
	$updateData = [$userId, $ticket, $recovery];
	$this->Model->exec('User', 'ticketRecovery', $updateData);
    }
}