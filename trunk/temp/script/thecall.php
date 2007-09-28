<?php

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
