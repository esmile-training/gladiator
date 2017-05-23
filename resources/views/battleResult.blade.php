		{{-- サイズ等指定 --}}
		@include('common/header')
		@include('common/css', ['file' => 'battleResult'])
		
		@if ($viewData['Prize'] > 0)
			<img src="{{IMG_URL}}battle/battleResult_Bg_Win.png" class="battleResult_background">
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
			<img src="{{IMG_URL}}battle/battleResult_Bg_Lose.png" class="battleResult_background">
			<div>
				敗北...
			</div>
		@endif

		<div>
			<a href="{{APP_URL}}mypage" >
				<img src={{IMG_URL}}battle/backHome.png >
			</a>
		</div>
	</div>
</body>
