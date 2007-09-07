<?php

//	scene info
$v['scene']['name'] = 'show';		//	name and episode are for file naming
$v['scene']['episode'] = 1;			//	which episode of the series
$v['scene']['scene'] = 1;
$v['scene']['res_x'] = 1280;
$v['scene']['res_y'] = 720;
$v['scene']['fps'] = 10;
$v['scene']['subtitle'] = false;	//	render subtitle
$v['scene']['duration'] = 5;		//	count in seconds

$v['set'] = array(
    'head' 	=> array('face', 'eye', 'mouth'));

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
    'mouth'     => 'smile001',
    'event'     => array(
        array(
            'start'     => 1,
            'action'    => 'move', 
            'duration'  => 1, 
            'part'      => 'head', 
            'x'         => -0.005, 
			'y'         => -0.005),
        array(
            'start'     => 2.5,
            'action'    => 'move', 
            'duration'  => 1, 
            'part'      => 'head', 
            'x'         => 0.005, 
			'y'         => -0.005)),
    'name'      => 'Liu Yue');

$v['liuyue_clone'] = array(
    'type'      => 'kid',
    'pos_x'     => 0.1,
    'pos_y'     => 0.15,
    'scale'     => 0.4,
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
	'mouth'     => 'smile001',
	'event'		=> array(),
    'name'      => 'Liu Yue');

$v['object'] = array(
    'liuyue',
    'liuyue_clone');

$v['kid'] = array(
    'body',
    'face',
    'eye',
    'mouth');

//	layer info
$v['scene']['layer_front'] = array(
	'ratio'		=> 30,				//	??? percentage = 1m
	'land'		=> 20,				//	scene baseline to layer landline
	'name'		=> 'Layer Front');

//	object info
$v['scene']['char_liuyue'] = array(
	'pos_x'		=> 50,				//	count in percentage
	'pos_y'		=> 0,				//	layer landline to object foot
	'layer'		=> 'layer_front',
	'action'	=> array(
		'speak'		=> array(
			'duration'	=> 250,
			'words'		=> 'This is only a demo, you retard.',
			'name'		=> 'Speaking'),
		'name'		=> 'Action List'),
	'name'		=> 'Liu Yue');

?>
