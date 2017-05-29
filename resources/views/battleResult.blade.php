		{{-- cssの宣言 --}}
		@include('common/header')
		@include('common/css', ['file' => 'battleResult'])

		{{-- バトルの勝敗によって背景画像変更 --}}
		@if ($viewData['Prize'] > 0)
			<img src="{{IMG_URL}}battle/battleResult_Bg_Win.png" class="battleresult_bg">
		@else
			<img src="{{IMG_URL}}battle/battleResult_Bg_Lose.png" class="battleresult_bg">
		@endif

		{{-- リザルトログ表示領域 --}}
		<div class="battleresult_log">
			{{-- リザルトログの枠 -}}
			<img src="{{IMG_URL}}battle/battleResultlog_Bg.png" class="battleresult_log_bg">
			{{-- バトルの勝敗によって表示するログの変更 --}}
			@if ($viewData['Prize'] > 0)
				{{-- プレイヤー勝利時のリザルトログ --}}
				<div class="battleresult_log_message">
					{{$viewData['Prize']}} の賞金を獲得！ <br />
					現在の所持金{{$viewData['user']['money']}} <br />
					現在のウィークリーポイント　{{$viewData['RankingData']['weeklyAward']}} <br />
					@if ($viewData['CharaUpData']['statusUpCnt'] > 0)
						能力上昇！<br />
						HP		{{$viewData['CharaDefaultData']['hp']}}　⇒　{{$viewData['CharaDefaultData']['hp'] + $viewData['CharaUpData']['statusUpCnt']}}<br />
						グー		{{$viewData['CharaDefaultData']['gooAtk']}}　⇒　{{$viewData['CharaDefaultData']['gooAtk'] + $viewData['CharaUpData']['gooUpCnt']}}<br />
						チョキ	{{$viewData['CharaDefaultData']['choAtk']}}　⇒　{{$viewData['CharaDefaultData']['choAtk'] + $viewData['CharaUpData']['choUpCnt']}}<br />
						パー		{{$viewData['CharaDefaultData']['paaAtk']}}　⇒　{{$viewData['CharaDefaultData']['paaAtk'] + $viewData['CharaUpData']['paaUpCnt']}}<br />
					@endif
				</div>
			@elseif ($viewData['Prize'] < 0)
				{{-- プレイヤー降参時のリザルトログ --}}
				<div class="battleresult_log_message">
					降参費用として {{$viewData['Prize']}} 失った。<br />
					現在の所持金 {{$viewData['user']['money']}} <br />
				</div>
			@else
				{{-- プレイヤー敗北時のリザルトログ --}}
				<div class="battleresult_log_message">
					死んだ
				</div>
			@endif
		</div>

		{{-- ホームへ戻るボタンの表示領域 --}}
		<div class="battleresult_backhome_linkregion">
			{{-- ホームへ戻るボタン --}}
			<a href="{{APP_URL}}mypage" class="battleresult_backhome_icon">
				<img class="image_change" src={{IMG_URL}}battle/backHome.png >
			</a>
		</div>
	</div>

	{{-- jsの宣言 --}}
	<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="{{APP_URL}}js/imgChange.js"></script>
</body>