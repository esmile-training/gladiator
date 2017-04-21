<?php

namespace App\Model;

class RankingModel extends BaseGameModel
{
    /*******      書き込み        *******/
    
    /*
    *	chardata取得
    */
    public function getByrank( $pushbtn )
    {
	
$sql =  <<< EOD
	SELECT user.id as userId,
	       totalPoint,
	       user.name as username
	FROM uRanking 
	JOIN user ON user.id = uRanking.userId 
	ORDER BY totalPoint DESC LIMIT 10 OFFSET $pushbtn[0];
EOD;
 
	
	/*
$sql = <<< EOD
	SELECT * FROM
        (
        SELECT * From uRanking 
	WHERE totalPoint BETWEEN 
        (SELECT totalPoint FROM uRanking WHERE userId = 13) AND 
        (SELECT MAX(totalPoint) FROM uRanking)
        ORDER BY totalPoint DESC LIMIT 5
        )rank

UNION ALL

        (
        SELECT * From uRanking 
	WHERE totalPoint BETWEEN 
        (SELECT MIN(totalPoint) FROM uRanking) AND
        (SELECT totalPoint FROM uRanking WHERE userId = 13) 
        
        ORDER BY totalPoint DESC LIMIT 1,5
        );
EOD;
*/

	return parent::select($sql, 'all');
    }
    
    
    /*
     * rankの最下位のポイントを取得
     */
    public function bottomAcquisition() {
$sql = <<< EOD
	SELECT totalPoint
	FROM uRanking
	JOIN user ON user.id = uRanking.userId
	ORDER BY totalPoint ASC LIMIT 1;
EOD;
	return parent::select($sql);
    }
    
    /*
     * idの登録数を取得
     */
    public function idRegistrationNumber()
    {
$sql = <<< EOD
	SELECT COUNT(id) as count
	FROM uRanking;
EOD;
	return parent::select($sql);
    }
    
    /*******        書き込み終了         *******/
}

