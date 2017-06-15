<?php
namespace App\Model;

class PresentBoxModel extends BaseGameModel
{
	// プレゼントの取得
	public function confirmation($userId)
	{
$sql =  <<< EOD
		SELECT *
		FROM uPresent
		WHERE userId = {$userId};
EOD;
		return $this->select($sql, 'all');
	}

	// プレゼントのテーブルへデータを挿入する
	public function insertPresentData($userId,$type,$objId,$imgId,$time,$cnt = 1)
	{
		$time = date('Y-m-d H:i:s', time());
$sql =  <<< EOD
		INSERT INTO uPresent
		VALUES (
			NULL,
			0,
			{$userId},
			{$type},
			{$objId},
			{$imgId},
			'{$cnt}',
			'{$time}',
			NULL
		);
EOD;
	return $this->insert($sql);
	}
}
