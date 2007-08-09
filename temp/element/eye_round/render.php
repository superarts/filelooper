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

	imagefilledellipse($v['image_scene'], );
}

?>
