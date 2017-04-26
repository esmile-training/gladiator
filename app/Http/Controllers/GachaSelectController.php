<?php
namespace App\Http\Controllers;

class GachaSelectController extends BaseGameController
{
    public function index()
    {
		return viewWrap('gachaselect', $this->viewData);
    }

}
