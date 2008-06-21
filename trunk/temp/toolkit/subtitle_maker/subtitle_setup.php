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
$v['bg_path'] = array(
	"/home/leo/pic/gallery/scribble/",
	"/home/leo/pic/album/iphone/20080618_artworks/",
);
$v['bg_level'] = 20;	//	0: no png; 100: no bg color
$v['url_ttf'] = "/home/leo/pic/font/msyhbd.ttf";
$v['url_str'] = 'http://superarts.org';

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
	$pad = $v['pad'] / 2;

	$x_min = $v['x'] * $pad;
	$x_max = $v['x'] - $v['x'] * $pad;
	$y_min = $v['y'] * $pad;
	$y_max = $v['y'] - $v['y'] * $pad;

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

	$len = strpos($s, "\n");
	if ($len == false)
		$len = strlen($s);
	$base = $v['x'] / $len;
	$head = $base * 0.2;
	$tail = $base * 2.5;

	$x = $v['x'];
	$y = $v['y'];
	$p = $v['pad'];

	$image = imagecreatetruecolor($v['x'], $v['y']);

	$font = get_random_item('ttf');
	$color = 0;		//	get_random_color('color');
	$angle = 0;		//	get_random_angle();
	while (true)
	{
		$size = mt_rand($head, $tail);
		//	FIXME one char fix
		if ($size > 288)
			$size = 288;
		$xx = 0;		//	mt_rand(0, $v['x']);
		$yy = $y;	//	mt_rand(0, $v['y']);
		$rect = imagettftext($image, $size, $angle, $xx, $yy, $color, $font, $s);

		$w = $rect[4];
		$h = $y - $rect[5];
		//	echo "get random size: $size, $w * $h\n";

		$x_min = $x * (1 - $p * 4);
		$x_max = $x * (1 - $p * 2);
		$y_min = $y * (1 - $p * 4);
		$y_max = $y * (1 - $p * 2);
		//	echo "$x_min, $x_max, $y_min, $y_max\n";
		if (($x_min < $w) and ($w < $x_max) and ($h < $y_max))
			break;
		if (($y_min < $h) and ($y < $y_max) and ($w < $x_max))
			break;
	}

	imagedestroy($image);

	return $size;
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

function get_random_bg()
{
	global $v;

	$s = get_random_item('bg_path');

	exec("ls $s", $ls);

	$i = count($ls);
	$i = mt_rand(0, $i - 1);

	return $s . $ls[$i];
}

function get_info($s)
{
	global $v;

	$image = imagecreatetruecolor($v['x'], $v['y']);

	$font = get_random_item('ttf');
	$color = get_random_color('color');
	$angle = get_random_angle();
	$size = get_random_size($s);
	do	{
		$x = mt_rand(0, $v['x']);
		$y = mt_rand(0, $v['y']);
		$rect = imagettftext($image, $size, $angle, $x, $y, $color, $font, $s);
		//	echo "get info: $x, $y, $size\n";
		//	print_r($rect);
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

function imagecreatefromfile($filename)
{
	switch (strtolower(substr($filename, -4)))
	{
	case '.jpg':
	case 'jpeg':
		return imagecreatefromjpeg($filename);
	case '.png':
		return imagecreatefrompng($filename);
	}

	return false;
}

function render_subtitle($s, $dest_filename)
{
	global $v;

	$image = imagecreatetruecolor($v['x'], $v['y']);
	$image_bg = imagecreatefromfile(get_random_bg());
	$image_bg_resized = imagecreatetruecolor($v['x'], $v['y']);

	imagefill($image, 0, 0, get_random_color('bg'));
	$x = imagesx($image_bg);
	$y = imagesy($image_bg);
	if (($x / $y) > ($v['x'] / $v['y']))		//	x is larger
	{
		$y = $v['x'] * $y / $x;
		$x = $v['x'];
	}
	else										//	y is larger
	{
		$x = $v['y'] * $x / $y;
		$y = $v['y'];
	}
	imagecopyresampled($image_bg_resized, $image_bg, 
		($v['x'] - $x) / 2, ($v['y'] - $y) / 2, 0, 0, $x, $y, imagesx($image_bg), imagesy($image_bg));
	imagecopymerge($image, $image_bg_resized, 0, 0, 0, 0, $v['x'], $v['y'], $v['bg_level']);

	$r = get_info($s);
	imagettftext($image, $r['size'], $r['angle'], 
		$r['x'] + $v['sx'], $r['y'] + $v['sy'], 0, $r['font'], $s);
	imagettftext($image, $r['size'], $r['angle'], $r['x'], $r['y'], $r['color'], $r['font'], $s);

	imagettftext($image, 16, 0, $v['x'] * 0.013, $v['y'] * 0.055, 0, $v['url_ttf'], $v['url_str']);
	imagettftext($image, 16, 0, $v['x'] * 0.01, $v['y'] * 0.05, $r['color'], $v['url_ttf'], $v['url_str']);

	imagepng($image, $dest_filename);
	imagedestroy($image);
}

$s = <<< EOT
____________________
TJ Nunchakus 2nd Edition
EOT;

//	render_subtitle("中文测试：一句比较长的话，看上去是这样的\n我从来没有想过，胖子可以这么胖", 'test.png');
//	render_subtitle("english test what the fuck is going on today\nand what can you expect now", 'test.png');
//	render_subtitle("$s", 'test.png');

$png_name = 'tjn_';

//	require ("tj_nunchakus.php");
//	require ("manny_man.php");
//	require ("fan_gogo_live.php");
require ("tomb_tv.php");

$count = count($timestamp);

//	create images
if (false)
{
	for ($i = 0; $i < $count; $i++)
	{
		$s = $subtitle[$i];

		$filename = $png_name;
		$filename .= str_pad($timestamp[$i], 9, '0', STR_PAD_LEFT);
		$filename .= '.png';

		echo "rendering $i/$count with:\n$s\n";
		render_subtitle($s, $filename);
	}
}

//	create copies
if (true)
{
	for ($i = 0; $i < $count - 1; $i++)
	{
		$head = $timestamp[$i] + 1;
		$tail = $timestamp[$i + 1] - 1;
		echo "$head - $tail\n";

		$filename_source = $png_name;
		$filename_source .= str_pad($timestamp[$i], 9, '0', STR_PAD_LEFT);
		$filename_source .= '.png';

		for ($ii = $head; $ii <= $tail; $ii++)
		{
			$filename_dest = $png_name;
			$filename_dest .= str_pad($ii, 9, '0', STR_PAD_LEFT);
			$filename_dest .= '.png';

			echo "ln $filename_source $filename_dest\n";
			exec("ln $filename_source $filename_dest\n");
		}
	}
}

imagedestroy($image);

//	echo get_random_bg($v['bg_path']);

?>
