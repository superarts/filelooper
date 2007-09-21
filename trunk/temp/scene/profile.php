<?php

//	scene info
$v['scene']['name'] = 'show';		//	name and episode are for file naming
$v['scene']['episode'] = 1;			//	which episode of the series
$v['scene']['scene'] = 2;
$v['scene']['res_x'] = 1280;
$v['scene']['res_y'] = 720;
$v['scene']['fps'] = 10;
$v['scene']['subtitle'] = false;	//	render subtitle
$v['scene']['duration'] = 3;		//	count in seconds

$scene_index = str_pad($v['scene']['scene'], 5, '0', STR_PAD_LEFT);
//	echo "scene index: $scene_index\n";

$v['object'] = $v["object_$scene_index"];
$v['script'] = $v["script_$scene_index"];

$v['render'] = array(
	'filter' 	=> 'event',			//	all: all frames; event: event only; NUMBER: specified frame;
	'renderer'	=> 'debug',			//	debug: fast but rough; release: slow but smooth;
	'name'		=> 'Render Option');

$v['set'] = array(
	'head'	 		=> array('face', 'eye', 'mouth'),
	'kid_all'		=> array('face', 'eye', 'mouth', 'body'),
	'sky_all'		=> array('sky'),
	'ground_all'	=> array('ground'),
	'building_all'	=> array('building'),
	'misc_all'		=> array('item'),
	'name'			=> 'Set');

/*
 * render part list
 *
 */
$v['kid'] = array(
    'body',
    'face',
    'eye',
    'mouth');

$v['sky'] = array(
	'sky');

$v['ground'] = array(
	'ground');

$v['building'] = array(
	'building');

$v['misc'] = array(
	'item');
/*
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
 */

?>
