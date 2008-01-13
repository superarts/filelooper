<?php

$index_scene = 5;

/*
   3	taiyang: wei, cao a, wo ri.
   6	cao: wo cao, ni shui a?
   4	taiyang: wo ri a.
   7	cao: wo cao, ni dao di shi shui a?
   5	taiyang: wo ri a! ni cao ba?
   8	cao: wo cao a! wo cao! ni shi shui a?
		taiyang: wo ri! wo ri a!
   9	cao: wo cao!
 */

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

$v['scene_00014'] = array(
	'duration'	=> 3,
	'bg_color'	=> $v['color_sun_living_room'],
	'camera'	=> array(
		array(-0.7, 0.4, 0.5, 0.5, 2, 5),
		array(-0.7, 0.4, 0.5, 0.5, 2, 0),
	),
	'object'	=> array(
		'room_taiyang',
		'photo_taiyang_fanghuayuan',
		'taiyangmum',
		'taiyang',
	),
	'script'	=> array(
		'set taiyang as kid at 0.6 0.16 size 0.4 ',
		'set taiyangmum as adult at 0.9 0.16 size 0.5 ',
		'sub taiyangmum at 0 for 9 with 1 body sunmum002 3 ',
		'look taiyang at 0 for 9 to 360 ',
		'look taiyangmum at 0 for 9 to 180 ',
		'say taiyangmum at 1 for 1.069 speak wo ri ta ma ',
	),
	'name'		=> 'Scene ');

$v['scene_00013'] = array(
		'duration'	=> 3,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(-0.6, 0.17, 0.5, 0.5, 2, 3),
			array(-0.6, 0.17, 0.5, 0.5, 2, 0),
			),
		'object'	=> array(
			'room_cao',
			'cao',
			'caomum',
			),
		'script'	=> array(
			'set cao as kid at 0.6 0.1 size 0.32 ',
			'set caomum as adult at 0.8 0.12 size 0.4 ',
			'look cao at 0 for 10 to 360 ',
			'look caomum at 0 for 9 to 180 ',
			'sub cao at 0 for 9 with 1 body line001 9 ',
			'sub caomum at 0 for 9 with 2 body caomum003 0.5 caomum002 9 ',
			'say caomum at 1 for 1.354 speak wo cao ta ma a ',
			),
		'name'		=> 'Scene ');

/*
   Cao runs to his mother.
   This scene has been cut.
 */
/*
$v['scene_10012'] = array(
		'duration'	=> 3,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(0.2, 0, 0.5, 0.5, 1.2, 3),
			array(-0.2, 0, 0.5, 0.5, 1.2, 0),
			),
		'object'	=> array(
			'room_cao',
			'caomum',
			'cao',
			),
		'script'	=> array(
			'set cao as kid at 0.16 0.15 size 0.32 ',
			'set caomum as adult at 0.8 0.12 size 0.4 ',
			'look cao at 0 for 10 to 360 ',
			'look caomum at 0 for 9 to 180 ',
			'sub cao at 0 for 9 with 1 body line001 9 ',
			'goto cao at 0 for 2 walk 0.4 0 stay 1 walk 0 0 ',
			),
		'name'		=> 'Scene ');
*/

$v['scene_00012'] = array(
	'duration'	=> 5,
	'bg_color'	=> $v['color_sun_living_room'],
	'camera'	=> array(
		array(-0.7, 0.4, 0.5, 0.5, 1.7, 5),
		array(-0.7, 0.4, 0.5, 0.5, 2, 0),
	),
	'object'	=> array(
		'room_taiyang',
		'photo_taiyang_fanghuayuan',
		'taiyangmum',
		'taiyang',
	),
	'script'	=> array(
		'set taiyang as kid at 0.6 0.16 size 0.4 ',
		'set taiyangmum as adult at 0.9 0.16 size 0.5 ',
		'sub taiyangmum at 0 for 9 with 1 body sunmum002 3 ',
		'look taiyang at 0 for 9 to 360 ',
		'look taiyangmum at 0 for 9 to 180 ',
		'say taiyangmum at 1 for 2.782 speak wo ri ta ma ya cao ni ma ne ',
	),
	'name'		=> 'Scene ');

$v['scene_00011'] = array(
		'duration'	=> 6,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(-0.05, 0.1, 0.5, 0.5, 1, 3),
			array(-0.1, 0.1, 0.5, 0.5, 1, 3),
			array(-0.1, 0.1, 0.5, 0.5, 1, 0),
			),
		'object'	=> array(
			'room_taiyang',
			'photo_taiyang_fanghuayuan',
			'taiyangmum',
			'taiyang',
			),
		'script'	=> array(
			'set taiyang as kid at 0.65 0.16 size 0.4 ',
			'set taiyangmum as adult at 1.35 0.16 size 0.5 ',
			'goto taiyangmum at 0 for 2 walk -0.45 0 stay 5 walk 0 0 ',
			'look taiyang at 0 for 0.5 to 180 ',
			'look taiyang at 0.5 for 3.8 to 360 ',
			'look taiyang at 4.3 for 1.5 to 180 ',
			'look taiyang at 5.8 for 5 to 360 ',
			//	'goto taiyang at 4.8 for 1 walk -0.15 0 stay 5 walk 0 0 ',
			'goto taiyang at 1.5 for 0.3 jump 0 0.06 stay 1 walk 0 0 for 1 walk 0.1 0 for 0.2 jump 0 -0.15 for 0.2 jump 0 0.15 stay 0.5 walk 0 0 for 1 walk -0.15 0 stay 5 walk 0 0 ',
			'sub taiyang at 0 for 3 with 2 body line003 1.7 line001 5 ',
			'sub taiyangmum at 4 for 3 with 2 body sunmum003 0.2 sunmum002 3 ',
			'look taiyangmum at 0 for 6 to 180 ',
			//	'say taiyang at 0.5 for 2 speak wo ri a ni cao ba ',
			//	'say taiyangmum at 0.5 for 2 speak ce shi ce shi ',
			),
		'name'		=> 'Scene ');

/*
 * cao: wo cao!
 */
$v['scene_00010'] = array(
		'duration'	=> 2.5,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(0.4, 0.1, 0.5, 0.5, 1.6, 3),
			array(0.4, 0.1, 0.5, 0.5, 1.6, 0),
			),
		'object'	=> array(
			'room_cao',
			'cao',
			),
		'script'	=> array(
			'set cao as kid at 0.16 0.27 size 0.35 ',
			'look cao at 0 for 10 to 360 ',
			'say cao at 0.5 for 1.267 speak wo cao ',
			),
		'name'		=> 'Scene ');

/*
 * cao: wo cao a! wo cao! ni shi shui a?
 */
$v['scene_00008'] = array(
		'duration'	=> 3,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(0.4, 0.1, 0.5, 0.5, 1.6, 3),
			array(0.4, 0.1, 0.5, 0.5, 1.6, 0),
			),
		'object'	=> array(
			'room_cao',
			'cao',
			),
		'script'	=> array(
			'set cao as kid at 0.16 0.27 size 0.35 ',
			'look cao at 0 for 10 to 360 ',
			'say cao at 0.5 for 1.942 speak wo cao a wo cao ni shi shui a ',
			),
		'name'		=> 'Scene ');

/*
 * cao: wo cao! ni dao di shi shui a?
 */
$v['scene_00006'] = array(
		'duration'	=> 3,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(0.4, 0.1, 0.5, 0.5, 1.6, 3),
			array(0.4, 0.1, 0.5, 0.5, 1.6, 0),
			),
		'object'	=> array(
			'room_cao',
			'cao',
			),
		'script'	=> array(
			'set cao as kid at 0.16 0.27 size 0.35 ',
			'look cao at 0 for 10 to 360 ',
			'say cao at 0.5 for 1.739 speak wo cao ni dao di shi shui a ',
			),
		'name'		=> 'Scene ');

/*
 * cao: wo cao, ni shui a?
 */
$v['scene_00004'] = array(
		'duration'	=> 2,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(0.4, 0.1, 0.5, 0.5, 1.6, 3),
			array(0.4, 0.1, 0.5, 0.5, 1.6, 0),
			),
		'object'	=> array(
			'room_cao',
			'cao',
			),
		'script'	=> array(
			'set cao as kid at 0.16 0.27 size 0.35 ',
			'look cao at 0 for 10 to 360 ',
			'say cao at 0.25 for 1.165 speak wo cao ni shui a ',
			),
		'name'		=> 'Scene ');

$v['scene_00009'] = array(
		'duration'	=> 3,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(-0.2, 0, 0.5, 0.5, 1.5, 3),
			array(-0.2, 0, 0.5, 0.5, 1.5, 0),
			),
		'object'	=> array(
			'room_taiyang',
			'photo_taiyang_fanghuayuan',
			'taiyang',
			),
		'script'	=> array(
			'set taiyang as kid at 0.65 0.16 size 0.4 ',
			'look taiyang at 0 for 3 to 180 ',
			'sub taiyang at 0 for 3 with 1 body line003 3 ',
			'say taiyang at 0.5 for 1.646 speak wo ri wo ri a ',
			),
		'name'		=> 'Scene ');

$v['scene_00007'] = array(
		'duration'	=> 3,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(-0.2, 0, 0.5, 0.5, 1.5, 3),
			array(-0.2, 0, 0.5, 0.5, 1.5, 0),
			),
		'object'	=> array(
			'room_taiyang',
			'photo_taiyang_fanghuayuan',
			'taiyang',
			),
		'script'	=> array(
			'set taiyang as kid at 0.65 0.16 size 0.4 ',
			'look taiyang at 0 for 3 to 180 ',
			'sub taiyang at 0 for 3 with 1 body line003 3 ',
			'say taiyang at 0.5 for 2.082 speak wo ri a ni cao ba ',
			),
		'name'		=> 'Scene ');

$v['scene_00005'] = array(
		'duration'	=> 2,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(-0.18, 0, 0.5, 0.5, 1.5, 3),
			array(-0.18, 0, 0.5, 0.5, 1.5, 0),
			),
		'object'	=> array(
			'room_taiyang',
			'photo_taiyang_fanghuayuan',
			'taiyang',
			),
		'script'	=> array(
			'set taiyang as kid at 0.65 0.16 size 0.4 ',
			'look taiyang at 0 for 3 to 180 ',
			'sub taiyang at 0 for 2 with 1 body line003 3 ',
			'say taiyang at 0.5 for 0.686 speak wo ri a ',
			),
		'name'		=> 'Scene ');

$v['scene_00003'] = array(
		'duration'	=> 3,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(-0.2, 0, 0.5, 0.5, 1.5, 3),
			array(-0.2, 0, 0.5, 0.5, 1.5, 0),
			),
		'object'	=> array(
			'room_taiyang',
			'photo_taiyang_fanghuayuan',
			'taiyang',
			),
		'script'	=> array(
			'set taiyang as kid at 0.65 0.16 size 0.4 ',
			'look taiyang at 0 for 3 to 180 ',
			'sub taiyang at 0 for 3 with 1 body line003 3 ',
			'say taiyang at 0.5 for 1.730 speak wei cao a wo ri ',
			),
		'name'		=> 'Scene ');

$v['scene_00002'] = array(
		'duration'	=> 5,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(-0.15, 0, 0.5, 0.5, 1.2, 10),
			array(-0.15, 0, 0.5, 0.5, 1.2, 0),
			),
		'object'	=> array(
			'room_taiyang',
			'photo_taiyang_fanghuayuan',
			'taiyang',
			),
		'script'	=> array(
			'set taiyang as kid at 0.65 0.16 size 0.4 ',
			'look taiyang at 3 for 2 to 180 ',
			'sub taiyang at 0 for 5 with 1 body line003 5 ',
			),
		'name'		=> 'Scene ');

$v['scene_00001'] = array(
		'duration'	=> 7,
		'bg_color'	=> $v['color_blue'],
		'camera'	=> array(
			array(0, 0, 0.5, 0.5, 1, 2),
			array(-0.1, 0, 0.5, 0.5, 1, 5),
			array(-0.1, 0, 0.5, 0.5, 1, 0),
			),
		'object'	=> array(
			'room_taiyang',
			'photo_taiyang_fanghuayuan',
			'taiyang',
			),
		'script'	=> array(
			'set taiyang as kid at 0.2 0.1 size 0.4 ',
			'goto taiyang at 0 for 2 walk 0.45 0 stay 1 walk 0 0 for 0.3 jump 0 -0.06 stay 3.7 walk 0 0 ', 
			'look taiyang at 0 for 2 to 360 ',
			'look taiyang at 2 for 1 to 1 ',
			'look taiyang at 3 for 3 to 180 ',
			'sub taiyang at 3.1 for 3.9 with 2 body line002 1 line003 2.9 ',
			),
		'name'		=> 'Scene ');

?>
