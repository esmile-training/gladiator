<?php

namespace App\Model;

class RankingModel extends BaseGameModel
{
    /*******      書き込み        *******/
    
    /*
    *	chardata取得
    */
    public function userRank($pushbtn)
    {
	
$sql =  <<< EOD
SELECT rank.userId,rank.totalPoint,user.name, rank FROM 
    ((
	SELECT * FROM (SELECT userId ,totalPoint, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.totalPoint > a.totalPoint) AS `rank` FROM `uRanking` a ORDER BY rank) as rank
	WHERE rank> (

	SELECT rank
	FROM (SELECT userId ,totalPoint, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.totalPoint > a.totalPoint) AS `rank` FROM `uRanking` a WHERE userId = $pushbtn) as rank
	WHERE userId = $pushbtn
	) ORDER BY totalPoint DESC LIMIT 10
    )

UNION ALL

    (
	SELECT * FROM (SELECT userId ,totalPoint, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.totalPoint > a.totalPoint) AS `rank` FROM `uRanking` a ORDER BY rank) as rank
	WHERE rank<= (

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
    
    public function rankingPager($page)
    {
	
$sql = <<< EOD
	SELECT userId ,totalPoint, user.name,
	(SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.totalPoint > a.totalPoint) 
	AS `rank` FROM `uRanking` a 
	left outer join user
	on userId = user.id
	ORDER BY totalPoint DESC LIMIT 10 OFFSET $page;
EOD;
return parent::select($sql);
    }
    
    /*
     * キャラランキング
     */
    
    public function rankingChara($page)
    {
	$page == null ? $page = 0 : false;
$sql = <<< EOD
	SELECT hp, name,
	(SELECT COUNT(*) + 1 FROM `uChara` b WHERE b.hp> a.hp AND userId = 26) 
	AS `rank` FROM `uChara` a  
        WHERE userId = 26
	ORDER BY hp DESC LIMIT 10 OFFSET $page;
EOD;
return parent::select($sql);
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
     * charaの最下位を取得
     */
    public function bottomStatus() {
$sql = <<< EOD
	SELECT hp
	FROM uChara
	WHERE userId = 26
	ORDER BY hp ASC LIMIT 1;
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
    
    /*
     * charaの登録数を取得
     */
    public function charaCount($userId)
    {
	var_dump($userId);
$sql = <<< EOD
	SELECT COUNT(userId) as count
	FROM uChara WHERE userId = $userId;
EOD;
	return parent::select($sql);
    }
    
    /*******        書き込み終了         *******/
}

