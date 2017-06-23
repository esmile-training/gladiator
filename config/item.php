<?php

return [
	// アイテムの能力
	'itemStr' => [
		1	=> [
		'id' => 1,
		// 表示名
		'name'	=> 'チケット',
		// DBで使っている名前
		'dbName'	=> 'ticket',
		// 回復するチケットの数
		'ability'	=> 1,
		// アイテムを使う場所
		'where'		=> '【闘技場】',
		// 能力説明
		'abilityInfo' => '闘技場出場に必要なチケット',
		],
		2	=> [
		'id' => 2,
		// 表示名
		'name'	=> '薬草',
		// DBで使っている名前
		'dbName'	=> 'hpRecovery',
		// 回復するHPの数値(%)
		'ability'	=> 30,
		// アイテムを使う場所
		'where'		=> '【バトル中】',
		// 能力説明
		'abilityInfo' => 'HPを30％回復',
		],
		3	=> [
		'id' => 3,
		// 表示名
		'name'	=> '肉',
		// DBで使っている名前
		'dbName' => 'atkUpper',
		// 次に出す攻撃の倍率
		'ability'	=> 2,
		// アイテムを使う場所
		'where'		=> '【バトル中】',
		// 能力説明
		'abilityInfo' => '1ターン得意属性の攻撃力を2倍',
		],
		4	=> [
		'id' => 4,
		// 表示名
		'name'	=> '砂時計',
		// DBで使っている名前
		'dbName' => 'trainigShorter',
		// 短縮できる時間
		'ability'	=> 1,
		// アイテムを使う場所
		'where'		=> '【訓練所】',
		// 能力説明
		'abilityInfo' => '訓練時間を1時間短縮',
		],
	],
];
