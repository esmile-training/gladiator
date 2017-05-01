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
		'初級' => 70,
		'中級' => 100,
		'上級' => 140,
	],
	// 難易度
	'level' =>[
		'easy' => '初級',
		'nomal' => '中級',
		'hard' => '上級',
	],
];
