<div>
	<h3>訓練するキャラクターを選んでください。</h3>
	
	{{--uChara(DB)から持ってきたデータの表示--}}
	@foreach( $viewData['charaList'] as $key => $val)
	<form action="{{APP_URL}}training/coachSelect" method="get" >
		<input type="submit" name='uCharaId' value="{{$val['id']}}"/>
	</form>
	@endforeach
</div>

