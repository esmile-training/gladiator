		{{-- サイズ等指定 --}}
		@include('common/header')
		@include('common/css', ['file' => 'battleResult'])
		
		@if ($viewData['Prize'] > 0)
			<img src="{{IMG_URL}}battle/battleResult_Bg_Win.png" class="battleresult_bg">
		@else
			<img src="{{IMG_URL}}battle/battleResult_Bg_Lose.png" class="battleresult_bg">
		@endif
		
		<div class="battleresult_log">
			<img src="{{IMG_URL}}battle/battleResultlog_Bg.png" class="battleresult_log_bg">
			@if ($viewData['Prize'] > 0)
				<div class="battleresult_log_message">
					{{$viewData['Prize']}} の賞金を獲得！ <br />
					現在の所持金{{$viewData['user']['money']}} <br />
					現在のウィークリーポイント　{{$viewData['RankingData']['weeklyAward']}} <br />
				</div>
			@elseif ($viewData['Prize'] < 0)
				<div class="battleresult_log_message">
					降参費用として {{$viewData['Prize']}} 失った。<br />
					現在の所持金 {{$viewData['user']['money']}} <br />
				</div>	
			@else
				<div class="battleresult_log_message">
					死んだ
				</div>
			@endif
		</div>

		<div class="battleresult_backhome_linkregion">
			<a href="{{APP_URL}}mypage" class="battleresult_backhome_icon">
				<img src={{IMG_URL}}battle/backHome.png >
			</a>
		</div>
	</div>
</body>