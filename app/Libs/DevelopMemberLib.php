<?php
namespace App\Libs;

class DevelopMemberLib
{
	/*
	*	メンバーコンフィグを職業別に配列しなおす
	*/
    public static function sortMemberConf()
    {
	//configからとってくる
	$membersConf          =   \Config::get('members.profile');
	$typeStr         =   \Config::get('members.typeStr');

	$result = [];  //初期化
	foreach($membersConf as $member){
		
		$result[$typeStr[$member['type']]][] = $member['name'];
	}

        return $result;
    }
}