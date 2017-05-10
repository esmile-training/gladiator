<?php

namespace App\Libs;

class TicketLib extends BaseGameLib
{
	// 減算処理
	public function lossTicket($user, $time)
	{
		$user['battleTicket'] = $user['battleTicket'] - 1;

		$max = \Config::get('ticket.ticketMax');
		
		if($user['battleTicket'] == $max - 1){
			$this->Model->exec('user', 'firstLossTicket', array($user,$time));
		}else{
			$this->Model->exec('user', 'updateTicket', array($user));
		}
	}
}
