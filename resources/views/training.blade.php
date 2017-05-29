{{--CSS--}}
@include('common/css', ['file' => 'training'])

@include('common/js', ['file' => 'trainingPopup'])

<div>
	<h3>訓練するキャラクターを選んでください。</h3>
</div>

@if(isset($viewData['trainingResult']))
	<div class="modal trainingResult">
		{{--ポップアップウィンドウ--}}
		@include('popup/wrap', [
			'class'		=> "trainingResult",
			'template'	=> 'training',
		])
	</div>
@endif

{{--uChara(DB)から持ってきたデータの表示--}}
@foreach( $viewData['charaList'] as $key => $val)
	<form action="{{APP_URL}}training/coachSelect" method="get" >
		<input type ="submit" name='uCharaId' value="{{$val['id']}}"/>
	</form>
@endforeach
