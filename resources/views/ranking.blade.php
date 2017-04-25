{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
    <form action="{{APP_URL}}ranking" method="get">
	<?php foreach ($rank as $key => $value) : ?>
	    <p>{{$value['rank']}}位　：　{{$value['name']}}　：　{{$value['totalPoint']}}Pt :　{{$value['userId']}}</p>

	    <!-- rankの1ページ戻りと最後まで戻る -->
	    <?php if (10 < $rank[$key]['rank'] && $value == end($rank)) : ?>
		<button type='submit' name='fullback' value='0'> << </button>
		<button type='submit' name='back' value='{{$rank[$key]['rank']}}'>back</button>
	    <?php endif; ?>
	    <!-- end -->

	    <!-- rankの範囲検索 -->
	    <?php if($value == end($rank)) : ?>
		<?php foreach (range(1, $rankingData['count']) as $data) : ?>
		    <?php if($data < 5):?>
			<button type="submit" name="page" value="{{$data * 10}}">{{$data}}</button>
		    <?php endif; ?>
		<?php endforeach; ?>
	    <?php endif; ?>
	    <!-- end -->

	    <!-- 次のrankを表示 -->
	    <?php if (count($rank) == 10 && $value == end($rank)) : ?>
		<?php if ($rankingData['bottomPoint'] != $rank[$key]['totalPoint']) : ?>
		    <button type='submit' name='next' value='{{$rank[$key]['rank']}}'>next</button>
		<?php endif; ?>
	    <?php endif;?>
	    <!-- end -->

	    <!-- 最後のrankを表示 -->
	    <?php if (end($rank) == $value && $rank[$key]['totalPoint'] != $rankingData['bottomPoint']) : ?>
		<button type='submit' name='fullnext' value='{{$rankingData['count'] * 10}}'> >> </button>
	    <?php endif;?>
	    <!-- end -->

	<?php endforeach; ?>
	    <br>
	    <button type='submit' name='total' value="0">total</button>
	    <button type='submit' name='week' value="1">week</button>
    </form>
</div>


