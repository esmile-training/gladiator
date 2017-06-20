
		{{-- cssの宣言 --}}
		@include('common/header')
		@include('common/css', ['file' => 'battleResult'])

		{{-- バトルの勝敗によって背景画像変更 --}}
		@if ($viewData['prize'] > 0)
			<div><img src="{{IMG_URL}}battleResult/battleBack_Win.jpg" class="battleresult_bg_win"></div>
			<div class="battleresult_logo_win"><img src="{{IMG_URL}}battleResult/battleLogo_Win.png"></div>
		@else
			<div><img src="{{IMG_URL}}battleResult/battleBack_Lose.jpg" class="battleresult_bg_lose"></div>
			<div class="battleresult_logo_lose"><img src="{{IMG_URL}}battleResult/battleLogo_Lose.png"></div>
		@endif

		{{-- リザルトログ表示領域 --}}
		<div class="battleresult_log">
			{{-- リザルトログの枠 --}}
			<img src="{{IMG_URL}}battleResult/n_battleResultlog_Bg.png" class="battleresult_log_bg">
			{{-- バトルの勝敗によって表示するログの変更 --}}
			@if ($viewData['prize'] > 0)
				{{-- プレイヤー勝利時のリザルトログ --}}
				<div class="battleresult_log_message">
					<div>
						{{$viewData['charaDefaultData']['name']}}の勝ち！
					</div>
					<?php $act = $viewData['charaDefaultData']['feverTimeFlug'] == 1 ? 'act' : '' ?>
					<div class="cap {{$act}}">
						フィーバータイム中で賞金2倍！
					</div>
					<div>
						{{$viewData['prize']}}<img src="{{IMG_URL}}user/gold.png" class="battleresult_log_message_money_img"> の賞金を獲得！
					</div>
					<div>
						現在の所持金　
						<span class="battleresult_log_message_upcolor">
							{{$viewData['user']['money']}}
						</span>
						<img src="{{IMG_URL}}user/gold.png" class="battleresult_log_message_money_img">
					</div>
					<div>
						週間獲得賞金　
						<span class="battleresult_log_message_upcolor">
							{{$viewData['rankingData']['weeklyAward']}}
						</span>
						<img src="{{IMG_URL}}user/gold.png" class="battleresult_log_message_money_img">
					</div>
					@if ($viewData['charaUpData']['statusUpCnt'] > 0)
						<div>
							能力上昇！
						</div>
						<div>
							<table border="0">
								<tr valign="middle">
									<td width="6%">
										<img src={{IMG_URL}}chara/status/hp.png class="battleresult_log_message_statusup_hp">
									</td>
									<td width="4%"></td>
									<td width="20%" align="left">
										{{$viewData['charaDefaultData']['hp']}}
									</td>
									<td width="10%">
										⇒
									</td>	
									<td width="20%" align="left">
										<span class="battleresult_log_message_upcolor">
											{{$viewData['charaDefaultData']['hp'] + $viewData['charaUpData']['statusUpCnt']}}	
										</span>
									</td>
									<td width="40%"></td>
								</tr>
							</table>
						</div>
						<div>
							<table border="0">
								<tr valign="middle">
									<td width="6%">
										<img src="{{IMG_URL}}chara/status/hand1.png" class="battleresult_log_message_statusup_goo">
									</td>
									<td width="4%"></td>
									<td width="20%" align="left">
										{{$viewData['charaDefaultData']['gooAtk']}}
									</td>
									<td width="10%">
										⇒
									</td>	
									<td width="20%" align="left">
										@if ($viewData['charaUpData']['gooUpCnt'] > 0)
										<span class="battleresult_log_message_upcolor">
											{{$viewData['charaDefaultData']['gooAtk'] + $viewData['charaUpData']['gooUpCnt']}}
										</span>
										@else
											{{$viewData['charaDefaultData']['gooAtk'] + $viewData['charaUpData']['gooUpCnt']}}
										@endif
									</td>
									<td width="40%"></td>
								</tr>
							</table>
						</div>
						<div>
							<table border="0">
								<tr valign="middle">
									<td width="6%">
										<img src="{{IMG_URL}}chara/status/hand2.png" class="battleresult_log_message_statusup_cho">
									</td>
									<td width="4%"></td>
									<td width="20%" align="left">
										{{$viewData['charaDefaultData']['choAtk']}}
									</td>
									<td width="10%">
										⇒
									</td>	
									<td width="20%" align="left">
										@if ($viewData['charaUpData']['choUpCnt'] > 0)
										<span class="battleresult_log_message_upcolor">
											{{$viewData['charaDefaultData']['choAtk'] + $viewData['charaUpData']['choUpCnt']}}
										</span>
										@else
											{{$viewData['charaDefaultData']['choAtk'] + $viewData['charaUpData']['choUpCnt']}}
										@endif
									</td>
									<td width="40%"></td>
								</tr>
							</table>
						</div>
						<div>
							<table border="0">
								<tr valign="middle">
									<td width="6%">
										<img src="{{IMG_URL}}chara/status/hand3.png" class="battleresult_log_message_statusup_paa">
									</td>
									<td width="4%"></td>
									<td width="20%" align="left">
										{{$viewData['charaDefaultData']['paaAtk']}}
									</td>
									<td width="10%">
										⇒
									</td>	
									<td width="20%" align="left">
										@if ($viewData['charaUpData']['paaUpCnt'] > 0)
										<span class="battleresult_log_message_upcolor">
											{{$viewData['charaDefaultData']['paaAtk'] + $viewData['charaUpData']['paaUpCnt']}}
										</span>
										@else
											{{$viewData['charaDefaultData']['paaAtk'] + $viewData['charaUpData']['paaUpCnt']}}
										@endif
									</td>
									<td width="40%"></td>
								</tr>
							</table>
						</div>
					@endif
				</div>
			@elseif ($viewData['prize'] < 0)
				{{-- プレイヤー降参時のリザルトログ --}}
				<div class="battleresult_log_message">
					<div>
						{{$viewData['charaDefaultData']['name']}} の負け…
					</div>
					<div>
						降参費用として
						<img src="{{IMG_URL}}user/gold.png" class="battleresult_log_message_money_img"> {{$viewData['prize']*-1}} 失った。
					</div>
					<div>
						現在の所持金
						<span class="battleresult_log_message_downcolor">
							<img src="{{IMG_URL}}user/gold.png" class="battleresult_log_message_money_img"> {{$viewData['user']['money']}}
						</span>
					</div>
				</div>
			@else
				@if($viewData['charaDefaultData']['skill'] == 1 && $viewData['charaDefaultData']['imgId'] == 1)
				<font class = "teijiFont">
					定時退社した。
				</font>
				@else
				{{-- プレイヤー敗北時のリザルトログ --}}
					<div class="battleresult_log_message">
						{{$viewData['charaDefaultData']['name']}} は死んだ
					</div>
					<img src="{{IMG_URL}}battleResult/chara_Death.png" class="battleresult_log_death">
				@endif
			@endif
		</div>

		{{-- ホームへ戻るボタンの表示領域 --}}
		<div class="battleresult_backhome_linkregion">
			{{-- ホームへ戻るボタン --}}
			<a href="{{APP_URL}}mypage" class="battleresult_backhome_icon clickfalse">
				<img class="image_change" src="{{IMG_URL}}battleResult/backHome.png" >
			</a>
		</div>
	</div>

	{{-- jsの宣言 --}}
	<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="{{APP_URL}}js/imgChange.js"></script>
	<script type="text/javascript" src="{{APP_URL}}js/resizefont.js"></script>
</body>