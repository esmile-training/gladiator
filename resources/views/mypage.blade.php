{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
    <img class="admin_title" src="{{IMG_URL}}test/chara{{$viewData['getuser']['uId']}}.png" style="width: 300px;">
    <?php var_dump($viewData['getuser']); ?>
</div>


