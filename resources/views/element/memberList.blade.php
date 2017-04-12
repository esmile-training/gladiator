{{-- //foreachでメンバーリスト表示する --}}
<div>
    @foreach( $viewData['memberList'] as $type => $memberInfo )
	<div>
	    【{{$type}}】
	</div>
	@foreach( $memberInfo as $name )
	    <div>
		{{$name}}
	    </div>
	@endforeach
    @endforeach
</div>