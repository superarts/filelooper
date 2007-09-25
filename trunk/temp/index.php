<?php

if (false)
{
	$image = imagecreatetruecolor(1280, 720);
	$block = imagecreatetruecolor(700, 700);
	$color_white = imagecolorallocate($image, 255, 255, 255);
	$color_black = imagecolorallocate($image, 0, 0, 0);
	$color_trans = imagecolorallocatealpha($image, 255, 0, 0, 127);
	imagefill($image, 0, 0, $color_white);
	imagefilledrectangle($image, 100, 100, 500, 300, $color_trans);

	imagefill($block, 0, 0, $color_trans);
	imagerectangle($block, 0, 0, 699, 699, $color_black);
	imagefilledrectangle($block, 50, 50, 600, 600, $color_black);
	$block = imagerotate($block, 45, $color_trans);

	imagecopy($image, $block, 300, 10, 0, 0, 700, 700);

	imagepng($image, 'test.png');
	imagedestroy($image);
	imagedestroy($block);

	print_r($color_white);
	echo "\n";
	print_r($color_black);
	echo "\n";
	print_r($color_trans);
	echo "\n";

	print_r($argv);
}

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

	//	renderer smooth
	if (in_array('rs', $argv))
		$v['render']['renderer'] = 'release';

	//	renderer fast
	if (in_array('rf', $argv))
		$v['render']['renderer'] = 'debug';

	return;	
}

if (true)
{
$v = array();
srand(1);

require_once('color/truecolor.php');
require_once('script/ep001.php');
require_once('object/char_liuyue/profile.php');
require_once('object/bg_school/profile.php');
require_once('element/eye_round/profile.php');
require_once('element/eye_round/render.php');
require_once('scene/profile.php');
require_once('scene/script.php');
require_once('scene/generate.php');
require_once('scene/render.php');
require_once('calculate/ultility.php');
require_once('calculate/len.php');
require_once('calculate/pos.php');
require_once('calculate/calculate.php');

parse_command();
generate_script();
render_scene();

//	print_r($v);

//	$s = calc_get_token('this is a motherfucking test ', 9);	echo "$s\n";
//	$s = get_substr('i said you cannot win ! ', 'said ');	echo "$s\n";
//	print_r(str_word_count('this is a , test! ', 1, ',.;?!'));
//	$s = language_filter('wo cai bu xiang xin ne ');	echo "$s\n";
}

?> 
