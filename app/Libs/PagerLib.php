<?php
namespace App\Libs;

class PagerLib extends BaseGameLib
{
    public function valueConf ($nextPage = null, $backPage = null, $firstPage = null, $lastPage = null)	// 値の確認
    {
	// どれか一つの値が入ってるか確認
	if (isset($nextPage)) 
	{
	    return PagerLib::nextPage($nextPage);
	}elseif(isset($backPage)){
	    return PageLib::backPage($backPage);
	}elseif(isset($firstPage)){
	    return $firstPage;
	}elseif(isset($lastPage)){
	    return $lastPage;
	}elseif(!isset($nextPage) && !isset($backPage) && !isset($firstPage) && !isset($lastPage)){	// 何も入ってなければnull
	    return null;
	}

    }
    
    public function nextPage ($currentPage)	// 次のページを表示
    {
	return $currentPage;
    }
    
    public function backPage ($currentPage)	// 前のページを表示
    {
	// 変数がセットされているか、ランキングの順位は11位からか
	if(isset($currentPage) && 10 < $currentPage)
	{
	    // offsetのなかから、現在のページから-10させる。
	    $currentPage = [$currentPage - 10];
	}
	
	return $currentPage;
    }
    
    public function lastPage($lastPage)	// 最後のページを表示
    {
	// 1の位の数を切り捨て
	$floor = floor(($lastPage/10))*10;

	// 切り捨ての値と引数が一致すれば実行
	// 切りのいい数字の場合(ex: 40)その数でも表示されるため10を引く
	if($lastPage == $floor){
	    $lastPage = $floor - 10;
	    return $lastPage;
	} else {
	    return $lastPage;
	}
    }
}

