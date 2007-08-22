<?php

/*
 * obj: 'char_liuyue'
 *
 */

function render_eye_round($obj)
{
	global $v;

	$x = calculate_pos($obj, 'eye_round', 'pos_x');
	$y = calculate_pos($obj, 'eye_round', 'pos_y');
	$r = calculate_size($obj, 'eye_round', 'size');

	imagefilledellipse($v['image_scene'], $x, $y, $r, $r, $v['eye_round']['color']);
	echo "eye round: $x, $y, $r\n";

	$x = calculate_pos($obj, 'eye_round', 'pos_x', -1);

	imagefilledellipse($v['image_scene'], $x, $y, $r, $r, $v['eye_round']['color']);
	echo "eye round: $x, $y, $r\n";
}

?>
