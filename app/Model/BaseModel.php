<?php
namespace App\Model;

class BaseModel
{
    /*
    *	DB接続
    */
    public static function dbapi( $sql )
    {
	$params = ['sql' => $sql];
	
	//開始
	$curl = curl_init(DB_API_URL);
	//オプションセット
	curl_setopt($curl, CURLOPT_POST, TRUE);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // パラメータをセット
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//実行
	$response = curl_exec($curl);
	//閉じる
	curl_close($curl);

	//jsonから配列に変換
	$result = json_decode($response, true);
	if($result){
	    return $result;
	} else {
	    print( $response );
	    \Log::error('Showing user profile for user: '.$response);
	}
    }

}