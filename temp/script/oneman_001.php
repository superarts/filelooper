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
			'liuyue',
			'slide_oneman',
			'item_oneman_light',
			'furniture_oneman_platform',
			),
		'script'	=> array(
			/*
			'set cao as kid at 0.6 0.1 size 0.32 ',
			'set caomum as adult at 0.8 0.12 size 0.4 ',
			'look cao at 0 for 10 to 360 ',
			'look caomum at 0 for 9 to 180 ',
			'sub cao at 0 for 9 with 1 body line001 9 ',
			'sub caomum at 0 for 9 with 2 body caomum003 0.5 caomum002 9 ',
			'say caomum at 1 for 1 speak wo cao ta ma a ',
			 */

			'set liuyue as kid at 0.31 0.25 size 0.4 ',
			'blend item_oneman_light at 4 for 1 from 100 to 0 ',
			'blend item_oneman_light at 130 for 1 from 0 to 100 ',
			'sub slide_oneman at 0 for 999 with 3 item null 5 item/slide/oneman_001_01 125 null 999 ',
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

$v['scene_00005'] = array(
		'duration'	=> 323,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			//	player big
			array(0, 0, 0.14, 0.85, 1.8, 323),
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
			'liuyue',
			'slide_oneman',
			'item_oneman_light',
			'furniture_oneman_platform',
			),
		'script'	=> array(
			'set liuyue as kid at 0.31 0.25 size 0.4 ',
			'blend item_oneman_light at 7.5 for 1 from 100 to 0 ',
			'blend item_oneman_light at 291 for 1 from 0 to 100 ',
			'sub slide_oneman at 0 for 999 with 11 item null 8.5 item/slide/oneman_001_02 128.5 null 1 item/slide/oneman_001_03 43 null 1 item/slide/oneman_001_04 49 null 1 item/slide/oneman_001_05 48 null 1 item/slide/oneman_001_06 28 null 999 ',
			//	speech generated by ogg2txt
			'say liuyue at 2.43 for 1.17 speak gu shi de kai shi hen jian dan ',
			'say liuyue at 4.49 for 1.13 speak zhu jue men yi kuai da you xi ',
			'say liuyue at 6.43 for 0.91 speak zan men lai kan kan ta men de hua ',
			'say liuyue at 9.6 for 1.05 speak zhe kat man qu la shi ',
			'say liuyue at 11.2 for 0.74 speak hui lai zhao bu zhao ren le ',
			'say liuyue at 12.47 for 0.32 speak ge zhao hu ',
			'say liuyue at 13.89 for 0.41 speak shou xian ne ',
			'say liuyue at 14.6 for 0.55 speak wo men lai shuo diud ',
			'say liuyue at 16.39 for 0.34 speak diud zhe ge ci ',
			'say liuyue at 16.95 for 0.13 speak er a ',
			'say liuyue at 17.75 for 0.52 speak bi jiao biao zhun ',
			'say liuyue at 18.53 for 0.34 speak fan yi shi ',
			'say liuyue at 19.17 for 0.14 speak huo jia ',
			'say liuyue at 20.27 for 0.28 speak bu guo ne ',
			'say liuyue at 20.96 for 0.41 speak qi shi mei zhe me ',
			'say liuyue at 22.61 for 0.44 speak jiu shi ge men er ',
			'say liuyue at 23.91 for 0.48 speak pian nan xing ',
			'say liuyue at 25.31 for 1.09 speak zai mei guo ren sheng huo zhong hen ',
			'say liuyue at 26.68 for 0.19 speak chang jian ',
			'say liuyue at 27.96 for 1.73 speak bi ru zai zhe ge dian ying beis kit bol li ',
			'say liuyue at 30.6 for 0.83 speak na mait sdoun ta ',
			'say liuyue at 31.8 for 0.43 speak le yi ge pang ',
			'say liuyue at 33.13 for 0.75 speak shuo ta qi shi shi nan de ',
			'say liuyue at 34.73 for 0.55 speak ta yong de ne jiu shi ',
			'say liuyue at 35.74 for 0.53 speak shis a diud ',
			'say liuyue at 37.44 for 0.39 speak ling wai ne ',
			'say liuyue at 38.28 for 0.62 speak dan du shuo ',
			'say liuyue at 39.48 for 0.26 speak diud ',
			'say liuyue at 40.6 for 0.66 speak zhe hai ke yi biao da gan ',
			'say liuyue at 42.2 for 0.93 speak gen ni yong zhong wen shuo ',
			'say liuyue at 43.61 for 0.49 speak da ge ',
			'say liuyue at 44.79 for 0.12 speak you dian ',
			'say liuyue at 46.59 for 0.44 speak ran hou ne ',
			'say liuyue at 47.26 for 0.93 speak wo men zai lai shuo krap zhe ge ',
			'say liuyue at 49.59 for 0.34 speak krap jiu shi ',
			'say liuyue at 51.53 for 0.34 speak shi ',
			'say liuyue at 52.53 for 1.94 speak ni shi yi i tuo o shi ',
			'say liuyue at 55.46 for 0.32 speak jiu shi zhei ge ',
			'say liuyue at 56.84 for 0.73 speak he shit cha bu duo ',
			'say liuyue at 58.34 for 0.59 speak zai mei guo ya ',
			'say liuyue at 59.49 for 0.33 speak shuo shit ',
			'say liuyue at 60.94 for 0.68 speak zhe shi ma jie ',
			'say liuyue at 62.63 for 0.41 speak yao shuo krap ',
			'say liuyue at 63.92 for 0.13 speak na ',
			'say liuyue at 65.23 for 1.15 speak xi guan ne gen zhong wen bu yi yang ',
			'say liuyue at 67.49 for 0.37 speak bi fang shuo ',
			'say liuyue at 68.25 for 0.29 speak ta ma de ',
			'say liuyue at 69.26 for 1.16 speak na bie ren dou zhi dao ni zai ma jie ',
			'say liuyue at 71.17 for 0.67 speak ni yao da ma lu shang ',
			'say liuyue at 72.15 for 0.16 speak shuo ',
			'say liuyue at 72.95 for 0.17 speak shi ',
			'say liuyue at 73.64 for 0.28 speak da bian ',
			'say liuyue at 74.86 for 0.15 speak ruo yang ',
			'say liuyue at 76.1 for 1.36 speak ren jia hai yi wei ni nei ji zhao ce suo ',
			'say liuyue at 79.26 for 0.26 speak bu guo ya ',
			'say liuyue at 80.46 for 0.66 speak yao lun ma jie de cheng du ',
			'say liuyue at 82.28 for 0.4 speak krap jiu ',
			'say liuyue at 83.04 for 0.35 speak shit cha ',
			'say liuyue at 83.7 for 0.18 speak duo le ',
			'say liuyue at 84.85 for 0.5 speak ye jiu shi shuo ne ',
			'say liuyue at 85.99 for 0.2 speak shit ',
			'say liuyue at 86.53 for 0.41 speak bi krap ',
			'say liuyue at 88.51 for 1.2 speak ju ti zen me ge zang fa ',
			'say liuyue at 90.97 for 0.69 speak ke neng jiu dei nin ',
			'say liuyue at 92.1 for 0.6 speak zi ge wen wen le ',
			'say liuyue at 94.18 for 0.22 speak yi yang ',
			'say liuyue at 95.19 for 1.65 speak he shit de xing rong chi shiti cha bu ',
			'say liuyue at 97.82 for 1.03 speak krap de xing rong ci krapi ',
			'say liuyue at 99.39 for 1.09 speak ye shi biao shi bu zen me yang de ',
			'say liuyue at 101.85 for 0.38 speak jiu shi bad ',
			'say liuyue at 104.16 for 0.67 speak na you ren shuo le ',
			'say liuyue at 105.49 for 1.09 speak ni shuo bad bu jiu wan le ma ',
			'say liuyue at 106.98 for 0.53 speak hai krapi gan ma ',
			'say liuyue at 108.69 for 0.69 speak zhe jiu shi ni shuo ',
			'say liuyue at 110.04 for 1.53 speak you ren shuo ying yu hao o shen me jiao hao ',
			'say liuyue at 112.62 for 0.49 speak zhe ge shen me jiao ',
			'say liuyue at 114.48 for 1.02 speak yong jin ke neng shao de ',
			'say liuyue at 116.28 for 1.21 speak biao da jin ke neng duo de yi si ',
			'say liuyue at 118.76 for 0.61 speak bad shi huai mei ',
			'say liuyue at 120.21 for 0.53 speak dan krapi ne ',
			'say liuyue at 121.45 for 1.39 speak hai dai zhe yi ge bu zhong yao ',
			'say liuyue at 123.53 for 0.53 speak yi wen bu zhi ',
			'say liuyue at 124.65 for 0.34 speak mei yi si ',
			'say liuyue at 125.74 for 0.22 speak zhe xie yi ',
			'say liuyue at 127.4 for 0.56 speak suo yi zai yong de shi ',
			'say liuyue at 128.98 for 0.96 speak yao jin ke neng tiao ',
			'say liuyue at 130.29 for 1.61 speak neng jing que biao da zi ji yi si de ',
			'say liuyue at 133.03 for 1.59 speak zhe yang nei jiu hui shuo qi lai hen neitiv ',
			'say liuyue at 134.99 for 0.35 speak hen you ben ',
			'say liuyue at 135.56 for 0.19 speak guo hua ',
			'say liuyue at 139.35 for 1.35 speak kail shuo le ',
			'say liuyue at 141.76 for 0.78 speak bu guo dong hua li wo ',
			'say liuyue at 142.76 for 0.33 speak mei kan jian ',
			'say liuyue at 143.97 for 0.93 speak ui mo shou shi jie chang jing ',
			'say liuyue at 146.75 for 0.57 speak katman shuo ',
			'say liuyue at 147.59 for 0.44 speak wo hui lai le ',
			'say liuyue at 148.62 for 0.42 speak sdan shuo le yi ju ',
			'say liuyue at 149.56 for 0.14 speak diud ',
			'say liuyue at 150.37 for 0.92 speak wiv bin weiting forever ',
			'say liuyue at 152.57 for 0.92 speak dude wo men gang cai shuo guo le ',
			'say liuyue at 154.32 for 1.25 speak wiv bin weiting forever zhe ju hua ',
			'say liuyue at 155.97 for 0.29 speak da jia qing ',
			'say liuyue at 158.29 for 0.97 speak de zi mian yi yi shi ',
			'say liuyue at 159.76 for 1.54 speak wo men yi jing deng le yong yuan na me yuan ',
			'say liuyue at 162.38 for 0.6 speak yong yuan you duo yuan ',
			'say liuyue at 164.17 for 0.77 speak ta biao da de jiu shi ',
			'say liuyue at 165.47 for 1.1 speak wo men deng ni lao ban tian le ',
			'say liuyue at 167.22 for 0.14 speak zhe ge yi ',
			'say liuyue at 168.79 for 0.76 speak suo yi shuo zhei ju hua ',
			'say liuyue at 170.04 for 0.16 speak ei dian ',
			'say liuyue at 170.43 for 0.34 speak ming le ',
			'say liuyue at 171 for 0.39 speak mei ban fa ',
			'say liuyue at 172.58 for 0.8 speak na dui zhe zhong hua ne ',
			'say liuyue at 174.11 for 0.2 speak zui hao ',
			'say liuyue at 174.53 for 0.39 speak xue xi fang fa ',
			'say liuyue at 175.44 for 0.49 speak jiu shi duo nian ',
			'say liuyue at 176.42 for 0.34 speak ba ta bei xia ',
			'say liuyue at 177.66 for 0.16 speak zhe yang ',
			'say liuyue at 178.42 for 0.26 speak yu dao ',
			'say liuyue at 178.91 for 0.33 speak cha bu duo de ',
			'say liuyue at 179.63 for 0.6 speak jiu neng zhi jie yong ',
			'say liuyue at 182.42 for 0.53 speak katman shuo ',
			'say liuyue at 183.85 for 0.14 speak ai ya ',
			'say liuyue at 184.29 for 0.39 speak nei ge dui ',
			'say liuyue at 185.59 for 0.49 speak wo zong de la shi ',
			'say liuyue at 187.43 for 0.38 speak kail shuo ',
			'say liuyue at 188.48 for 1.92 speak ni yao bu lao chi zhe me duo ni ye bu hui lao la zhe me duo ',
			'say liuyue at 192.13 for 0.84 speak zhu yi zhei ge ',
			'say liuyue at 193.75 for 0.59 speak daiaril zhege ',
			'say liuyue at 195.35 for 0.92 speak ta shi ge yi xue yong yu ',
			'say liuyue at 197.06 for 0.3 speak fu xie ',
			'say liuyue at 198.52 for 0.31 speak er bi jiao ',
			'say liuyue at 200.25 for 0.86 speak shuo kail gen tibag cha ',
			'say liuyue at 201.35 for 0.34 speak cha bu duo ',
			'say liuyue at 202.3 for 0.62 speak ci hui liang bi jiao da ',
			'say liuyue at 203.82 for 0.94 speak zai zhei ge xue xiao ',
			'say liuyue at 205.42 for 0.18 speak yi xie ',
			'say liuyue at 205.87 for 0.56 speak bi sai li mian de jiang ',
			'say liuyue at 206.67 for 0.27 speak bi yi ban xiao hai ',
			'say liuyue at 208.04 for 1.1 speak suo yi ta ne yong ci bi jiao ',
			'say liuyue at 210.67 for 0.6 speak xiao gu ye bi jiao ',
			'say liuyue at 212.87 for 0.91 speak yao zhu yi ta ',
			'say liuyue at 214.22 for 0.29 speak katman ',
			'say liuyue at 214.77 for 0.19 speak sheng hu ',
			'say liuyue at 215.5 for 0.2 speak fat ass ',
			'say liuyue at 216.69 for 0.5 speak fat shi pang ',
			'say liuyue at 217.68 for 0.26 speak ass shi ',
			'say liuyue at 219.41 for 0.86 speak zhu yi ass ye shi zang ',
			'say liuyue at 221.33 for 0.29 speak suo yi ne ',
			'say liuyue at 222.1 for 0.23 speak batass ',
			'say liuyue at 222.87 for 0.16 speak na ye shi ',
			'say liuyue at 223.28 for 0.25 speak zang hua ',
			'say liuyue at 223.98 for 0.4 speak ni yao gen ',
			'say liuyue at 224.6 for 0.64 speak ma lu shang ei ',
			'say liuyue at 225.47 for 0.68 speak yi mei guo da pang zi ',
			'say liuyue at 226.9 for 0.89 speak hai fatass wazzap ',
			'say liuyue at 228.61 for 0.2 speak an ',
			'say liuyue at 229.07 for 0.56 speak ren jia ken ding zhao ni ',
			'say liuyue at 233.09 for 1.25 speak katman yi ting bu gao xing la ',
			'say liuyue at 235.14 for 0.59 speak dao bu shi yin wei ',
			'say liuyue at 235.99 for 0.64 speak kail jiao ta fatass ',
			'say liuyue at 237.61 for 0.56 speak nan fang gong yuan li ',
			'say liuyue at 238.75 for 0.18 speak zhei ge ',
			'say liuyue at 239.57 for 0.53 speak kou tou yu er ',
			'say liuyue at 240.77 for 0.59 speak dai chu lai ',
			'say liuyue at 242.25 for 0.93 speak bu neng suan ma jie ',
			'say liuyue at 244.21 for 0.55 speak ta bu gao xing a ',
			'say liuyue at 245.02 for 0.93 speak shi yin wei ta gen kail ',
			'say liuyue at 246.23 for 0.92 speak yu shi tian sheng de dui tou ',
			'say liuyue at 247.72 for 0.38 speak lao da jia ',
			'say liuyue at 248.84 for 0.4 speak chuo shen me dou bu gao ',
			'say liuyue at 250.26 for 0.55 speak suo yi ta you shuo le ',
			'say liuyue at 251.54 for 1.47 speak wo bu yong ting yi sha bi nv ren nian dao ',
			'say liuyue at 254.05 for 0.66 speak zhu yi zhei ge friki ',
			'say liuyue at 255.74 for 1.13 speak friki ya ta bu suan zang hua ',
			'say liuyue at 257.54 for 0.23 speak xiang si ',
			'say liuyue at 258.31 for 0.74 speak dan shi frik zhe ge ',
			'say liuyue at 259.82 for 1.23 speak ben shen ye ju you gong ji xing ',
			'say liuyue at 262.26 for 1.11 speak frik ben yi shi guai tai ',
			'say liuyue at 264.57 for 1.11 speak ni yao shuo yi ge ren shi frik ',
			'say liuyue at 266.17 for 0.86 speak ye jiu shi shuo ta shi guai ren ',
			'say liuyue at 267.66 for 0.12 speak zhe ge ya ',
			'say liuyue at 268.07 for 0.4 speak xiang dang de bu li ',
			'say liuyue at 269.65 for 0.25 speak bu guo ne ',
			'say liuyue at 270.56 for 0.87 speak dui yu hen duo yi shu jia ',
			'say liuyue at 271.74 for 0.68 speak jiu yao ling dang bie lun le ',
			'say liuyue at 272.94 for 0.53 speak zi cheng frik de ye bu ',
			'say liuyue at 275.32 for 0.31 speak ling wai ne ',
			'say liuyue at 276.25 for 2.42 speak chu le katman ta xi guan zhe ge chu kou cheng zang yi wai ',
			'say liuyue at 279.47 for 0.71 speak friki ben shen ne ',
			'say liuyue at 280.76 for 0.99 speak ye ke yi li jie shi ',
			'say liuyue at 282.53 for 0.62 speak yong ben yi lai ',
			'say liuyue at 284.18 for 1.6 speak biao shi kail ta ren wu chuai de ',
			'say liuyue at 287.38 for 1.22 speak na zan men zai lai kan xia mian zhe duan ',
			'say liuyue at 292.47 for 0.71 speak kenni ta ',
			'say liuyue at 293.48 for 1.1 speak shuo hua yi xiang han hu bu qing a ',
			'say liuyue at 295.55 for 0.5 speak ta ye zan tong ',
			'say liuyue at 296.38 for 0.35 speak shuo zhei ge ',
			'say liuyue at 296.95 for 0.56 speak kail de da ban ne ',
			'say liuyue at 297.74 for 0.42 speak que shi bi jiao gao ',
			'say liuyue at 299.11 for 0.6 speak katman jiu shuo le ',
			'say liuyue at 300.13 for 0.22 speak totolli ',
			'say liuyue at 300.94 for 0.62 speak ei ta biao shi zan tong ',
			'say liuyue at 302.03 for 0.24 speak ta bi jiao ',
			'say liuyue at 303.62 for 0.34 speak he wo men ',
			'say liuyue at 304.2 for 0.66 speak yi huo ye ke yi kan dao ',
			'say liuyue at 306.18 for 2.61 speak kail ti yi da jia yi qi qu sdoun haven zhe li qu zuo ren wu ',
			'say liuyue at 310.13 for 0.49 speak fen xi jie shu ',
			'say liuyue at 311.32 for 0.63 speak wo men ne zai kan ',
			'say liuyue at 312.68 for 0.49 speak zhu yi diud ',
			'say liuyue at 313.69 for 0.14 speak krap ',
			'say liuyue at 314.19 for 0.42 speak friki zhe ji ',
			'say liuyue at 315.01 for 0.23 speak ci de yong fa ',
			'say liuyue at 316.21 for 1.11 speak zhe ji ge mei guo kou tou yu ne ',
			'say liuyue at 317.96 for 0.41 speak jue men yong de hen ',
			),
		'name'		=> 'Scene ');

$v['scene_00006'] = $v['scene_00005'];
$v['scene_00006']['camera'] = array(
			array(0, 0, 0.5, 0.5, 1, 323),
			array(0, 0, 0.5, 0.5, 1, 0));

$v['scene_00007'] = $v['scene_00005'];
$v['scene_00007']['camera'] = array(
			array(0, 0, 0.75, 0.6, 1.8, 323),
			array(0, 0, 0.75, 0.6, 1.8, 0));

$v['scene_00008'] = $v['scene_00005'];
$v['scene_00008']['camera'] = array(
			array(0, 0, 0.7, 0.5, 1.5, 323),
			array(0, 0, 0.7, 0.5, 1.5, 0));

$v['scene_00009'] = array(
		'duration'	=> 49,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			//	player big
			array(0, 0, 0.14, 0.85, 1.8, 49),
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
			'liuyue',
			//'slide_oneman',
			'item_oneman_light',
			'furniture_oneman_platform',
			),
		'script'	=> array(
			'set liuyue as kid at 0.31 0.25 size 0.4 ',
			//'blend item_oneman_light at 7.5 for 1 from 100 to 0 ',
			//'blend item_oneman_light at 291 for 1 from 0 to 100 ',
			//'sub slide_oneman at 0 for 999 with 9 item null 8.5 item/slide/oneman_001_02 128.5 null 1 item/slide/oneman_001_03 43 null 1 item/slide/oneman_001_04 49 null 1 item/slide/oneman_001_05 48 null 999 ',
			//	speech generated by ogg2txt
			'say liuyue at 1.86 for 0.47 speak zhei shi hou ',
			'say liuyue at 3.11 for 0.88 speak sdan de lao ba randi ',
			'say liuyue at 5.95 for 1.74 speak zhei ji nan fang gong yuan bi jiao te shu de di fang ',
			'say liuyue at 8.45 for 0.84 speak jiu shi hen duo chang jing ',
			'say liuyue at 9.63 for 0.47 speak dou shi yong ',
			'say liuyue at 10.43 for 0.9 speak mo shou shi jie de you xi yin ',
			'say liuyue at 12.96 for 0.61 speak kan qi lai zhei ge wang ',
			'say liuyue at 13.82 for 0.86 speak you de wei dao xiang dang zhong ',
			'say liuyue at 15.68 for 1.47 speak bao kou shuo mo xing de duo bian xing shu hen shao ',
			'say liuyue at 17.41 for 0.45 speak ao kan qi lai ken ',
			'say liuyue at 19.65 for 0.26 speak dang ran la ',
			'say liuyue at 20.6 for 2.55 speak hua shuo nan fang gong yuan zi ji de dong hua kan qi lai ',
			'say liuyue at 23.56 for 0.29 speak geng cu ',
			'say liuyue at 24.56 for 1.55 speak bu guo ge wei bu yao yi wei zhei ge ',
			'say liuyue at 26.37 for 0.48 speak ke ji han liang ',
			'say liuyue at 28.18 for 0.72 speak cong di wu ji kai shi ',
			'say liuyue at 29.48 for 1.09 speak zhi zuo xuan ran dou shi yong ma ya ',
			'say liuyue at 32.02 for 0.71 speak ma ya zhei ge ',
			'say liuyue at 33.24 for 1.48 speak san wei dong hua ruan jian ta xiang dang gao duan ',
			'say liuyue at 35.46 for 0.63 speak tai tan ni ke hao ',
			'say liuyue at 36.33 for 0.28 speak shi yong ma ya ',
			'say liuyue at 38.5 for 0.26 speak dang ran la ',
			'say liuyue at 39.51 for 2.06 speak wo gu ji nan fang gong yuan zhei ge fu wu qi ji qun ',
			'say liuyue at 41.81 for 0.11 speak meng mei ',
			'say liuyue at 42.41 for 0.22 speak ke hao ',
			'say liuyue at 43.69 for 0.6 speak zan men lai kan zhei duan ',
			),
		'name'		=> 'Scene ');

$v['scene_00010'] = $v['scene_00009'];
$v['scene_00010']['camera'] = array(
			array(0, 0, 0.5, 0.5, 1, 49),
			array(0, 0, 0.5, 0.5, 1, 0));

$v['scene_00011'] = $v['scene_00009'];
$v['scene_00011']['camera'] = array(
			array(0, 0, 0.75, 0.6, 1.8, 49),
			array(0, 0, 0.75, 0.6, 1.8, 0));

$v['scene_00012'] = $v['scene_00009'];
$v['scene_00012']['camera'] = array(
			array(0, 0, 0.7, 0.5, 1.5, 49),
			array(0, 0, 0.7, 0.5, 1.5, 0));

$v['scene_00013'] = array(
		'duration'	=> 136,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			//	player big
			array(0, 0, 0.14, 0.85, 1.8, 136),
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
			'liuyue',
			'slide_oneman',
			'item_oneman_light',
			'furniture_oneman_platform',
			),
		'script'	=> array(
			'set liuyue as kid at 0.31 0.25 size 0.4 ',
			'blend item_oneman_light at 1 for 1 from 100 to 0 ',
			'blend item_oneman_light at 134.5 for 1 from 0 to 100 ',
			'sub slide_oneman at 0 for 999 with 5 item null 2 item/slide/oneman_001_07 32 null 1 item/slide/oneman_001_08 99 null 1 ',
			//	speech generated by ogg2txt
			'say liuyue at 0.84 for 0.13 speak m ',
			'say liuyue at 2.8 for 1.1 speak sdan ta ba randi han ta ',
			'say liuyue at 4.61 for 0.97 speak stan gen peng you men shuo ',
			'say liuyue at 6.02 for 1.38 speak deng hui ge men wo ba zhao wo you dian shi ',
			'say liuyue at 7.86 for 0.44 speak hen bu gao xing ',
			'say liuyue at 8.96 for 0.69 speak sdan ta ba shuo ',
			'say liuyue at 9.99 for 0.12 speak wot ',
			'say liuyue at 11.26 for 0.96 speak yong tian jin hua shuo jiu shi ',
			'say liuyue at 12.75 for 0.2 speak gan ma ',
			'say liuyue at 14.21 for 0.95 speak ta ba ba hen yan su ',
			'say liuyue at 16.25 for 1.94 speak shuo zheng ge zhou mo ni dou zai dian nao qian zuo zhe ',
			'say liuyue at 18.94 for 2.15 speak ni bu jue de ni ying gai chu qu gen peng you men gao she jiao ma ',
			'say liuyue at 22.84 for 0.76 speak you dian xiang zhong guo lao ',
			'say liuyue at 25.76 for 0.42 speak zhu yi ',
			'say liuyue at 26.77 for 0.3 speak hang on ',
			'say liuyue at 27.75 for 0.73 speak my dad wants samsing ',
			'say liuyue at 29.44 for 0.97 speak be on wans campiute ',
			'say liuyue at 31.37 for 1.08 speak solshoulaiz wiz yuer frend ',
			'say liuyue at 36.34 for 1.39 speak sdan de biao xian ne hen jiu ling hou ',
			'say liuyue at 38.74 for 1.8 speak shuo wo zhe zheng she jiao zhe ne ruo zhi ',
			'say liuyue at 41.42 for 1.31 speak ran hou ta shuo le yi ju bi jiao chang de hua ',
			'say liuyue at 43.47 for 1.24 speak wo he lai zi quan shi jie de ren yi ',
			'say liuyue at 44.96 for 3.51 speak qi deng lu dao yi ge em em ou a pi zhi xi tong shang ran hou he wo de tuan diu yi qi ',
			'say liuyue at 49.09 for 2.22 speak yi bian yong maik gou tong yi bian huo de jing yan ',
			'say liuyue at 52.54 for 0.49 speak zhu yi shuo ',
			'say liuyue at 53.3 for 0.26 speak deng lu ',
			'say liuyue at 53.87 for 0.26 speak log on ',
			'say liuyue at 54.79 for 0.38 speak jing yan zhi ',
			'say liuyue at 56.45 for 0.76 speak jiu shi eikspirens ',
			'say liuyue at 58.56 for 0.48 speak tuan dui yu yin ',
			'say liuyue at 59.34 for 0.33 speak tim spik ',
			'say liuyue at 60.48 for 1.66 speak zhei xie ne dou shi ji suan ji fang mian de shu yu ',
			'say liuyue at 63.52 for 1.49 speak zhei ge em em ou a pi zhi ne ',
			'say liuyue at 65.52 for 0.26 speak jiu shi ',
			'say liuyue at 66.26 for 2.74 speak da xing duo ren zai xian jue se ban yan you xi ',
			'say liuyue at 69.93 for 2.2 speak masev maltipleir onlain roul pleiing ',
			'say liuyue at 73.9 for 2.13 speak masiv shi da gui mo sha shang xing wu qi ',
			'say liuyue at 76.41 for 0.47 speak da sha qi ',
			'say liuyue at 77.14 for 1.45 speak ei li mian de nei ge da gui mo ',
			'say liuyue at 79.75 for 0.53 speak rou pleiing ',
			'say liuyue at 80.52 for 0.53 speak jiu jue se ban yan ',
			'say liuyue at 82.23 for 1.03 speak wo men zhe li bu jiang you xi shu yu ',
			'say liuyue at 84.01 for 0.99 speak yi hou you ji hui zai xi shuo ',
			'say liuyue at 87.26 for 1.84 speak jing guo sdan zhe me yi fan qiang bao zhi hou ne ',
			'say liuyue at 89.9 for 1.47 speak mei guo lao ba chen mo le ban xiang ',
			'say liuyue at 91.97 for 0.86 speak shang xin de shuo le yi ju ',
			'say liuyue at 93.51 for 0.82 speak wo bu shi ruo zhi ',
			'say liuyue at 95.09 for 0.23 speak zou le ',
			'say liuyue at 95.98 for 1.32 speak zhei ge di fang jiu hen mei shi you mo ',
			'say liuyue at 97.91 for 0.88 speak shu yu na ruan di zhao le ',
			'say liuyue at 99.92 for 1.19 speak zhi yu atade zhe ge ci ne ',
			'say liuyue at 101.7 for 0.65 speak qi shi jiu shi ritad ',
			'say liuyue at 103.19 for 0.2 speak zhi zhang ',
			'say liuyue at 103.74 for 0.29 speak ruo zhi ',
			'say liuyue at 104.49 for 0.13 speak zhe yi si ',
			'say liuyue at 105.73 for 1.62 speak da jia dou ying gai zhi dao yu ren jie ',
			'say liuyue at 108.23 for 0.35 speak eipel ',
			'say liuyue at 108.87 for 0.31 speak fuls dei ',
			'say liuyue at 109.56 for 0.48 speak zhei ge ful ',
			'say liuyue at 110.62 for 0.32 speak shi ',
			'say liuyue at 111.31 for 0.12 speak gua ',
			'say liuyue at 112.28 for 0.69 speak ful bu suan ma jie ',
			'say liuyue at 113.51 for 0.97 speak bu guo ni yao shi shuo ritad ',
			'say liuyue at 114.98 for 1.24 speak na jiu ju you hen qiang de gong ji xing ',
			'say liuyue at 117.26 for 1.28 speak zai di twilv de em vi ',
			'say liuyue at 118.82 for 0.47 speak mai band li ',
			'say liuyue at 120.04 for 0.79 speak biza ne jiu dui ',
			'say liuyue at 121.29 for 0.49 speak ji zhe shuo ',
			'say liuyue at 122.58 for 1.16 speak bich a yiu ritadid ',
			'say liuyue at 124.87 for 0.48 speak zhei nian tou ',
			'say liuyue at 125.62 for 1.19 speak nei bich nei ci dou mei xiao yin ',
			'say liuyue at 127.39 for 1.37 speak dan shi ritaded que gei xiao yin le ',
			'say liuyue at 129.16 for 0.82 speak ke jian zhei ge ci hen lie hai ',
			'say liuyue at 130.86 for 0.7 speak zan men zai kanyi bian ',
			'say liuyue at 132.25 for 0.82 speak shun bian ti hui yi xia ',
			'say liuyue at 133.32 for 0.22 speak you mo ',
			),
		'name'		=> 'Scene ');

$v['scene_00014'] = $v['scene_00013'];
$v['scene_00014']['camera'] = array(
			array(0, 0, 0.5, 0.5, 1, 136),
			array(0, 0, 0.5, 0.5, 1, 0));

$v['scene_00015'] = $v['scene_00013'];
$v['scene_00015']['camera'] = array(
			array(0, 0, 0.75, 0.6, 1.8, 136),
			array(0, 0, 0.75, 0.6, 1.8, 0));

$v['scene_00016'] = $v['scene_00013'];
$v['scene_00016']['camera'] = array(
			array(0, 0, 0.7, 0.5, 1.5, 136),
			array(0, 0, 0.7, 0.5, 1.5, 0));

$v['scene_00017'] = array(
		'duration'	=> 77,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			//	player big
			array(0, 0, 0.14, 0.85, 1.8, 77),
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
			'liuyue',
			//'slide_oneman',
			'item_oneman_light',
			'furniture_oneman_platform',
			),
		'script'	=> array(
			'say liuyue at 2.46 for 2.58 speak mei guo zui shou huan ying dian shi dong hua pian ',
			'say liuyue at 6.36 for 0.49 speak da jia hao ',
			'say liuyue at 7.53 for 1.51 speak zhe yi ji wo men yao xue xi he fen xi de ',
			'say liuyue at 9.68 for 1.27 speak shi mei guo dian shi dong hua pian ',
			'say liuyue at 11.27 for 0.7 speak nan fang gong yuan ',
			'say liuyue at 12.4 for 1.02 speak di shi ji di ba ',
			'say liuyue at 14.18 for 0.38 speak meik lav ',
			'say liuyue at 14.99 for 0.54 speak nat worcraft ',
			'say liuyue at 17.92 for 2.35 speak xiao xue er nian ji xue sheng jing cai yan yi ',
			'say liuyue at 21.83 for 1.58 speak zuo ai da jia ken ding dou zhi dao de bi wo ',
			'say liuyue at 23.65 for 0.18 speak qing ',
			'say liuyue at 25.85 for 1.26 speak ying yu dan ci fen xi ',
			'say liuyue at 28.7 for 0.35 speak crap ',
			'say liuyue at 29.32 for 0.4 speak jiu shi ',
			'say liuyue at 30.03 for 0.29 speak shi ',
			'say liuyue at 31.44 for 0.38 speak shi ',
			'say liuyue at 32.18 for 2.41 speak ni shi yi i tuo o shi ',
			'say liuyue at 36.35 for 1.27 speak mei guo wen hua chang ',
			'say liuyue at 39.36 for 2.77 speak qi shi zhe ju hua shi dui leng zhan shi qi yi ju biao yu de e ',
			'say liuyue at 43.06 for 0.75 speak jiu shi meik lav ',
			'say liuyue at 44.13 for 0.33 speak nat wor ',
			'say liuyue at 46.06 for 1.45 speak dian shi ju re dian dian ping ',
			'say liuyue at 48.95 for 1.21 speak mei guo lao ba chen mo ban ',
			'say liuyue at 51.12 for 0.92 speak shang xin de shuo le ju ',
			'say liuyue at 52.64 for 0.68 speak wo bu shi ruo zhi ',
			'say liuyue at 54.33 for 0.97 speak am not a atard ',
			'say liuyue at 57.24 for 0.66 speak zhei ge di fang hen mei ',
			'say liuyue at 58.19 for 0.22 speak you mo ',
			'say liuyue at 59.8 for 1.24 speak xue xi fang fa tan tao ',
			'say liuyue at 62.47 for 0.94 speak zui hao de xue xi fang fa ',
			'say liuyue at 63.64 for 0.64 speak jiu shi ba ta bei xia lai ',
			'say liuyue at 65.1 for 0.7 speak yu dao cha bu duo de ',
			'say liuyue at 66.17 for 0.54 speak chang he zhi jie yong ',
			'say liuyue at 67.97 for 0.68 speak yi qie jin zai ',
			'say liuyue at 68.95 for 1.03 speak yi jia jiang tan ',
			'say liuyue at 71.15 for 1.15 speak wan man show ',
			),
		'name'		=> 'Scene ');

$v['scene_00018'] = $v['scene_00017'];
$v['scene_00018']['camera'] = array(
			array(0, 0, 0.5, 0.5, 1, 77),
			array(0, 0, 0.5, 0.5, 1, 0));

$v['scene_00019'] = $v['scene_00017'];
$v['scene_00019']['camera'] = array(
			array(0, 0, 0.75, 0.6, 1.8, 77),
			array(0, 0, 0.75, 0.6, 1.8, 0));

$v['scene_00020'] = $v['scene_00017'];
$v['scene_00020']['camera'] = array(
			array(0, 0, 0.7, 0.5, 1.5, 77),
			array(0, 0, 0.7, 0.5, 1.5, 0));

?>
