<?php

namespace App\Libs;

class TicketLib extends BaseGameLib
{
	// 減算処理
	public function lossTicket($user, $time)
	{
		$user['battleTicket'] = $user['battleTicket'] - 1;

		$max = \Config::get('ticket.ticketMax');
		
		if($user['battleTicket'] == $max - 1)
		{
			$this->Model->exec('user', 'firstLossTicket', array($user,$time));
		}
		else
		{
			$this->Model->exec('user', 'updateTicket', array($user));
		}
	}

    /*
     * 枚数確認
     */
    public function confirmation($userId, $nowTime, $battleTicket, $ticketLossTime)
    {	
		// チケットの上限値を取得
		$maxticket = \Config::get('ticket','ticketMax');

		// 回復時間の30分を加算させる。
		$recoveryTime = date("Y-m-d H:i:s",strtotime("$ticketLossTime +30 minute"));
		
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