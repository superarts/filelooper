<?php

//	scene info
$v['scene']['name'] = 'notes';		//	name and episode are for file naming
$v['scene']['episode'] = 1;			//	which episode of the series
$v['scene']['res_x'] = 1280;
$v['scene']['res_y'] = 720;
$v['scene']['fps'] = 25;
$v['scene']['subtitle'] = false;	//	render subtitle
$v['scene']['duration'] = 250;		//	count in frames

$v['liuyue'] = array(
    'type'      => 'kid',
    'pos_x'     => 0.5,
    'pos_y'     => 0.1,
    'scale'     => 0.5,
    'body'      => 'blue001',
    'face'      => 'liuyue001',
    'eye'       => 'open001',
    'mouth'     => 'smile001',
    'name'      => 'Liu Yue');

$v['liuyue_clone'] = array(
    'type'      => 'kid',
    'pos_x'     => 0.1,
    'pos_y'     => 0.1,
    'scale'     => 0.5,
    'body'      => 'blue001',
    'face'      => 'liuyue001',
    'eye'       => 'open001',
    'mouth'     => 'smile001',
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
