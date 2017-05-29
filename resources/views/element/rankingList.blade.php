<div><img class="ranking_back_image" src="{{IMG_URL}}ranking/rankingbackimage.png" /></div>

	<img class="ranking_borad" src="{{IMG_URL}}ranking/rankingboard.png" />
	@if(isset($viewData['ranking'][0]['weeklyAward']))
		<img class="weekly_panel" src="{{IMG_URL}}ranking/weekrankingwindow.png"/>
	@else
		<img class="weekly_panel" src="{{IMG_URL}}ranking/totalrankingwindow.png"/>
	@endif
	
	<div class="ranking">
		<table class="ranking_table">
		@foreach($viewData['ranking'] as $key => $value)
			@if(isset($value['weeklyAward']))
			<tr class="ranking_tr">
				@if($value['rank'] <= 3)
					<td class="ranking_img_td"><img class="top_3" src="{{IMG_URL}}ranking/ranking{{$value['rank']}}.png" /></td>
				@else
					<td class="ranking_td">{{$value['rank']}}</td>
				@endif
				<td class="text_height_center">{{$value['name']}}</td>
				<td class="text_height_center point_align">{{$value['weeklyAward']}}Pt</td>
			</tr>
			@else
				<tr class="ranking_tr">
					@if($value['rank'] <= 3)
						<td class="ranking_img_td"><img class="top_3" src="{{IMG_URL}}ranking/ranking{{$value['rank']}}.png" /></td>
					@else
						<td class="ranking_td">{{$value['rank']}}</td>
					@endif
					<td class="text_height_center">{{$value['name']}}</td>
					<td class="text_height_center point_align">{{$value['totalCharaStatus']}}Pt</td>
				</tr>
			@endif
		@endforeach
		</table>
		
		<div class="pager_margin">
		<ul class="back_pager_list">
		<!-- rankの1ページ戻りと最後まで戻る -->
		@if (0 < $viewData['rankingData']['nowpage'] && $value == end($viewData['ranking']))
			<li class="skip_button">
				<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&first=0">
					<img src="{{IMG_URL}}ranking/skipback.png" />
				</a>
			</li>
			<li>
				<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&back={{$viewData['rankingData']['nowpage'] + 10}}">
					<img class="" src="{{IMG_URL}}ranking/back.png" />
				</a>
			</li>
		@endif
		</ul>
		<!-- end -->

		<ul class="pager_list">
		<!-- rankの範囲検索 -->
		@if($value == end($viewData['ranking']))
			<!-- ページ総数がページャーの2ページ目以降あるなら -->
			@if(($viewData['rankingData']['count']) - 2 < $viewData['rankingData']['nowpage'] / 10 + 1 && 5 < $viewData['rankingData']['count'])
				@foreach (range(($viewData['rankingData']['count']) - 4, $viewData['rankingData']['count']) as $data)
					<li class="pager_list_size">
						<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
					</li>
				@endforeach

			@elseif($viewData['rankingData']['count'] < 5)
				@foreach (range($viewData['rankingData']['count'] - ($viewData['rankingData']['count'] - 1), $viewData['rankingData']['count']) as $data)
					<li class="pager_list_size">
						<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
					</li>
				@endforeach

			<!-- 現在のページが3ページ以降でページ総数が6ページ以上あるなら -->
			@elseif(3 <= $viewData['rankingData']['nowpage'] / 10 && 6 <= $viewData['rankingData']['count'])
				@foreach (range($viewData['rankingData']['nowpage']  / 10 - 1, ($viewData['rankingData']['nowpage'] / 10 + 3)) as $data)
					<li class="pager_list_size">
						<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
					</li>
				@endforeach

			<!-- 最初の5ページかそれ以下のみ実行される。 -->
			@else
				@if($viewData['rankingData']['count'] < 5)
					@foreach (range(1, $viewData['rankingData']['count']) as $data)
					<li class="pager_list_size">
						<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
					</li>
					@endforeach
				@else
					@foreach (range(1, 5) as $data)
					<li class="pager_list_size">
						<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&page={{($data -1) * 10}}">{{$data}}</a>
					</li>
					@endforeach
				@endif
			@endif
		@endif
		<!-- end -->
		</ul>

		<ul class="next_pager_list">
		<!-- 次のrankを表示 -->
		@if (count($viewData['ranking']) == 10 && $value == end($viewData['ranking']))
			@if (($viewData['rankingData']['count']) != ($viewData['rankingData']['nowpage'] + 10) / 10)
			<li>
				<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&next={{$viewData['rankingData']['nowpage'] + 10}}">
					<img class="" src="{{IMG_URL}}ranking/next.png" />
				</a>
			</li>
			@endif
		@endif

		<!-- 最後のrankを表示 -->
		@if (end($viewData['ranking']) == $value && $viewData['rankingData']['count'] != ($viewData['rankingData']['nowpage'] + 10) / 10)
		<li class="skip_button">
			<a href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&last={{$viewData['rankingData']['count'] * 10}}">
				<img src="{{IMG_URL}}ranking/skipnext.png" />
			</a>
		</li>
		@endif
		</ul>
		</div>
		<!-- end -->

	<br>
</div>
<a class="week_page" href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&dataChenge=0"></a>
<a class="total_page" href="{{APP_URL}}ranking?pageType={{$viewData['rankingData']['rankChenge']}}&dataChenge=1"></a>