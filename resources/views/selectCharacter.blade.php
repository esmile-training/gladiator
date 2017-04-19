<!--/*
 * キャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/04/18
 */-->


{{--キャラ選択ビュー--}}
<link href="{{APP_URL}}css/top.css?var={{time()}}" rel="stylesheet" type="text/css">

<div>
		キャラクター一覧
</div>

<div>
	{{var_dump($viewData['characterList'])}}
</div>

<div>
{{--キャラクターリストの表示--}}
<form action="{{APP_URL}}selectCharacter/pickUpCharacter" method="post">
		<div>
		@foreach( $viewData['characterList'] as $value )
		<?php $key = key($value); $name = $value[$key]['NAME'];?>
			<div>
					<input type="radio" name="ID[]" value="<?php echo $key ?>"><?php echo $name ?><br>
			</div>
		@endforeach
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<input type="submit" value="決定">
		</div>
</form>
</div>
