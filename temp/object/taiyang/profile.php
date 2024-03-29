<?php

$v['room_taiyang'] = array(
	'type'		=> 'misc',
	'pos_x'		=> 0.5,
	'pos_y'		=> -0.2,
	'scale'		=> 1.2,
	'item_x'	=> 0,
	'item_y'	=> 0,
	'item'		=> 'room/taiyang_living_room',
	'event'		=> array(),
	'name'		=> 'Living Room of Taiyang');

$v['photo_taiyang_fanghuayuan'] = array(
	'type'		=> 'misc',
	'pos_x'		=> 0.9,
	'pos_y'		=> 0.8,
	'scale'		=> 0.1,
	'item_x'	=> 0,
	'item_y'	=> 0,
	'item'		=> 'photo/taiyang_fanghuayuan',
	'event'		=> array(),
	'name'		=> 'Living Room of Taiyang');

$v['taiyang'] = array(
    'type'      => 'kid',
    'pos_x'     => 0.5,
    'pos_y'     => 0.1,
	'scale'     => 0.5,
	'body_x'	=> 0,
	'body_y'	=> 0,
	'face_x'	=> 0,
	'face_y'	=> 0,
	'eye_x'		=> 0,
	'eye_y'		=> 0,
	'mouth_x'	=> 0,
	'mouth_y'	=> 0,
    'body'      => 'line001',
    'face'      => 'sun001',
    'eye'       => 'open001',
	'mouth'     => 'smile001',
	'habit'		=> array(
		'speak'		=> array(
			'move'		=> array(
				'x_min'		=> 0.002,
				'x_max'		=> 0.004,
				'y_min'		=> 0.002,
				'y_max'		=> 0.004,
				'rate'		=> 0.8,
				'last_min'	=> 0.5,
				'last_max'	=> 1,
				'name'		=> 'Habit Move'),
			'name'		=> 'Habit Speak'),
		'goto'		=> array(
			'move'		=> array(
				'y_min'		=> 0.08,
				'y_max'		=> 0.12,
				'step'		=> 0.1,
				'name'		=> 'Habit Move'),
			'name'		=> 'Habit Goto'),
		'name'		=> 'Personal Habit'),
	'event'     => array(
		),
    'name'      => 'Tai Yang');

$v['taiyangmum'] = array(
    'type'      => 'adult',
    'pos_x'     => 0.5,
    'pos_y'     => 0.1,
	'scale'     => 0.5,
	'body_x'	=> 0,
	'body_y'	=> 0,
	'face_x'	=> 0,
	'face_y'	=> 0,
	'eye_x'		=> 0,
	'eye_y'		=> 0,
	'mouth_x'	=> 0,
	'mouth_y'	=> 0,
    'body'      => 'sunmum001',
    'face'      => 'sunmum001',
    'eye'       => 'adultopen001',
	'mouth'     => 'adultspeak001',
	'habit'		=> array(
		'speak'		=> array(
			'move'		=> array(
				'x_min'		=> 0.002,
				'x_max'		=> 0.004,
				'y_min'		=> 0.002,
				'y_max'		=> 0.004,
				'rate'		=> 0.8,
				'last_min'	=> 0.5,
				'last_max'	=> 1,
				'name'		=> 'Habit Move'),
			'name'		=> 'Habit Speak'),
		'goto'		=> array(
			'move'		=> array(
				'y_min'		=> 0.1,
				'y_max'		=> 0.15,
				'step'		=> 0.1,
				'name'		=> 'Habit Move'),
			'name'		=> 'Habit Goto'),
		'name'		=> 'Personal Habit'),
	'event'     => array(
		),
    'name'      => 'Tai Yang Ma Ma');

?>
