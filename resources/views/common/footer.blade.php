            </div>
            <footer>
				<div class="footerPosition">

					<img class="footerImg" src="{{FOOTER_IMG_URL}}footer.png" />
					<ul class="iconPosition">
						<li><a class="location" href="{{APP_URL}}mypage/index"><img class="image_change" src="{{FOOTER_IMG_URL}}homeIcon.png" /></a></li>
						@if($viewData['user']['battleTicket'] > 0)
							<li><a class="location" href="{{APP_URL}}battle/selectBattleChara"><img class="image_change" src="{{FOOTER_IMG_URL}}battleIcon.png" /></a></li>
						@else
							<li><img class="location" src="{{FOOTER_IMG_URL}}battleIconDown.png" /></li>
						@endif
						
						@if(0 < $viewData['endTraining']['count'])
							<li>
								<img class="footer_alert image_change" src="{{FOOTER_IMG_URL}}alertIcon.png" />
								<a class="location" href="{{APP_URL}}training/index"><img class="image_change" src="{{FOOTER_IMG_URL}}traningIcon.png" /></a>
							</li>
						@else
							<li><a class="location" href="{{APP_URL}}training/index"><img class="image_change" src="{{FOOTER_IMG_URL}}traningIcon.png" /></a></li>
						@endif
						<li><a class="location" href="{{APP_URL}}gacha/select"><img class="image_change" src="{{FOOTER_IMG_URL}}gachaIcon.png" /></a></li>
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
