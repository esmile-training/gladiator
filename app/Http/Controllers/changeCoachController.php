<?php

namespace App\Http\Controllers;

class changeCoachController extends BaseGameController
{
	public function index()
	{
		$coachStat = $this->Model->exec('training','getById',$_GET['coachId']);
		$charaStat = $this->Model->exec('UChara','getById',$_GET['charaId']);
		$Stat = array('coach' =>$coachStat, 'chara' => $charaStat);
		return viewWrap('changeCoach', $Stat);
	}
	
	public function changeCoach()
	{
		$this->Model->exec('User', 'deleteCoach', $_GET('coachId'));
		$this->Model->exec('User', 'deleteChara', $_GET('charaId'));
		$this->Model->exec('User', 'insertCoach', $_GET('charaimgId'), $GET('charaname'), $GET('chararare'), $GET('charahp'), $GET('gooAtk'), $GET('choAtk'), $GET('paaAtk'));
	}
}