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
			<div class="headerPosition">
				<img class="headerImg" src="{{HEADER_IMG_URL}}header.png" />
				<div class="headerButtonArrange topButton">
					<a href="{{APP_URL}}mypage/index"><img class="headButtonImg" src="{{HEADER_IMG_URL}}topNomal.png" /></a>
				</div>
				<div class="headerButtonArrange menuButton">
					<input type="image" class="headButtonImg" src="{{HEADER_IMG_URL}}menuNomal.png" />
				</div>
				<div class="moneyList">
					<img class="headerButtonArrange moneyGauge" src="{{HEADER_IMG_URL}}money.png" />
				</div>
				<div class="battleList">
					<img class="headerButtonArrange battleTicketGauge" src="{{HEADER_IMG_URL}}battleTicket.png" />
				</div>
			</div>
<!--			<ul>
				<li><a href="{{APP_URL}}top/login">所持金</a></li>
				<li><a href="{{APP_URL}}top/login">チーム名</a></li>
				<li><a href="{{APP_URL}}top/login">チケット数</a></li>
			</ul>-->
		</header>
		<div id="main">
