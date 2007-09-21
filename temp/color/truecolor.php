<?php

$image = imagecreatetruecolor(1, 1);

$v['color_trans'] = imagecolorallocatealpha($image, 255, 255, 255, 127);
$v['color_white'] = imagecolorallocate($image, 255, 255, 255);
$v['color_black'] = imagecolorallocate($image, 0, 0, 0);
$v['color_red'] = imagecolorallocate($image, 255, 0, 0);
$v['color_green'] = imagecolorallocate($image, 0, 255, 0);
$v['color_blue'] = imagecolorallocate($image, 0, 0, 255);

$v['color_school_wall'] = imagecolorallocate($image, 168, 146, 120);
//	$v['color_'] = imagecolorallocate($image, , , );

imagedestroy($image);

?>
