{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])
<?php var_dump($rank)?>
<div>
    <form action="{{APP_URL}}ranking" method="get">
	<?php foreach ($rank as $key => $value) : ?>
	    <p>{{$value[1]}}位 : {{$key}} : {{$value[0]}}pt</p>
	    <br>
	    

	    <?php if (10 < $rank[$key][1] && $value == end($rank)) : ?>
		<button type='submit' name='fullback' value='0'> << </button>
		<button type='submit' name='back' value='{{$rank[$key][1]}}'>back</button>
	    <?php endif; ?>
			    
	    <?php if (count($rank) == 10 && $value == end($rank)) : ?>
		<?php if (filter_input(INPUT_COOKIE, "bottom") != $rank[$key][0]) : ?>
		    <button type='submit' name='next' value='{{$rank[$key][1]}}'>next</button>
		<?php endif; ?>
	    <?php endif;?>
		    
	    <?php if (end($rank) == $value && $rank[$key][0] != filter_input(INPUT_COOKIE, "bottom")) : ?>
		<button type='submit' name='fullnext' value='{{filter_input(INPUT_COOKIE, "count")}}'> >> </button>
	    <?php endif;?>

	<?php endforeach; ?>
	    <br>
	    <button type='submit' name='total' value="0">total</button>
	    <button type='submit' name='week' value="1">week</button>
    </form>
</div>


