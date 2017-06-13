<?php
namespace App\Http\Controllers;

class PresentBoxController extends BaseGameController
{
	public function index()
	{
		$this->viewData['presentData'] = $this->Model->exec('PresentBox','confirmation', $this->user['id']);
		return viewWrap('Presentbox',$this->viewData);
	}
}