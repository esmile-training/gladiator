<div>
    <form action="{{APP_URL}}ranking" method="get">
	<input type="hidden" name="pageType" value="{{$viewData['rankingData']['rankChenge']}}"
	<?php foreach ($viewData['ranking'] as $key => $value) : ?>
	    <?php if(isset($value['weeklyAward'])): ?>
	        <p>{{$value['rank']}}位　：　{{$value['name']}}　：　{{$value['weeklyAward']}}Pt :　{{$value['userId']}}</p>
	    <?php endif; ?>
		
	    <!-- rankの1ページ戻りと最後まで戻る -->
	    <?php if (0 < $viewData['rankingData']['nowpage'] && $value == end($viewData['ranking'])) : ?>
		<button type='submit' name='first' value='0'> << </button>
		<button type='submit' name='back' value='{{$viewData['rankingData']['nowpage'] + 10}}'>back</button>
	    <?php endif; ?>
	    <!-- end -->
	    
	    <!-- rankの範囲検索 -->
	    <?php if($value == end($viewData['ranking'])) : ?>
		<?php if(($viewData['rankingData']['count']) - 2 < $viewData['rankingData']['nowpage'] / 10 + 1): ?>
		    <?php foreach (range(($viewData['rankingData']['count']) - 3, $viewData['rankingData']['count']) as $data) : ?>		   
			<button type="submit" name="page" value="{{($data -1) * 10}}">{{$data}}</button>  
		    <?php endforeach; ?>
			
		<?php elseif(3 < $viewData['rankingData']['nowpage'] / 10 + 1 && 6 <= $viewData['rankingData']['count']): ?>
			
		    <?php foreach (range($viewData['rankingData']['nowpage'] / 10 - 2, ($viewData['rankingData']['nowpage'] / 10 + 2)) as $data) : ?>		   
			<button type="submit" name="page" value="{{($data - 1) * 10}}">{{$data}}</button>  
		    <?php endforeach; ?>
			
		<?php else: ?>
			
		    <?php foreach (range(1, $viewData['rankingData']['count']) as $data) : ?>		   
			<button type="submit" name="page" value="{{($data) * 10}}">{{$data}}</button>  
		    <?php endforeach; ?>
			
		<?php endif; ?>
	    <?php endif; ?>
	    <!-- end -->
	    
	    <!-- 次のrankを表示 -->
	    <?php if (count($viewData['ranking']) == 10 && $value == end($viewData['ranking'])) : ?>
		<?php if (($viewData['rankingData']['count']) != ($viewData['rankingData']['nowpage'] + 10) / 10) : ?>
		    <button type='submit' name='next' value='{{$viewData['rankingData']['nowpage'] + 10}}'>next</button>
		<?php endif; ?>
	    <?php endif;?>
	    <!-- end -->
	    
	    <!-- 最後のrankを表示 -->
	    <?php if (end($viewData['ranking']) == $value && $viewData['rankingData']['count'] != ($viewData['rankingData']['nowpage'] + 10) / 10) : ?>
		<button type='submit' name='last' value='{{$viewData['rankingData']['count'] * 10}}'> >> </button>
	    <?php endif;?>
	    <!-- end -->

	<?php endforeach; ?>
	    <br>
	    <button type='submit' name='dataChenge' value="0">週間ランキング</button>
	    <button type='submit' name='dataChenge' value="1">キャラランキング</button>
    </form>
</div>