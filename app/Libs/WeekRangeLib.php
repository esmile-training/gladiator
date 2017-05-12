<?php

namespace App\Libs;

class WeekRangeLib extends BaseGameLib {
	
	/*
	 * 週間の状態を確認
	 */
	public function rangeState($userId) {
		// ユーザの週間を取得
		$week = $this->Model->exec('Ranking', 'getRange', $userId);

		// 今週の最終日を取得
		$monday = (strtotime('monday') == strtotime('today')) ? strtotime('monday') : strtotime('last monday');
		$monday = date('Y-m-d', $monday);

		// 今週の最終日とデータベースの週間を比較
		if ($monday != $week[0]['weekRange']) {
			$this->Model->exec('Ranking', 'updateRange', [$userId, $monday]);
		}

		return $monday;
	}

}
