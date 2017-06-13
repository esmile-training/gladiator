<?php

return [
	// アイテムの能力
	'itemStr' => [
		1	=> [
		'id' => 1,
		// DBで使っている名前
		'name'	=> 'ticket',
		// アイテムを使う場所
		'where'		=> '【闘技場】',
		// 能力説明
		'abilityInfo' => '闘技場出場に必要なチケット',
		],
		2	=> [
		'id' => 2,
		// DBで使っている名前
		'name'	=> 'hpRecovery',
		// 回復するHPの数値(%)
		'ability'	=> 30,
		// アイテムを使う場所
		'where'		=> '【バトル中】',
		// 能力説明
		'abilityInfo' => 'HPを30％回復',
		],
		3	=> [
		'id' => 3,
		// DBで使っている名前
		'name' => 'atkUpper',
		// 次に出す攻撃の倍率
		'ability'	=> 2,
		// アイテムを使う場所
		'where'		=> '【バトル中】',
		// 能力説明
		'abilityInfo' => '次の攻撃の攻撃力を2倍',
		],
		4	=> [
		'id' => 4,
		// DBで使っている名前
		'name' => 'trainigShorter',
		// 短縮できる時間
		'ability'	=> 2,
		// アイテムを使う場所
		'where'		=> '【訓練所】',
		// 能力説明
		'abilityInfo' => '訓練時間を短縮',
		],
	],
];
