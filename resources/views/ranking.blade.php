{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
    <form action="{{APP_URL}}ranking" method="get">
    <?php foreach ($rank as $key => $value) : ?>
    <p>{{$value[1]}}位 : {{$key}} : {{$value[0]}}pt</p>
    <br>
    <?php endforeach; ?>
    <?php if (count($rank) == 10) : ?>
    <input type="submit" name="next" value="next"/>
    <?php endif; ?>
	
    </form>
</div>


