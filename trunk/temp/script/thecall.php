<?php

$index_scene = 5;

/*
3	太阳：（拿起电话）喂，草啊，我日。
6	草：（拿起电话）我草，你谁啊？
4	太阳：我日啊。
7	草：我草，你到底是谁啊？
5	太阳：我日啊！你草吧？
8	草：我草啊！我草！你是谁啊！
太阳：我日！我日啊！
9	草：我草！
太阳的妈妈：（走过来，接过电话）我日他妈呀，草啊，草你妈呢？
草的妈妈：（接过电话）我草他妈啊！
太阳的妈妈：草他妈，我日他妈！
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

/*
 * 草：我草！
 */
$v['scene_00009'] = array(
	'duration'	=> 1,
	'bg_color'	=> $v['color_blue'],
	'camera'	=> array(
		array(-0.2, 0, 0.5, 0.5, 1.5, 3),
		array(-0.2, 0, 0.5, 0.5, 1.5, 0),
		),
	'object'	=> array(
		'room_cao',
		'cao',
		),
	'script'	=> array(
		'set cao as kid at 0.65 0.16 size 0.4 ',
		'say cao at 0.25 for 0.75 speak wo cao ',
		),
	'name'		=> 'Scene ');

/*
 * 草：我草啊！我草！你是谁啊！
 */
$v['scene_00008'] = array(
	'duration'	=> 2,
	'bg_color'	=> $v['color_blue'],
	'camera'	=> array(
		array(-0.2, 0, 0.5, 0.5, 1.5, 3),
		array(-0.2, 0, 0.5, 0.5, 1.5, 0),
		),
	'object'	=> array(
		'room_cao',
		'cao',
		),
	'script'	=> array(
		'set cao as kid at 0.65 0.16 size 0.4 ',
		'say cao at 0.25 for 1.7l speak wo cao a wo cao ni shi shui a ',
		),
	'name'		=> 'Scene ');

/*
 * 草：我草，你到底是谁啊？
 */
$v['scene_00007'] = array(
	'duration'	=> 2,
	'bg_color'	=> $v['color_blue'],
	'camera'	=> array(
		array(-0.2, 0, 0.5, 0.5, 1.5, 3),
		array(-0.2, 0, 0.5, 0.5, 1.5, 0),
		),
	'object'	=> array(
		'room_cao',
		'cao',
		),
	'script'	=> array(
		'set cao as kid at 0.65 0.16 size 0.4 ',
		'say cao at 0.25 for 1.7l speak wo cao ni dao di shi shui a ',
		),
	'name'		=> 'Scene ');

/*
 * 草：（拿起电话）我草，你谁啊？
 */
$v['scene_00006'] = array(
	'duration'	=> 2,
	'bg_color'	=> $v['color_blue'],
	'camera'	=> array(
		array(-0.2, 0, 0.5, 0.5, 1.5, 3),
		array(-0.2, 0, 0.5, 0.5, 1.5, 0),
		),
	'object'	=> array(
		'room_cao',
		'cao',
		),
	'script'	=> array(
		'set cao as kid at 0.65 0.16 size 0.4 ',
		'say cao at 0.25 for 1.7l speak wo cao ni shui a ',
		),
	'name'		=> 'Scene ');

$v['scene_00005'] = array(
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
		'say taiyang at 0.5 for 2 speak wo ri a ni cao ba ',
		),
	'name'		=> 'Scene ');

$v['scene_00004'] = array(
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
		'say taiyang at 0.5 for 1 speak wo ri a ',
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
		'say taiyang at 0.5 for 2 speak wei cao a wo ri ',
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
