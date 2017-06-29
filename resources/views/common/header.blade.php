<!DOCTYPE html>
<html lang="jp">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gladiator</title>
		<link href="{{APP_URL}}css/reset.css?var={{time()}}" rel="stylesheet" type="text/css">
		<link href="{{APP_URL}}css/style.css?var={{time()}}" rel="stylesheet" type="text/css">
		<link href="{{APP_URL}}css/header.css?var={{time()}}" rel="stylesheet" type="text/css">
		<link href="{{APP_URL}}css/footer.css?var={{time()}}" rel="stylesheet" type="text/css">
		<link href="{{APP_URL}}css/modal.css?var={{time()}}" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
	</head>
	<body>
{{-- popupウインドウ --}}
@include('popup/wrap', [
	'class'		=> 'menuButton', 
	'template'	=> 'menu'
])
<?php if(strpos($_SERVER['REQUEST_URI'],"mypage")){ ?>
{{-- popupウインドウ --}}
@include('popup/wrap', [
	'class'		=> 'changeTeamName', 
	'template'	=> 'changeTeamName'
])
<?php } ?>
	<div id="wrapper">
		<header>
			<div class="headerPosition">
				<img class="headerImg" src="{{IMG_URL}}header/header.png" />
				<p class="modal_btn changeTeamName possession_ornament user_name">{{$viewData['user']['name']}}</p>

				<div class="fadetopButton">
					<a class="location" href="{{APP_URL}}">
						<img class="image_change" src="{{IMG_URL}}header/top.png"/>
					</a>
				</div>
				<div class="fademenuButton">
					<a class="location">
						<img class="modal_btn menuButton image_change" src="{{IMG_URL}}header/menu.png"/>
					</a>
				</div>
				<div>
					<img class="headerGaugeIcon money" src="{{IMG_URL}}header/bar.png" />	
					<img class="headerGaugeIcon moneyIcon" src="{{IMG_URL}}user/gold.png" />
					@if($viewData['user']['money'] < 1000000)
						<p class="possession_ornament possession_money">+999999</p>
					@else
						<p class="possession_ornament possession_money">{{$viewData['user']['money']}}</p>
					@endif
				</div>
				<div>
					<img class="headerGaugeIcon battleTicket" src="{{IMG_URL}}header/bar.png" />
					<img class="headerGaugeIcon battleTicketIcon" src="{{IMG_URL}}user/battleTicket.png" />
					<p class="possession_ornament possession_battleTicket">{{$viewData['Ticket']['battleTicket']}}/5 {{$viewData['recoveryTime']}}</p>
				</div>
			</div>
		</header>
		<div id="main">
