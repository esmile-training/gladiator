<?php

namespace App\Libs;

class MoneyLib extends BaseGameLib
{
	// 加算処理
	public function addition($user, $add)
	{
		$user['money'] = $user['money'] + $add;

		$this->Model->exec('user', 'updateMoney', array($user));
	}
	

	// 減算処理
	public function Subtraction($user, $sub)
	{
		$user['money'] = $user['money'] - $sub;

		$this->Model->exec('user', 'updateMoney', array($user));		
		$user['money'] = $user['money'] - $sub;

		// お金が0より少なくなってしまった場合
		if($user['money'] < 0)
		{
			return viewWrap('error');
		}
		$this->Model->exec('user', 'updateMoney', array($user));
	}
	

	// 乗算処理
	public function Multiplication($user, $mul)
	{
		$user['money'] = $user['money'] * $mul;

		$this->Model->exec('user', 'updateMoney', array($user));		
	}
	

	// 除算処理
	public function division($user, $div)
	{
		$user['money'] = $user['money'] / $div;

		$this->Model->exec('user', 'updateMoney', array($user));
	}

}
}