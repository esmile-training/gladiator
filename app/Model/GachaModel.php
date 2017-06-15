<?php
namespace App\Model;

class GachaModel extends BaseGameModel
{
	public function getTime($userId)
	{
$sql =  <<< EOD
	SELECT *
	FROM uGachaLog
	WHERE gachaId = '11'
	AND userId = {$userId}
	ORDER BY createTime DESC LIMIT 1;
EOD;
	$resultTime = $this->select($sql,'all');
 	return $resultTime;
	}
	 /*
     *キャラの作成
     */
	public function createChara($charaData)
	{

	$sql = <<< EOD
	INSERT INTO  uChara
	VALUES (
		NULL,
		'0',
		'{$charaData['userId']}',
		'{$charaData['uCharaId']}',
		'{$charaData['uCharaFirstName']}・{$charaData['uCharaLastName']}',
		'{$charaData['ratio']}',
		'{$charaData['narrow']}',
		'{$charaData['hp']}',
		'{$charaData['gu']}',
		'{$charaData['choki']}',
		'{$charaData['paa']}',
		'0',
		'0',
		'0',
		'1',
		'0',
		NULL,
		NULL
    );
EOD;
	$this->insert($sql);
	}

	/*
		未取得キャラの作成
	*/
	public function createUnacquiredChara($charaData)
	{

	$sql = <<< EOD
	INSERT INTO  uChara
	VALUES (
		NULL,
		'0',
		'{$charaData['userId']}',
		'{$charaData['uCharaId']}',
		'{$charaData['uCharaFirstName']}・{$charaData['uCharaLastName']}',
		'{$charaData['ratio']}',
		'{$charaData['narrow']}',
		'{$charaData['hp']}',
		'{$charaData['gu']}',
		'{$charaData['choki']}',
		'{$charaData['paa']}',
		'0',
		'0',
		'0',
		'0',
		'0',
		NULL,
		NULL
	);
EOD;
	$this->insert($sql);
	}

	/*
    * ガチャの記録
    */
	public function createLog($charaData)
	{

	$time = date('Y-m-d H:i:s', time());
	$result = $this->getCharaId();
$sql = <<< EOD

	VALUES (
		'{$charaData['GachaVal']}',
		'{$charaData['userId']}',
		'{$result['id']}',
		'{$time}',
		'{$time}'
    );
EOD;
	$this->insert($sql);
	}
	/*
    * 最新のキャラのID取得
    */
	public function getCharaId()
	{
$sql =  <<< EOD
	SELECT id
	FROM uChara
	ORDER BY id desc LIMIT 1;
EOD;
	$result = $this->select($sql,'first');
 	return $result;
	}

	//イベントガチャ用のレコード作成
	public function createEventGachaRecord($userId){
	$time = date('Y-m-d H:i:s', time());
$sql = <<< EOD
	INSERT INTO uEventGachaLog
	VALUES (
		{$userId},
		0,
		0,
		0,
		0,
		0,
		0,
		'{$time}',
		'{$time}'
	);
EOD;
	$hoge = $this->insert($sql);
	}

	//現在までに引いたガチャの状態を取得
	public function getEventGachaRecord($userId)
	{
$sql = <<< EOD

	SELECT count, N, R, SR, SSR, LR
	FROM uEventGachaLog
	WHERE userId = '$userId'
EOD;
	$result = $this->select($sql,'first');
	return $result;
	}

	//	引いたレア度を記録
	public function updateEventGachaRecord($userId, $rare){
$sql = <<< EOD

	UPDATE uEventGachaLog SET count = count + 1, {$rare} = {$rare} + 1
	WHERE userId = {$userId};
EOD;
	$this->update($sql);
	}}
