<!--element/characterListから呼び出し-->
@include('element/characterList')

<?php
    //値を呼び出す実験
    $id = array_column($viewData['charaList'], 'id');
    print_r($id);
?>