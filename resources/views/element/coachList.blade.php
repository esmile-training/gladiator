<div>
    <h3>コーチを選んでください。</h3>  
    
    {{--uCoach(DB)から持ってきたデータの表示--}} 
    @foreach( $viewData['coachList'] as $key => $val)
    <form action="{{APP_URL}}training/setTrainingFinishDate" method="get">
	<input type="submit" name="uCoachId" value="{{$val['uCoachId']}}">
	<input type ="hidden" name="uCharaId" value="{{$viewData['uCharaId']}}">
    @endforeach
	<select name="trainingTime">
	    <option>1</option>
	    <option>2</option>
	    <option>3</option>
	    <option>4</option>
	    <option>5</option>
	    <option>6</option>
	    <option>7</option>
	    <option>8</option>
	    <option>9</option>
	    <option>10</option>
	</select>
    </form>
</div>
