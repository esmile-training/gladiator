<?php
namespace App\Libs;

class PagerLib extends BaseGameLib
{
    public function valueConf ($nextPage = null, $backPage = null, $lastPage = null, $firstPage = null)	// 値の確認
    {
	// どれか一つの値が入ってるか確認
	if (isset($nextPage)) 
	{
	    return [$nextPage];
	}elseif(isset($backPage)){
	    return PagerLib::backPage($backPage);
	}elseif(isset($firstPage)){
	    return [$firstPage];
	}elseif(isset($lastPage)){
	    return PagerLib::lastPage($lastPage);
	}

    }
    
    public function backPage ($currentPage)	// 前のページを最大値を
    {
	// 変数がセットされているか、ランキングの順位は11位からか
	if(isset($currentPage) && 10 < $currentPage)
	{
	    
	    // offsetのなかから、現在のページから-20させることで1ページ前に戻れる。
	    $currentPage = [$currentPage - 20];
	}
	
	return $currentPage;
    }


    public function lastPage($lastPage)	// 最後のページを表示
    {
	echo 'ok';
	// 1の位の数を切り捨て
	$floor = floor(($lastPage/10))*10;

	// 切り捨ての値と引数が一致すれば実行
	// 切りのいい数字の場合(ex: 40)、最大件数を見てしまうのでそれを避けるために-10させる。
	if($lastPage == $floor){
	    $lastPage = $floor - 10;
	    return $lastPage;
	} else {
	    return $lastPage;
	}
    }
}

