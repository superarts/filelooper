<?php

/*
 * type
 * 		object.character
 */

$v['liuyue'] = array(
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
    'body'      => 'blue001',
    'face'      => 'liuyue001',
    'eye'       => 'open001',
	'mouth'     => 'normal001',
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
				'step'		=> 0.2,
				'name'		=> 'Habit Move'),
			'name'		=> 'Habit Goto'),
		'name'		=> 'Personal Habit'),
	'event'     => array(
		/*
		 * zoom example
		 *
		array(
			'start'		=> 0,
			'action'	=> 'zoom',
			'duration'	=> 4,
			'scale'		=> 0,
			'scale_to'	=> 0.7,
			'name'		=> 'Event Zoom Example'),
		 */
		/*
		 * substitute example
		 *
		array(
			'start'		=> 1,
			'action'	=> 'sub',
			'duration'	=> 0.4,
			'part'		=> 'mouth',
			'source'	=> 'smile002'),
		 */
		/*
		 * move examples
		 *
        array(
            'start'     => 1,
            'action'    => 'move', 
            'duration'  => 1, 
            'part'      => 'head', 
            'x'         => -0.005, 
			'y'         => -0.005,
			'dest_x'	=> -0.005,
			'dest_y'	=> -0.005),
        array(
            'start'     => 2.5,
            'action'    => 'move', 
            'duration'  => 1, 
            'part'      => 'head', 
            'x'         => 0.005, 
			'y'         => -0.005)
		 */
		),
    'name'      => 'Liu Yue');

$v['liuyue_clone'] = $v['liuyue'];

?>
