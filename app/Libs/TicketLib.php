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
		
		// バトルチケットの枚数分回す
		foreach (range($battleTicket, (int)$maxticket['ticketMax']) as $data)
		{
			// 回復時間とチケットが超えていないか確認
			if($recoveryTime <= $nowTime && $battleTicket < $maxticket['ticketMax'])
			{
				// チケットに代入
				$battleTicket = $data + 1;
			}
			
			if($recoveryTime <= $nowTime){
				// チケット回復
				$this->Model->exec('User', 'ticketRecovery', [$userId, $battleTicket, $recoveryTime]);
				
				// 最大数まで回復していないときさらに30分追加
				$recoveryTime = date("Y-m-d H:i:s",strtotime("$recoveryTime +30 minute"));
			}else{
				break;
			}
		}

		$nextrecovery = date("i:s",(strtotime($recoveryTime) - strtotime($nowTime)));
		
		if($battleTicket == $maxticket['ticketMax']){
			$nextrecovery = date("i:s",(strtotime(0)));
		}
		return $nextrecovery;
    }
	
    public function recoveryTicket($user){
		
		// ユーザーのチケットを加算
		$user['battleTicket']++;
		
		$this->Model->exec('User', 'updateTicket', array($user));
	}
}