@include('common/css', ['file' => 'top'])<!DOCTYPE html>
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
		@include('common/css', ['file' => 'top'])

		<div class="top_button top_login">
			<a  href="{{APP_URL}}top/login">ログイン</a>
		</div>

