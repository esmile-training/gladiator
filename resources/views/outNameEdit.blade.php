 {{-- css  --}}
 @include('common/css', ['file' => 'edit'])
 <script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/load.js"></script>

<div><img class = "edit_logo" src = "{{IMG_URL}}edit/editLogo.png"></div>
<div id="main">
	<div align="center">
		<div class="edit_frame">
			<p class="error_text">ご入力頂いたお名前は<br>ご利用頂けません。</p>
			<img class="edit_frame_img" src="{{IMG_URL}}popup/popuptop.png" />
			<img class="edit_frame_img" style="height: 20%;" src="{{IMG_URL}}popup/popupmiddle.png" />
			<img class="edit_frame_img" src="{{IMG_URL}}popup/popupbottom.png" />
		</div>

		{{--editへ移動するためのボタン--}}
		<div class="transition_edit_button">
			<a href="{{APP_URL}}mypage/index">
				<img class="transition_button_image image_change" src="{{IMG_URL}}popup/back_Button.png">
			</a>
		</div>
	</div>
</div>