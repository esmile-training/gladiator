<?php

namespace App\Model;

class RankingModel extends BaseGameModel
{
    /*******      書き込み        *******/
    
    /*
    *	chardata取得
    */
    public function userRank($userId)
    {
	
$sql =  <<< EOD
SELECT rank.userId,rank.weeklyAward,user.name, rank FROM 
    ((
	SELECT * FROM (SELECT userId ,weeklyAward, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.weeklyAward > a.weeklyAward) AS `rank` FROM `uRanking` a ORDER BY rank) as rank
	WHERE rank> (

	SELECT rank
	FROM (SELECT userId ,weeklyAward, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.weeklyAward > a.weeklyAward) AS `rank` FROM `uRanking` a WHERE userId = $userId) as rank
	WHERE userId = $userId
	) ORDER BY weeklyAward DESC LIMIT 10
    )

UNION ALL

    (
	SELECT * FROM (SELECT userId ,weeklyAward, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.weeklyAward > a.weeklyAward) AS `rank` FROM `uRanking` a ORDER BY rank) as rank
	WHERE rank<= (

	SELECT rank
	FROM (SELECT userId ,weeklyAward, (SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.weeklyAward > a.weeklyAward) AS `rank` FROM `uRanking` a WHERE userId = $userId) as rank
	WHERE userId = $userId
	) ORDER BY weeklyAward ASC LIMIT 10

    ))as rank
	
    left outer join user
    on rank.userId = user.id
    order by rank
;
EOD;

	return parent::select($sql, 'all');
    }
    
    /*
     * ランキングのページャー
     */
    
    public function rankingPager($page)
    {
	
$sql = <<< EOD
	SELECT userId ,weeklyAward, user.name,
	(SELECT COUNT(*) + 1 FROM `uRanking` b WHERE b.weeklyAward > a.weeklyAward) 
	AS `rank` FROM `uRanking` a 
	left outer join user
	on userId = user.id
	ORDER BY weeklyAward DESC LIMIT 10 OFFSET $page;
EOD;
return parent::select($sql);
    }
    
    /*
     * キャラランキング
     */
    
    public function rankingChara($page, $userId)
    {
	$page == null ? $page = 0 : false;
$sql = <<< EOD
	SELECT hp, name,
	(SELECT COUNT(*) + 1 FROM `uChara` b WHERE b.hp> a.hp AND userId = $userId) 
	AS `rank` FROM `uChara` a  
        WHERE userId = $userId
	ORDER BY hp DESC LIMIT 10 OFFSET $page;
EOD;
return parent::select($sql);
    }
    

    /*
     * rankの最下位のポイントを取得
     */
    public function bottomAcquisition() {
$sql = <<< EOD
	SELECT weeklyAward
	FROM uRanking
	JOIN user ON user.id = uRanking.userId
	ORDER BY weeklyAward ASC LIMIT 1;
EOD;
	return parent::select($sql);
    }
    
    /*
     * charaの最下位を取得
     */
    public function bottomStatus($userId) {
$sql = <<< EOD
	SELECT hp
	FROM uChara
	WHERE userId = $userId
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
	
	
	// ユーザーIDを元にウィークリーランキングの情報を取得
	public function getRankingData($userId = false)
	{
$sql = <<< EOD
	SELECT *
	FROM uRanking
	WHERE userId	= {$userId}
EOD;
		return $this->select($sql, 'first');
	}
	
	// ランキングデータのIDを元にウィークリーランキングのポイントを更新
	public function updateWeeklyPoint($rankingData)
    {
$sql = <<< EOD
	UPDATE  uRanking
	SET		weeklyAward = {$rankingData['weeklyAward']}
	WHERE  id		= {$rankingData['id']};
EOD;
		$this->update($sql);
    }
    
    /*
     * charaの登録数を取得
     */
    public function charaCount($userId)
    {
$sql = <<< EOD
	SELECT COUNT(userId) as count
	FROM uChara WHERE userId = $userId;
EOD;
	return parent::select($sql);
    }
    
    /*******        書き込み終了         *******/
}

