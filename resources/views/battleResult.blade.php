		{{-- サイズ等指定 --}}
		@include('common/header')
		@include('common/css', ['file' => 'battleResult'])
		
		<div class="battleresult_log">
			<img src="{{IMG_URL}}battle/battleResultlog_Bg.png" class="battleresult_log_bg">				
		</div>
		@if ($viewData['Prize'] > 0)
			<img src="{{IMG_URL}}battle/battleResult_Bg_Win.png" class="battleresult_bg">
			<div>
				勝利！
			</div>
			<div>
				{{$viewData['Prize']}} の賞金を獲得！
			</div>
			<div>
				現在のウィークリーポイント　{{$viewData['RankingData']['weeklyAward']}}
			</div>
		@else
			<img src="{{IMG_URL}}battle/battleResult_Bg_Lose.png" class="battleresult_bg">
			<div>
				敗北...
			</div>
		@endif

		<div class="battleresult_backhome_linkregion">
			<a href="{{APP_URL}}mypage" class="battleresult_backhome_icon">
				<img src={{IMG_URL}}battle/backHome.png >
			</a>
		</div>
	</div>
</body>
