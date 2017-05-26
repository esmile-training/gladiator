@include('common/css', ['file' => 'surrender'])

<div>
	降参しますか？
</div>
<div>
	降参費用：{{$cost}}
</div>
<div>
	<table border="0" class="surrender_button">
		<tr>
			<td width="25%"></td>
			<td width="20%">
				<a>
					<img class="surrender_button_yes" src="{{IMG_URL}}popup/yes_Button.png">
				</a>
			</td>
			<td width="10%"></td>
			<td width="20%">
				<a>
					<img class="surrender_button_no" src="{{IMG_URL}}popup/no_Button.png">
				</a>
			</td>
			<td width="25%"></td>
		</tr>
	</table>
</div>