		{{-- cssの宣言 --}}
		@include('common/header')
		@include('common/css', ['file' => 'battleResult'])

		{{-- バトルの勝敗によって背景画像変更 --}}
		@if ($viewData['prize'] > 0)
			<img src="{{IMG_URL}}battleResult/battleResult_Bg_Win.jpg" class="battleresult_bg">
		@else
			<img src="{{IMG_URL}}battleResult/battleResult_Bg_Lose.jpg" class="battleresult_bg">
		@endif

		{{-- リザルトログ表示領域 --}}
		<div class="battleresult_log">
			{{-- リザルトログの枠 --}}
			<img src="{{IMG_URL}}battleResult/battleResultlog_Bg.png" class="battleresult_log_bg">
			{{-- バトルの勝敗によって表示するログの変更 --}}
			@if ($viewData['prize'] > 0)
				{{-- プレイヤー勝利時のリザルトログ --}}
				<div class="battleresult_log_message">
					{{$viewData['charaDefaultData']['name']}}の勝ち！ <br />
					{{$viewData['prize']}} の賞金を獲得！ <br />
					現在の所持金　
					<span class="battleresult_log_message_upcolor">
						{{$viewData['user']['money']}} <br />
					</span>
					週間獲得賞金　
					<span class="battleresult_log_message_upcolor">
						{{$viewData['rankingData']['weeklyAward']}} <br />
					</span>
					@if ($viewData['charaUpData']['statusUpCnt'] > 0)
						能力上昇！<br />
						<img src={{IMG_URL}}chara/status/hp.png class="battleresult_log_message_statusup_hp">
							{{$viewData['charaDefaultData']['hp']}}　⇒　
						<span class="battleresult_log_message_upcolor">
							{{$viewData['charaDefaultData']['hp'] + $viewData['charaUpData']['statusUpCnt']}}<br />	
						</span>
						<img src={{IMG_URL}}chara/status/hand1.png class="battleresult_log_message_statusup_goo">
							{{$viewData['charaDefaultData']['gooAtk']}}　⇒　
						@if ($viewData['charaUpData']['gooUpCnt'] > 0)
						<span class="battleresult_log_message_upcolor">
							{{$viewData['charaDefaultData']['gooAtk'] + $viewData['charaUpData']['gooUpCnt']}}<br />
						</span>
						@else
							{{$viewData['charaDefaultData']['gooAtk'] + $viewData['charaUpData']['gooUpCnt']}}<br />
						@endif
						<img src={{IMG_URL}}chara/status/hand2.png class="battleresult_log_message_statusup_cho">
							{{$viewData['charaDefaultData']['choAtk']}}　⇒　
						@if ($viewData['charaUpData']['choUpCnt'] > 0)
						<span class="battleresult_log_message_upcolor">
							{{$viewData['charaDefaultData']['choAtk'] + $viewData['charaUpData']['choUpCnt']}}<br />
						</span>
						@else
							{{$viewData['charaDefaultData']['choAtk'] + $viewData['charaUpData']['choUpCnt']}}<br />
						@endif
						<img src={{IMG_URL}}chara/status/hand3.png class="battleresult_log_message_statusup_paa">
							{{$viewData['charaDefaultData']['paaAtk']}}　⇒　
						@if ($viewData['charaUpData']['paaUpCnt'] > 0)
						<span class="battleresult_log_message_upcolor">
							{{$viewData['charaDefaultData']['paaAtk'] + $viewData['charaUpData']['paaUpCnt']}}<br />
						</span>
						@else
							{{$viewData['charaDefaultData']['paaAtk'] + $viewData['charaUpData']['paaUpCnt']}}<br />
						@endif
					@endif
				</div>
			@elseif ($viewData['prize'] < 0)
				{{-- プレイヤー降参時のリザルトログ --}}
				<div class="battleresult_log_message">
					{{$viewData['charaDefaultData']['name']}} の負け… <br />
					降参費用として
					{{$viewData['prize']}} 失った。<br />
					現在の所持金
					<span class="battleresult_log_message_downcolor">
						{{$viewData['user']['money']}} <br />
					</span>
				</div>
			@else
				{{-- プレイヤー敗北時のリザルトログ --}}
				<div class="battleresult_log_message">
					{{$viewData['charaDefaultData']['name']}} は死んだ <br />
				</div>
				<img src={{IMG_URL}}battleResult/chara_Death class="battleresult_log_death">
			@endif
		</div>

		{{-- ホームへ戻るボタンの表示領域 --}}
		<div class="battleresult_backhome_linkregion">
			{{-- ホームへ戻るボタン --}}
			<a href="{{APP_URL}}mypage" class="battleresult_backhome_icon clickfalse">
				<img class="image_change" src={{IMG_URL}}battleResult/backHome.png >
			</a>
		</div>
	</div>

	{{-- jsの宣言 --}}
	<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="{{APP_URL}}js/imgChange.js"></script>
	<script type="text/javascript" src="{{APP_URL}}js/resizefont.js"></script>
</body>