<?php

/*
 * An Empty Scene
 *
$v['scene_00002'] = array(
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
 * scene 2
 */

$v['scene_00002'] = array(
	'duration'	=> 2,
	'bg_color'	=> $v['color_school_wall'],
	'camera'	=> array(),

	'object'	=> array(
		'bell_school'),

	'script'	=> array(
		'sub bell_school at 0 for 2 with 2 item bell001 0.1 bell002 0.1 ',
	),
	'name'		=> 'Scene 2');

/*
 * scene 1
 */

$v['scene_00001'] = array(
	'duration'	=> 6,
	'bg_color'	=> $v['color_blue'],
	'camera'	=> array(
		array(0, 0, 0.5, 0.5, 1, 6),
		array(0, 0, 0.4, 0.45, 1.1, 0)),

	'object'	=> array(
		'sky_sunny',
		'ground_normal',
		'school_building',
		'school_flag',
		'school_wall'
		//	'liuyue',
		//	'liuyue_clone'
	),

	'script'	=> array(
				   'set sky_sunny as sky at 0.5 -0.2 size 1.3 ',
			'set ground_normal as ground at 0.5 -0.2 size 1.3 ',
		'set school_building as building at 0.5 -0.15 size 0.8 ',
			'set school_flag as building at 0.5 -0.18 size 0.8 ',
			'set school_wall as building at 0.5 -0.2 size 1 ',
		'zoom school_building at 0 for 6 from 0.8 to 0.85 ',
		'zoom school_flag at 0 for 6 from 0.8 to 0.9 ',
		'zoom school_wall at 0 for 6 from 1 to 1.1 '),
	'name'		=> 'Episode 1');

//	scene example

$v['scene_00000'] = array(
	'duration'	=> 5,
	'bg_color'	=> $v['color_blue'],
	'camera'	=> array(
		array(0, 0, 0.5, 0.5, 0.7, 2),
		array(0, 0, 0.5, 0.5, 1, 3),
		array(0, 0, 0.5, 0.5, 1, 0),
	),

	/*
	 * object list
	 *
	 * array order = render order
	 *
	 */
	'object'	=> array(
		'liuyue',
		'liuyue_clone'
	),

	//	http://38.100.22.210/bbss/forumdisplay.php?fid=17&page=1 jjjj8888:2230177
	//	http://www.christophkhouri.com/leo/source.zip
	//	http://ckhouri.serve.castfire.net/video/1484/1484_2007-08-08-143055.mp4
	//
	//
	//	set OBJECT is TYPE at POS_X POS_Y size SCALE
	//	say OBJECT at START for DURATION speak/smile/cry/... SENTENSE
	//	goto OBJECT at START for/stay DURATION walk/jump POS_X POS_Y [for ... walk/jump ... walk/jump ... to ...]
	//	zoom OBJECT at START for DURATION from SCALE to SCALE_TO
	//	sub OBJECT at START for DURATION with COUNT PART [SOURCEx DELAYx]
	//		look OBJECT at START for DURATION to DIRECTION(0-360) 

	'script'	=> array(
		'set liuyue as kid at 0.5 0.1 size 0.5 ',
		'set liuyue_clone as kid at 0.2 0.2 size 0.1 ',
		'say liuyue at 1 for 1.5 speak cao ni ma! ',
		'say liuyue_clone at 1 for 1.5 speak ni ma bi. ',
		'zoom liuyue at 0 for 5 from 0.5 to 0.55 ',
		'look liuyue at 1 for 1 to 360 ',
		//	'goto liuyue at 1 for 3 walk 0.1 -0.1 ',
		'goto liuyue_clone at 1 for 2 walk 0.1 -0.1 for 2 walk 0.1 0.1 '
	),
);

?>
