<?php

namespace App\Model;

class CoachModel {
	
	//IDを元にコーチを検索する
	public function getById($uCoachId)
	{
		// SQLに接続する
		$sql = <<< EOD
			SELECT *
			FROM uCoach
			WHERE id = {$uCoachId}
EOD;
		// 最初に一致したものを返す
		return $this->select($sql,'first');
	}
	
		//コーチの追加
	public function insertCoach ( $uCharaId, $uCharaName, $ratio, $attribute, $hp, $atk1, $atk2, $atk3)
	{
$sql = <<< EOD
	INSERT INTO uCoach 
	VALUES (
		NULL,
		'{$_COOKIE['userId']}',
		'{$uCharaId}',
		'{$uCharaName}',
		'{$ratio}',
		'{$attribute}',
		'{$hp}',
		'{$atk1}',
		'{$atk2}',
		'{$atk3}',
		'0',
		NULL,
		NULL
	);
EOD;
	$this->insert($sql);
	}
	
	//コーチの削除
	public function deleteCoach($uCoachId){
$sql = <<< EOD
	DELETE FROM uCoach
	WHERE id = {$uCoachId};
EOD;
	$result = $this->delete($sql);
	}
}
