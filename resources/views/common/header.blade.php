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
	</head>
	<body>
	<div id="wrapper">
		<header>
			<div class="headerPosition">
				<img class="headerImg" src="{{HEADER_IMG_URL}}header.png" />
				<p class="possession_ornament user_name">{{$viewData['user']['name']}}</p>
				<div class="fadetopButton">
					<a class="location" href="{{APP_URL}}">
						<img class="image_change" src="{{HEADER_IMG_URL}}top.png"/>
					</a>
				</div>
				<div class="fademenuButton">
					<a class="location">
						<img class="modal_btn menuButton image_change" src="{{HEADER_IMG_URL}}menu.png"/>
					</a>
				</div>
				<div>
					<img class="headerGaugeIcon money" src="{{HEADER_IMG_URL}}money.png" />	
					<p class="possession_ornament possession_money">{{$viewData['user']['money']}}</p>
				</div>
				<div>
					<img class="headerGaugeIcon battleTicket" src="{{HEADER_IMG_URL}}battleTicket.png" />
					<p class="possession_ornament possession_battleTicket">{{$viewData['user']['battleTicket']}}/5 {{$viewData['recoveryTime']}}</p>
				</div>
			</div>
		</header>
		<div id="main">
{{-- popupウインドウ --}}
@include('popup/wrap', [
	'class'		=> 'menuButton', 
	'template'	=> 'menu'
])