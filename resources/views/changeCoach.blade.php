<div>
	<center>コーチに配属しますか？</center>
</div>
<div>
	<div>
		<?PHP var_dump($viewData['selectedCoach']);exit; ?>
		@foreach($viewData['selectedCoach'] as $coach)
		<image src="{{IMG_URL}}{{$coach['imgId']}}.png" alt="コーチイメージ"<
			name="imgId" value="{{$coach['id']}}" width="100" height="100">{{$coach['name']}}<br>
			{{--var_dump($coach)--}}
		@endforeach 
	</div>
	<form method="changeCoarch/changeCoach">
		<input type="hidden" name="charaId" value="2">
		<button type="submit">する</button>
	</form>
	<button type="button" onclick="" >しない</button>
</div>
