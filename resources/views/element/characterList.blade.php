
<div style='text-align:center; '>
    <h3>訓練するキャラクターを選んでください。</h3>  
    
    <!--uChar(DB)から持ってきたデータの表示--> 
    @foreach( $viewData['charaList'] as $id => $charaInfo )   
    <form action="{{APP_URL}}training/setCharaId" method="get" >
        <input type="image" src="{{IMG_URL}}test/char1.jpg" style="width: 90px;">
    </form>
    
    <div style="margin:10px;">
	<div style="valign:top;">
	    <span style="font-weight: bold;">＜{{$id}}＞</span>
	</div>
	<div>
	    @foreach( $charaInfo as $cname )
		{{$cname}}<br />
	    @endforeach
	</div>
    </div>
    @endforeach
</div>
