<?php
namespace App\Model;

class BaseGameModel
{
    /*
     * SELECT
     */
    public static function select( $sql, $range = 'all' )
    {
	$response = self::dbapi($sql, 'select');

	//jsonから配列に変換
	$result = json_decode($response, true);
	if($result){
	    if( is_null($result) ){
		return array();
	    }elseif( $range == 'all' ){
		return $result;
	    }elseif( $range == 'first' &&  isset($result[0]) ){
		return $result[0];
	    }else{
		return $result;
	    }
	} else {
	    print( $response );
	    \Log::error('Showing user profile for user: '.$response);
	}
    }

    /*
     * UPDATE
     */
    public static function update( $sql )
    {
	return self::dbapi($sql, 'update');
    }
   
    /*
     * DELETER
     */
    public static function delete( $sql )
    {
	return self::dbapi($sql, 'delete');
    }

    /*intval($str)
     * INSERT
     */
    public static function insert( $sql )
    {
	$result = self::dbapi($sql, 'insert');
	return intval($result);
    }

    /*
     * API実行
     */
    public static function dbapi( $sql, $type = 'dbapi' )
    {
	$params = ['sql' => $sql];
	
	//開始
	$curl = curl_init(DB_API_URL.$type.'.php');
	//オプションセット
	curl_setopt($curl, CURLOPT_POST, TRUE);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // パラメータをセット
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//実行
	$response = curl_exec($curl);
	//閉じる
	curl_close($curl);

	return $response;

    }
    
    

}