<?php

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

/*
 * index of libphpct
 *
 */

if (false)
{
$v = array();

require_once('color/truecolor.php');
require_once('scene/profile.php');

$v['image_scene'] = imagecreatetruecolor(0, 0);
$v['image_bg'] = imagecreatetruecolor(0, 0);
}

?> 
