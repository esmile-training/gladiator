<?php

namespace App\Model;

class LoginLogModel extends BaseGameModel
{
	public function check($userId)
	{
		// SQLに接続する
$sql = <<< EOD
		SELECT *
		FROM uLoginLog
		WHERE userId = {$userId}
EOD;
		// 最初に一致したものを返す
		return $this->select($sql,'first');
	}
	
	public function insertData($userId,$time)
	{	
$sql =  <<< EOD
		INSERT INTO uLoginLog
		values(
			NULL,
			{$userId},
			1,
			'{$time}',
			'{$time}'
		);
EOD;
	return $this->insert($sql);
	}
	
	public function logUpdate($userId,$cnt)
	{
$sql =  <<< EOD
		UPDATE  uLoginLog
		SET		cnt = {$cnt}
		WHERE	userId = {$userId};
EOD;
		$this->update($sql);
	}
	
}
