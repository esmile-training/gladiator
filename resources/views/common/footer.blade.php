		</div>
		<footer>
				<div class="footerPosition">

					<img class="footerImg" src="{{IMG_URL}}footer/footer.png" />
					<ul class="iconPosition">
						<li><a class="location" href="{{APP_URL}}mypage/index"><img class="iconsize image_change clickfalse" src="{{IMG_URL}}footer/homeIcon.png" /></a></li>
						@if($viewData['user']['battleTicket'] > 0)
							<li><a class="location" href="{{APP_URL}}battle/selectBattleChara"><img class="iconsize image_change clickfalse" src="{{IMG_URL}}footer/battleIcon.png" /></a></li>
						@else
							<li><img class="location" src="{{IMG_URL}}footer/battleIconDown.png" /></li>
						@endif
						
						@if(0 < $viewData['endTraining']['count'])
							<li>
								<img class="footer_alert image_change clickfalse" src="{{IMG_URL}}footer/AlertIcon.png" />
								<a class="location" href="{{APP_URL}}training/index"><img class="iconsize image_change clickfalse" src="{{IMG_URL}}footer/traningIcon.png" /></a>
							</li>
						@else
							<li><a class="location" href="{{APP_URL}}training/index"><img class="iconsize image_change clickfalse" src="{{IMG_URL}}footer/traningIcon.png" /></a></li>
						@endif
						<li><a class="location" href="{{APP_URL}}gacha/select"><img class="iconsize image_change clickfalse" src="{{IMG_URL}}footer/gachaIcon.png" /></a></li>
					</ul>
				</div>
			</footer>
		</div>
		<script type="text/javascript" src="{{APP_URL}}js/modal.js"></script>
		<script type="text/javascript" src="{{APP_URL}}js/getHeight.js"></script>
		<script type="text/javascript" src="{{APP_URL}}js/imgChange.js"></script>
		<script type="text/javascript" src="{{APP_URL}}js/resizefont.js"></script>
    </body>
</html>
