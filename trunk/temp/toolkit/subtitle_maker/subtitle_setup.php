<?php

$image = imagecreatetruecolor(1, 1);

$v['x'] = 640;
$v['y'] = 480;
$v['fps'] = 25;
$v['pad'] = 0.1;	//	blank space around the border
$v['color'] = 223;
$v['bg'] = 32;
$v['color_range'] = 32;
$v['angle_range'] = 15;
$v['center'] = 0.4;
$v['sx'] = 4;			//	shadow x
$v['sy'] = 4;			//	shadow y

$v['ttf'] = array(
	"/home/leo/pic/font/msyh.ttf",
	"/home/leo/pic/font/msyhbd.ttf",
);

//	require("../../color/truecolor.php");

mt_srand(0);
mt_srand(time());

function is_pos_valid($pix)
{
	global $v;
	$ret = true;

	$x_min = $v['x'] * $v['pad'];
	$x_max = $v['x'] - $v['x'] * $v['pad'];
	$y_min = $v['y'] * $v['pad'];
	$y_max = $v['y'] - $v['y'] * $v['pad'];

	$cx_min = $v['x'] * (1 - $v['center']) / 2;
	$cx_max = $v['x'] * (1 + $v['center']) / 2;
	$cy_min = $v['y'] * (1 - $v['center']) / 2;
	$cy_max = $v['y'] * (1 + $v['center']) / 2;

	for ($i = 0; $i < 4; $i++)
	{
		if ($pix[$i * 2] < $x_min)
			$ret = false;
		if ($pix[$i * 2] > $x_max)
			$ret = false;

		if ($pix[$i * 2 + 1] < $y_min)
			$ret = false;
		if ($pix[$i * 2 + 1] > $y_max)
			$ret = false;

		if (($cx_min < $pix[$i * 2]) and ($pix[$i * 2] < $cx_max) and 
			($cy_min < $pix[$i * 2 + 1]) and ($pix[$i * 2 + 1] < $cy_max))
			$ret = false;
	}

	return $ret;
}

function get_random_angle()
{
	global $v;

	$range = $v['angle_range'];
	return mt_rand(0 - $range, $range);
}

function get_random_size($s)
{
	global $v;

	$base = $v['x'] / strlen($s);

	return mt_rand($base / 2, $base * 2);
}

function get_random_color($base_name)
{
	global $v, $image;

	$base = $v[$base_name];
	$range = $v['color_range'];

	$r = mt_rand($base - $range, $base + $range);
	$g = mt_rand($base - $range, $base + $range);
	$b = mt_rand($base - $range, $base + $range);

	return imagecolorallocate($image, $r, $g, $b);
}

function get_random_item_from_array($array)
{
	$i = mt_rand(0, count($array) - 1);

	return $array[$i];
}

function get_random_item($s)
{
	global $v;

	return get_random_item_from_array($v[$s]);
}

function get_info($s)
{
	global $v;

	$image = imagecreatetruecolor($v['x'], $v['y']);

	$font = get_random_item('ttf');
	$color = get_random_color('color');
	$angle = get_random_angle();
	do	{
		$size = get_random_size($s);
		$x = mt_rand(0, $v['x']);
		$y = mt_rand(0, $v['y']);
		$rect = imagettftext($image, $size, $angle, $x, $y, $color, $font, $s);
	}	while (is_pos_valid($rect) == false);

	imagedestroy($image);

	return array(
		'x' => $x,
		'y' => $y,
		'size' => $size,
		'angle' => $angle,
		'color' => $color,
		'font' => $font,
	);
}

function render_subtitle($s, $dest_filename)
{
	global $v;

	$image = imagecreatetruecolor($v['x'], $v['y']);

	imagefill($image, 0, 0, get_random_color('bg'));
	$r = get_info($s);
	imagettftext($image, $r['size'], $r['angle'], 
		$r['x'] + $v['sx'], $r['y'] + $v['sy'], 0, $r['font'], $s);
	imagettftext($image, $r['size'], $r['angle'], $r['x'], $r['y'], $r['color'], $r['font'], $s);

	imagepng($image, $dest_filename);
	imagedestroy($image);
}

render_subtitle('Hello GD!', 'test.png');
imagedestroy($image);

?>
