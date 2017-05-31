{{-- css  --}}
@include('common/css', ['file' => 'ranking'])
@include('common/js', ['file' => 'admin'])


	{{-- ユーザランキングのページャー --}}
	@include('element/rankingList')
