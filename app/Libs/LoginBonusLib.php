<?php
namespace App\Libs;

class LoginBonusLib extends BaseGameLib
{
	public function typeCheck($userId,$loginBonus,$loginLog)
	{
		if($loginLog['cnt'] < 7)
		{
			$loginLog['cnt']++;
			$this->Model->exec('loginLog', 'logUpdate', array($userId,$loginLog['cnt']));
			$this->Model->exec('Presentbox','insertPresentData',array($userId,
					$loginBonus[$loginLog['cnt']]['type'],$loginBonus[$loginLog['cnt']]['objId'],$loginBonus[$loginLog['cnt']]['objId'],$loginBonus[$loginLog['cnt']]['cnt']));
			$loginCnt = $loginLog['cnt'];
			return $loginCnt;
		}
		else if($loginLog['cnt'] == 7)
		{
			$loginLog['cnt'] = 1;
			$this->Model->exec('loginLog', 'logUpdate', array($userId,$loginLog['cnt']));
			$this->Model->exec('Presentbox','insertPresentData',array($userId,
					$loginBonus[$loginLog['cnt']]['type'],$loginBonus[$loginLog['cnt']]['objId'],$loginBonus[$loginLog['cnt']]['objId'],$loginBonus[$loginLog['cnt']]['cnt']));
			
			$loginCnt = $loginLog['cnt'];
			return $loginCnt;
		}
	}
}



