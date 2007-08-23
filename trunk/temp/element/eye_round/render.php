<?php

/*
 * obj: 'char_liuyue'
 *
 */

function render_eye_round($obj)
{
	global $v;

	$x = calculate_posx($obj, 'eye_round', 'pos_x');
	$y = calculate_posy($obj, 'eye_round', 'pos_y');
	$r = calculate_size($obj, 'eye_round', 'size');
	imagefilledellipse($v['image_scene'], $x, $y, $r, $r, $v['eye_round']['color']);

	$r = calculate_size($obj, 'eye_round', 'ball_size');
	imagefilledellipse($v['image_scene'], $x, $y, $r, $r, $v['eye_round']['ball_color']);

	$x = calculate_posx($obj, 'eye_round', 'pos_x', -1);
	$r = calculate_size($obj, 'eye_round', 'size');
	imagefilledellipse($v['image_scene'], $x, $y, $r, $r, $v['eye_round']['color']);

	$r = calculate_size($obj, 'eye_round', 'ball_size');
	imagefilledellipse($v['image_scene'], $x, $y, $r, $r, $v['eye_round']['ball_color']);

}

?>
