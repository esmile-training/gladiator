<!DOCTYPE html>
<html lang="jp">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gladiator</title>
		<link href="{{APP_URL}}css/reset.css?var={{time()}}" rel="stylesheet" type="text/css">
		<link href="{{APP_URL}}css/style.css?var={{time()}}" rel="stylesheet" type="text/css">
		<link href="{{APP_URL}}css/modal.css?var={{time()}}" rel="stylesheet" type="text/css">
	</head>
	<body>
	<div id="wrapper">
		<header>
			<div class="headPosition">
				<img class="headerImg" src="{{MYPAGE_IMG_URL}}headerImg.png" />
				<div class="topButtonArrange topButton">
					<a href="{{APP_URL}}mypage/index"><img class="headButtonImg" src="{{MYPAGE_IMG_URL}}topButton.png" /></a>
				</div>
				<div class="topButtonArrange menuButton">
					<img class="headButtonImg" src="{{MYPAGE_IMG_URL}}menuButton.png" />
				</div>
				<div class="moneyList">
					<img class="moneyGauge" src="{{MYPAGE_IMG_URL}}moneyGauge.png" />
				</div>
				<div class="battleList">
					<img class="battleTicketGauge" src="{{MYPAGE_IMG_URL}}battleTicketGauge.png" />
				</div>
			</div>
<!--			<ul>
				<li><a href="{{APP_URL}}top/login">所持金</a></li>
				<li><a href="{{APP_URL}}top/login">チーム名</a></li>
				<li><a href="{{APP_URL}}top/login">チケット数</a></li>
			</ul>-->
		</header>
		<div id="main">
