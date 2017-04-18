{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
    <form action="{{APP_URL}}ranking" method="get">
	<?php foreach ($rank as $key => $value) : ?>
	    <p>{{$value[1]}}位 : {{$key}} : {{$value[0]}}pt</p>
	    <br>
	<?php if (count($rank) == 10 && $value == end($rank)) : ?>
	    <button type='submit' name='next' value='{{$rank[$key][1]}}'>next</button>
	<?php endif;?>
	<?php if (11 < $rank[$key][1] && $value == end($rank)) : ?>
	    <button type='submit' name='back' value='{{$rank[$key][1]}}'>back</button>
	<?php endif; ?>
    
    <?php endforeach; ?>
    
    
	
    </form>
</div>


