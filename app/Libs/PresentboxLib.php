<?php

namespace App\Libs;

class PresentboxLib extends BaseGameLib
{
	//一括受け取りボタンが押された場合の処理
	public function receiveAll($receiveData)
	{
		foreach($receiveData as $val)
		{
			switch($val['type'])
			{
				case 1:
					break;
				
				case 2:
					break;
				
				case 3:
					$this->Lib->exec('money','addition',array($this->user,));
					break;
				
				default:
					break;
			
			}
		}
		$this->Model->exec('presentbox','changeDelFlag',$val['id']);
	}
}