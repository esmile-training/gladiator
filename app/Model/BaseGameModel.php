<?php
namespace App\Model;

class BaseGameModel
{
    /*
     * Model呼び出し
     */
    public function exec( $className, $method, $arg = false, $userId = null )
    {
	//インスタンス化する
	$className = '\\App\\Model\\'.$className.'Model';
	$modelClass = new $className();

		//ユーザ情報がある場合は登録
		if( $userId )
		{
			$userModel = new UserModel();
			$modelClass->user = $userModel->getById( $userId );
		}
		else
		{
			$modelClass->user = null;
		}
		//引数の数によって出しわけ
		if( is_array($arg) )
		{
			return call_user_func_array( array($modelClass , $method), $arg );
		}
		elseif( $arg )
		{
			return call_user_func_array( array($modelClass , $method), array($arg) );
		}
		else
		{
			return $modelClass->$method($userId);
		}
    }

    /*
     * SELECT
     */
    public function select( $sql, $range = 'all' )
    {
		$response = $this->dbapi($sql, 'select');
		//jsonから配列に変換
		$result = json_decode($response, true);
		if($result)
		{
			if( is_null($result) )
			{
			return array();
			}
			else if( $range == 'all' )
			{
			return $result;
			}
			else if( $range == 'first' &&  isset($result[0]) )
			{
			return $result[0];
			}
			else
			{
			return $result;
			}
		}
		else
		{
//			print( $response.'<br>' );
			\Log::error('Showing user profile for user: '.$response);
		}
    }

    /*
     * UPDATE
     */
    public function update( $sql )
    {
	$result = $this->dbapi($sql, 'update');
	// SQLの実行
	BaseGameModel::StatusUpdate($sql);
	return $result;
    }
   
    /*
     * DELETER
     */
    public function delete( $sql )
    {
	$result = $this->dbapi($sql, 'delete');
	// SQLの実行
	BaseGameModel::StatusUpdate($sql);
	return $result;
    }

    /*intval($str)
     * INSERT
     */
    public function insert( $sql )
    {
	$result = $this->dbapi($sql, 'insert');
	// SQLの実行
	BaseGameModel::StatusUpdate($sql);
	return intval($result);
    }

    /*
     * API実行
     */
    public function dbapi( $sql, $type = 'dbapi' )
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
    
    /*
     * キャラクターステータスの合計値のアップデート
     */
    
    public function StatusUpdate( $sql )
    {
		// uCharaという文字列が存在していれば実行
		$post = strpos($sql, 'uChara');

		// サンプル用クッキー
		// setcookie('userId', '26');

		// 中身が入っていれば実行
		if($post !== false){
			// インスタンス化
			$userModel = new UserModel();

			// クッキーの取得
			$userId = filter_input(INPUT_COOKIE, 'userId');

			// ユーザーの持ちキャラのトータルステータスを更新
			//$userModel->charaStatus( $userId );
		}
    }

}