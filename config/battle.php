<?php

return [
	// 三すくみの名前
	'typeStr' => [
		'goo' => 'グー',
		'cho' => 'チョキ',
		'paa' => 'パー',
	],
	// 勝敗の名前
	'resultStr' => [
		'win' => '勝ち',
		'lose' => '負け',
		'draw' => 'あいこ',
	],
	// ダメージの変化量(％)
	'damagePer' => [
		'min' => 80,
		'max' => 120,
	],
	// 賞金の歩合
	'prizeStr' =>[
		'Commission' => 30,
	],
	// 敵キャラのレベルによる賞金の補正値(％)
	'prizeRatio' =>[
		1 => 70,
		2 => 100,
		3 => 140,
	]
];
