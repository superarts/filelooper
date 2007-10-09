<?php

$v['room_cao'] = array(
	'type'		=> 'misc',
	'pos_x'		=> 0.5,
	'pos_y'		=> -0.2,
	'scale'		=> 1.2,
	'item_x'	=> 0,
	'item_y'	=> 0,
	'item'		=> 'room/cao_dinner_room',
	'event'		=> array(),
	'name'		=> 'Living Room of Cao');

$v['cao'] = array(
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
    'body'      => 'line005',
    'face'      => 'grass001',
    'eye'       => 'open001',
	'mouth'     => 'smile001',
	'habit'		=> array(
		'speak'		=> array(
			'move'		=> array(
				'x_min'		=> 0.003,
				'x_max'		=> 0.005,
				'y_min'		=> 0.003,
				'y_max'		=> 0.005,
				'rate'		=> 0.7,
				'last_min'	=> 0.5,
				'last_max'	=> 1,
				'name'		=> 'Habit Move'),
			'name'		=> 'Habit Speak'),
		'goto'		=> array(
			'move'		=> array(
				'y_min'		=> 0.1,
				'y_max'		=> 0.15,
				'step'		=> 0.2,
				'name'		=> 'Habit Move'),
			'name'		=> 'Habit Goto'),
		'name'		=> 'Personal Habit'),
	'event'     => array(
		),
	'name'      => 'Cao');

?>
