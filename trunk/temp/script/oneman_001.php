<?php

$index_scene = 1;

/*
 * An Empty Scene
 *
$v['scene_000'] = array(
'duration'	=> ,
'bg_color'	=> $v['color_blue'],
'camera'	=> array(

),
'object'	=> array(

),
'script'	=> array(

),
'name'		=> 'Scene ');
*
 */

$v['scene_00001'] = array(
		'duration'	=> 133.6,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			//	player big
			array(0, 0, 0.14, 0.85, 1.8, 133.6),
			array(0, 0, 0.14, 0.85, 1.8, 0),
			//	all
			//	array(0, 0, 0.5, 0.5, 1, 133.6),
			//	array(0, 0, 0.5, 0.5, 1, 0),
			//	man big
			//	array(0, 0, 0.75, 0.6, 1.8, 133.6),
			//	array(0, 0, 0.75, 0.6, 1.8, 0),
			//	man middle
			//	array(0, 0, 0.7, 0.5, 1.5, 133.6),
			//	array(0, 0, 0.7, 0.5, 1.5, 0),
			),
		'object'	=> array(
			'room_oneman_hall',
			'item_oneman_light',
			'liuyue',
			),
		'script'	=> array(
			'set cao as kid at 0.6 0.1 size 0.32 ',
			'set caomum as adult at 0.8 0.12 size 0.4 ',
			'look cao at 0 for 10 to 360 ',
			'look caomum at 0 for 9 to 180 ',
			'sub cao at 0 for 9 with 1 body line001 9 ',
			'sub caomum at 0 for 9 with 2 body caomum003 0.5 caomum002 9 ',
			'say caomum at 1 for 1 speak wo cao ta ma a ',
			'set liuyue as kid at 0.31 0.25 size 0.4 ',
			//	speech generated by ogg2txt
			'say liuyue at 2.01 for 0.4 speak da jia hao ',
			'say liuyue at 3.35 for 1.57 speak zhe yi ji wo men yao xue xi he fen xi de ',
			'say liuyue at 5.53 for 0.12 speak shi mei ',
			'say liuyue at 5.9 for 0.89 speak guo dian shi dong hua pian er ',
			'say liuyue at 7.17 for 0.7 speak nan fang gong yuan er ',
			'say liuyue at 8.27 for 1.06 speak di shi ji di ba ji ',
			'say liuyue at 10.09 for 0.43 speak meik lav ',
			'say liuyue at 10.84 for 0.54 speak nat worcraft ',
			'say liuyue at 12.92 for 2.09 speak nan fang gong yuan er zhe ge xi lie you ji hui zai xi shuo ',
			'say liuyue at 15.76 for 0.37 speak jin tian ya ',
			'say liuyue at 16.56 for 0.64 speak wo men zhi ben zhu ',
			'say liuyue at 18.03 for 0.8 speak jiu shuo zhei ge ming zi ',
			'say liuyue at 19.86 for 0.99 speak ta zhi jie fan yi guo lai ',
			'say liuyue at 21.4 for 0.22 speak shi ',
			'say liuyue at 21.86 for 1.18 speak yao zuo ai bu yao mo shou ',
			'say liuyue at 24.29 for 1.13 speak zuo ai da jia ken ding dou zhi dao de bi wo ',
			'say liuyue at 26.66 for 0.57 speak zhe mo shou ne ',
			'say liuyue at 28.13 for 0.9 speak zai wang you quan zi ',
			'say liuyue at 29.26 for 0.71 speak dian wan er quan zi ',
			'say liuyue at 30.61 for 0.58 speak zhi ming du a ',
			'say liuyue at 31.64 for 0.74 speak ye shi xiang dang gao de ',
			'say liuyue at 33.74 for 1.07 speak biao ti li de zhe ge worcraft ',
			'say liuyue at 35.4 for 1.38 speak zhi de shi wang you mo shou shi jie ',
			'say liuyue at 37.49 for 0.71 speak world of worcraft ',
			'say liuyue at 39.48 for 0.88 speak na wo men yao shuo zhe ge biao ',
			'say liuyue at 41.47 for 0.56 speak yao fan yi ta ',
			'say liuyue at 42.25 for 0.34 speak zen me fan yi ',
			'say liuyue at 43.69 for 0.75 speak dai biao de dao ',
			'say liuyue at 44.75 for 0.38 speak shen me yi si ',
			'say liuyue at 46.63 for 0.7 speak qi shi zhe ju hua ',
			'say liuyue at 47.96 for 1.93 speak shi dui leng zhan shi qi yi ju biao yu de e gao ',
			'say liuyue at 51.16 for 0.3 speak jiu shi ',
			'say liuyue at 51.9 for 0.95 speak meik lav nat wor ',
			'say liuyue at 53.57 for 0.44 speak zen me shuo ne ',
			'say liuyue at 54.7 for 1.01 speak yao zuo ai bu yao zhan zheng ',
			'say liuyue at 56.15 for 0.36 speak zhe shen me yi si ',
			'say liuyue at 57.78 for 0.27 speak zhe ge ya ',
			'say liuyue at 58.7 for 0.19 speak he mei ',
			'say liuyue at 59.12 for 1.23 speak guo shang shi ji liu shi nian dai ',
			'say liuyue at 61.4 for 1.24 speak yi xie lie yun dong dou you guan xi ',
			'say liuyue at 63.63 for 0.87 speak bi ru fan chuan tong ',
			'say liuyue at 64.9 for 0.44 speak xing jie fang ',
			'say liuyue at 65.68 for 0.28 speak fan zhan ',
			'say liuyue at 66.58 for 0.55 speak yi xi lie shi ',
			'say liuyue at 69.02 for 1.62 speak worcraft zhe ge ci ne he wor dang ran hen ',
			'say liuyue at 71.88 for 0.44 speak suo yi shuo ',
			'say liuyue at 72.86 for 1.06 speak meik lav nat worcraft ',
			'say liuyue at 74.52 for 0.19 speak zhe ge biao ',
			'say liuyue at 74.93 for 0.11 speak da ',
			'say liuyue at 75.6 for 0.85 speak he mei guo wen hua you ',
			'say liuyue at 76.93 for 0.17 speak guan ',
			'say liuyue at 78.39 for 1.34 speak dan shi wai guo ren jiu bu tai hao li ',
			'say liuyue at 80.66 for 0.81 speak er qie ye bu hao fan yi ',
			'say liuyue at 82.67 for 1.04 speak hao bi zhong guo ren wo shuo ',
			'say liuyue at 84.37 for 1.13 speak hao hao xue xi tian tian shang chuang ',
			'say liuyue at 86.2 for 0.71 speak da jia ken ding zhi dao ',
			'say liuyue at 87.22 for 0.19 speak hui shi er ',
			'say liuyue at 88.15 for 1 speak wai guo ren jiu bu ming bai le ',
			'say liuyue at 89.98 for 1.22 speak ni shuo xue xi he shang chuang you shen me guan xi ',
			'say liuyue at 92.48 for 1.14 speak zhe qi shi mei shen me guan xi ',
			'say liuyue at 94.28 for 0.69 speak e gao biao yu ',
			'say liuyue at 96.16 for 1.02 speak suo yi ne dui yu fan yi ',
			'say liuyue at 98.38 for 0.96 speak jiu you ren fan yi cheng ',
			'say liuyue at 99.9 for 0.12 speak ai ',
			'say liuyue at 100.27 for 0.64 speak zuo ai zuo de shi ',
			'say liuyue at 101.66 for 0.3 speak zhe ge ne ',
			'say liuyue at 102.63 for 0.68 speak guang you meik lav ',
			'say liuyue at 103.83 for 0.57 speak mei you worcraft ',
			'say liuyue at 105.52 for 1.21 speak er qie he zhu ti mei shen me guan xi ',
			'say liuyue at 107.67 for 0.75 speak suo yi wo ge ren ne ',
			'say liuyue at 108.71 for 0.63 speak zan cheng zhi yi ',
			'say liuyue at 110.08 for 0.99 speak yao zuo ai bu mo shou ',
			'say liuyue at 112.92 for 1.4 speak dui yu he wen hua bei jing you guan de a ',
			'say liuyue at 114.83 for 0.42 speak wo dou zan cheng ',
			'say liuyue at 116.29 for 1.3 speak fu he da lu zhe bian de yi guan zuo feng ',
			'say liuyue at 118.42 for 0.41 speak bi jiao yan jin ',
			'say liuyue at 119.25 for 0.53 speak mei shen me pi lou ',
			'say liuyue at 120.7 for 0.34 speak dang ran la ',
			'say liuyue at 121.66 for 0.92 speak zhe ge chun shu ge ren yi jian ',
			'say liuyue at 123.51 for 0.63 speak na xia mian ne ',
			'say liuyue at 124.77 for 1.02 speak wo men lai kan yi kai shi ',
			'say liuyue at 126.34 for 0.92 speak si ge zhu ren gong de chu chang ',
			'say liuyue at 128.29 for 0.35 speak da jia ya ',
			'say liuyue at 128.98 for 0.8 speak xian ting yi xia yuan wen ',
			'say liuyue at 130.46 for 1.19 speak ran hou wo zai lai jin xing fen ',
			),
		'name'		=> 'Scene ');

$v['scene_00002'] = $v['scene_00001'];
$v['scene_00002']['camera'] = array(
			array(0, 0, 0.5, 0.5, 1, 133.6),
			array(0, 0, 0.5, 0.5, 1, 0));

$v['scene_00003'] = $v['scene_00001'];
$v['scene_00003']['camera'] = array(
			array(0, 0, 0.75, 0.6, 1.8, 133.6),
			array(0, 0, 0.75, 0.6, 1.8, 0));

$v['scene_00004'] = $v['scene_00001'];
$v['scene_00004']['camera'] = array(
			array(0, 0, 0.7, 0.5, 1.5, 133.6),
			array(0, 0, 0.7, 0.5, 1.5, 0));

?>
