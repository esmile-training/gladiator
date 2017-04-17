{{-- //foreachでメンバーリスト表示する --}}
<div style='text-align:center; '>
    <h3>STAFF</h3>
    @foreach( $viewData['memberList'] as $type => $memberInfo )
    <div style="margin:10px;">
	<div style="valign:top;">
	    <span style="font-weight: bold;">＜{{$type}}＞</span>
	</div>
	<div>
	    @foreach( $memberInfo as $name )
		{{$name}}<br />
	    @endforeach
	</div>
    </div>
    @endforeach
</div>