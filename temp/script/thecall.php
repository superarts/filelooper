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

$v['scene_00001'] = array(
	'duration'	=> 10,
	'bg_color'	=> $v['color_blue'],
	'camera'	=> array(
		array(0, 0, 0.5, 0.5, 1, 2),
		array(-0.1, 0, 0.5, 0.5, 1, 8),
		array(-0.1, 0, 0.5, 0.5, 1, 0),
		),
	'object'	=> array(
		'room_taiyang',
		'photo_taiyang_fanghuayuan',
		),
	'script'	=> array(
		),
	'name'		=> 'Scene ');

?>
