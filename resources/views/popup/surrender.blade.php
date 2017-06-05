@include('common/css', ['file' => 'surrender'])

<div>
	降参しますか？<br />
	@if ($surrenderData['money'] < $surrenderData['cost'])
			降参費用：{{$surrenderData['cost']}}<br />
			現在の所持金：
		<span class="surrender_costOver">{{$surrenderData['money']}}<br />
			降参費用が足りません<br />
		</span>
	@else
		降参費用：{{$surrenderData['cost']}}<br />
		現在の所持金：{{$surrenderData['money']}}<br />
	@endif
	<div class="surrender_button">
		<table border="0">
			<tr>
				<td width="25%"></td>
				<td width="20%">
					@if ($surrenderData['money'] < $surrenderData['cost'])
						<div class="surrender_button_yes">
							<img class="image_change" src="{{IMG_URL}}popup/yes_ButtonDown.png">
						</div>
						
					@else
						<div class="surrender_button_yes clickfalse">
							<a href="{{APP_URL}}battle/makeResultData">
								<img class="image_change" src="{{IMG_URL}}popup/yes_Button.png">
							</a>
						</div>
					@endif
				</td>
				<td width="10%"></td>
				<td width="20%">
					<div class="no surrender_button_no">
						<img class="image_change" src="{{IMG_URL}}popup/no_Button.png">
					</div>
				</td>
				<td width="25%"></td>
			</tr>
		</table>
	</div>
</div>

<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/no.js"></script>