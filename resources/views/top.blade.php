<a  href="{{APP_URL}}top/login">
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
		<div>				
			<img class = "top_back2 backload"src = "{{IMG_URL}}title/titlelogoDown.png">
		</div>
		<div>
			<img src="{{IMG_URL}}title/title{{$viewData['bgNumber']}}.png" class="top_back load">
		</div> 	
			@include('common/css', ['file' => 'top'])
			<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
			<script type="text/javascript" src="{{APP_URL}}js/load.js"></script>
		<div class = "top_imgloginbutton">
			<span class = "flashing">
					<img class = "top_login load"
						 src="{{IMG_URL}}title/titlelogo.png">
			</span>
		</div>
	</body>
</html>
</a>
