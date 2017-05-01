<?php

namespace App\Libs;

class RankingLib extends BaseGameLib
{
	// ウィークリーポイントの加算
	public function weeklyAdd($rankingData, $add)
	{
		
		$rankingData['weeklyAward'] = $rankingData['weeklyAward'] + $add;

		$this->Model->exec('ranking', 'updateWeeklyPoint', array($rankingData));
	}

}
