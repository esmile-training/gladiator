{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
    <img class="admin_title" src="{{IMG_URL}}test/char{{$getuser['uid']}}.png" style="width: 300px;">
    <?php var_dump($getuser); ?>
</div>


