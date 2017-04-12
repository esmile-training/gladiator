<?php
namespace App\Model;

class UserModel extends BaseModel
{
    /*
    *	ユーザ全件取得
    */
    public static function getAll()
    {
	$sql = "SELECT * FROM user;";
	return parent::dbapi($sql);
    }
}