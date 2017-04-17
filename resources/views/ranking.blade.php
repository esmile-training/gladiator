{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
    <?php foreach ($rank as $key => $value) : ?>
    <p>{{$value[1]}}位 : {{$key}} : {{$value[0]}}pt</p>
    <br>
    <?php endforeach; ?>
</div>


