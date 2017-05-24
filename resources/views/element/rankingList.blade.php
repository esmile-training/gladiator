<div>
	@foreach($viewData['ranking'] as $key => $value)
	    @if(isset($value['weeklyAward']))
	        <p>{{$value['rank']}}位　：　{{$value['name']}}　：　{{$value['weeklyAward']}}Pt :　{{$value['userId']}}</p>
	    @else
			<p>{{$value['rank']}}位　：　{{$value['name']}}　：　TOTAL : {{$value['totalCharaStatus']}}</p>
		@endif

	@endforeach
	
		<!-- rankの1ページ戻りと最後まで戻る -->
	    @if (0 < $viewData['rankingData']['nowpage'] && $value == end($viewData['ranking']))
			<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&first=0"> << </a>
			<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&back={{$viewData['rankingData']['nowpage'] + 10}}">back</a>
	    @endif
	    <!-- end -->
	    
	    <!-- rankの範囲検索 -->
	    @if($value == end($viewData['ranking']))
			<!-- ページ総数がページャーの2ページ目以降あるなら -->
			@if(($viewData['rankingData']['count']) - 2 < $viewData['rankingData']['nowpage'] / 10 + 1 && 5 < $viewData['rankingData']['count'])
			<?php echo "ok" ?>
				@foreach (range(($viewData['rankingData']['count']) - 5, $viewData['rankingData']['count']) as $data)
					<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
				@endforeach
				
			@elseif($viewData['rankingData']['count'] < 5)
				@foreach (range($viewData['rankingData']['count'] - ($viewData['rankingData']['count'] - 1), $viewData['rankingData']['count']) as $data)
					<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
				@endforeach
				
			<!-- 現在のページが3ページ以降でページ総数が6ページ以上あるなら -->
			@elseif(3 <= $viewData['rankingData']['nowpage'] / 10 && 6 <= $viewData['rankingData']['count'])
				@foreach (range($viewData['rankingData']['nowpage']  / 10 - 1, ($viewData['rankingData']['nowpage'] / 10 + 3)) as $data)
					<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
				@endforeach
		
			<!-- 最初の5ページかそれ以下のみ実行される。 -->
			@else
				@if($viewData['rankingData']['count'] < 5)
					@foreach (range(1, $viewData['rankingData']['count']) as $data)
						<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
					@endforeach
				@else
					@foreach (range(1, 5) as $data)
						<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
					@endforeach
				@endif
			@endif
	    @endif
	    <!-- end -->
	    
	    <!-- 次のrankを表示 -->
	    @if (count($viewData['ranking']) == 10 && $value == end($viewData['ranking']))
			@if (($viewData['rankingData']['count']) != ($viewData['rankingData']['nowpage'] + 10) / 10)
				<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&next={{$viewData['rankingData']['nowpage'] + 10}}">next</a>
			@endif
	    @endif
			
		<!-- 最後のrankを表示 -->
	    @if (end($viewData['ranking']) == $value && $viewData['rankingData']['count'] != ($viewData['rankingData']['nowpage'] + 10) / 10)
			<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&last={{$viewData['rankingData']['count'] * 10}}"> >> </a>
	    @endif
	    <!-- end -->
	    <br>
	    <a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&dataChenge=0">weeklypoint</a>
	    <a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&dataChenge=1">userstatus</a>
</div>