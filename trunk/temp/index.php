<?php

/*
 * index of libphpct
 *
 */

function parse_command()
{
	global $argv;
	global $v;

	//	print_r($argv);
	$flip = array_flip($argv);

	//	render all
	if (in_array('ra', $argv))
		$v['render']['filter'] = 'all';

	//	render event
	if (in_array('re', $argv))
		$v['render']['filter'] = 'event';

	//	render frame: r frame_index
	if (in_array('r', $argv))
		$v['render']['filter'] = $argv[$flip['r'] + 1];

	//	scene frame: s scene_index;
	if (in_array('s', $argv))
		$v['scene']['scene'] = $argv[$flip['s'] + 1];

	//	renderer smooth
	if (in_array('rs', $argv))
		$v['render']['renderer'] = 'release';

	//	renderer fast
	if (in_array('rf', $argv))
		$v['render']['renderer'] = 'debug';

	//	overwrite
	if (in_array('ov', $argv))
		$v['render']['overwrite'] = true;
	else
		$v['render']['overwrite'] = false;

	return;	
}

if (true)
{
$v = array();
srand(1);

require_once('color/truecolor.php');
//	require_once('script/ep001.php');
//	require_once('script/thecall.php');
//	require_once('script/oneman_001.php');
//	require_once('script/oneman_001_02.php');
require_once('script/oneman_001_03.php');
require_once('element/eye_round/render.php');
require_once('scene/profile.php');
require_once('scene/script.php');
require_once('scene/generate.php');
require_once('scene/render.php');
require_once('calculate/ultility.php');
require_once('calculate/len.php');
require_once('calculate/pos.php');
require_once('calculate/calculate.php');

function profile_reload()
{
	global $v;

	require('object/char_liuyue/profile.php');
	require('object/bg_school/profile.php');
	require('object/taiyang/profile.php');
	require('object/cao/profile.php');
	require('object/oneman/profile.php');
	require('element/eye_round/profile.php');
}

parse_command();
//	$data = $v['scene']['scene'];	echo "scene: $data\n"; 

function get_scene_max()
{
	global $v;

	$result = 0;

	do {
		$result++;
		$index = str_pad($result, 5, '0', STR_PAD_LEFT);
	}	while (isset($v["scene_$index"]) == true);

	return $result - 1;
}

//	print_r($argv);
if (in_array('sa', $argv))
{
	$c = get_scene_max();
	//	echo "scene max: $c\n";
	for ($i = 1; $i <= $c; $i++)
	{
		echo "scene: $i/$c\n";
		$v['scene']['scene'] = $i;

		//	create output directory
		$episode = str_pad($v['scene']['episode'], 3, '0', STR_PAD_LEFT);
		$scene = str_pad($v['scene']['scene'], 5, '0', STR_PAD_LEFT);
		$pathname = $v['scene']['name'] . '_' . $episode . '_' . $scene;
		//	true: windows; false: linux
		if (false)	//	TODO: the code below isn't working...
		{
			echo "mkdir $pathname\n";
			system("cd output");
			system("dir");
			system("mkdir $pathname");
			system("cd ..");
		}
		else
		{
			$pathname = "./output/$pathname";
			if (file_exists($pathname) == false)
			{
				//	echo "mkdir $pathname";
				exec("mkdir $pathname");
			}
		}

		profile_reload();
		scene_reload();		//	reload 'current scene' parameters
		generate_script();
		render_scene();
	}
}
else
{
	$episode = str_pad($v['scene']['episode'], 3, '0', STR_PAD_LEFT);
	$scene = str_pad($v['scene']['scene'], 5, '0', STR_PAD_LEFT);
	$pathname = $v['scene']['name'] . '_' . $episode . '_' . $scene;
		
	$pathname = "./output/$pathname";
	if (file_exists($pathname) == false)
		exec("mkdir $pathname");

	profile_reload();
	scene_reload();		//	reload 'current scene' parameters
	generate_script();
	render_scene();
}

//	print_r($v);

//	$s = calc_get_token('this is a motherfucking test ', 9);	echo "$s\n";
//	$s = get_substr('i said you cannot win ! ', 'said ');	echo "$s\n";
//	print_r(str_word_count('this is a , test! ', 1, ',.;?!'));
//	$s = language_filter('wo cai bu xiang xin ne ');	echo "$s\n";
}

?> 
