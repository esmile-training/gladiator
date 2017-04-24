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
SELECT rank.userId,rank.totalPoint,user.name, rank FROM 
    ((
	SELECT * FROM (SELECT userId ,totalPoint, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.totalPoint > a.totalPoint) AS `rank` FROM `uRanking` a ORDER BY rank) as rank
	WHERE rank>= (

	SELECT rank
	FROM (SELECT userId ,totalPoint, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.totalPoint > a.totalPoint) AS `rank` FROM `uRanking` a WHERE userId = $pushbtn) as rank
	WHERE userId = $pushbtn
	) ORDER BY totalPoint DESC LIMIT 10
    )

UNION ALL

    (
	SELECT * FROM (SELECT userId ,totalPoint, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.totalPoint > a.totalPoint) AS `rank` FROM `uRanking` a ORDER BY rank) as rank
	WHERE rank< (

	SELECT rank
	FROM (SELECT userId ,totalPoint, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.totalPoint > a.totalPoint) AS `rank` FROM `uRanking` a WHERE userId = $pushbtn) as rank
	WHERE userId = $pushbtn
	) ORDER BY totalPoint ASC LIMIT 10

    ))as rank
	
    left outer join user
    on rank.userId = user.id
    order by rank
;
EOD;

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

