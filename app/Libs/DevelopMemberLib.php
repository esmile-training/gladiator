<?php
namespace App\Libs;

class DevelopMemberLib
{
	/*
	*	メンバーコンフィグを職業別に配列しなおす
	*/
    public static function sortMemberConf( $membersConf )
    {
		$result = array();		//初期化
		foreach($membersConf as $member){
			$result[$member['type']][] = $member['name'];
		}

        return $result;
    }
}