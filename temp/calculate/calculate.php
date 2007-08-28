<?php

function calculate_posx($obj, $element, $var, $fix_multi = 1, $fix_plus = 0)
{
	global $v;

	if ($fix_multi == 1)
	{
		$fix_m = 1;
	}
	else
	{
		$fix_m = $v[$element][$fix_multi];
	}
	if ($fix_plus == 0)
	{
		$fix_p = 0;
	}
	else
	{
		$fix_p = $v[$element][$fix_plus];
	}

    $r = $v[$element][$var] * $fix_m + $fix_p;
	$element_type = calc_get_token($element, 1, '_');

	switch ($element_type)
	{
	case 'eye':
        $r = calc_len_head_x($r, $obj);
        $r = calc_pos_head_x($r, $obj);         
        $r = calc_len_layer($r, $obj);         
        $r = calc_pos_layer_x($r, $obj);        
        $r = calc_len_scene_x($r);         

		break;
	default:
		exit("calculate pos - unknown element type: $element_type");
	}

	return $r;
}

function calculate_posy($obj, $element, $var, $fix_multi = 1, $fix_plus = 0)
{
	global $v;

	if ($fix_multi == 1)
	{
		$fix_m = 1;
	}
	else
	{
		$fix_m = $v[$element][$fix_multi];
	}
	if ($fix_plus == 0)
	{
		$fix_p = 0;
	}
	else
	{
		$fix_p = $v[$element][$fix_plus];
	}

    $r = $v[$element][$var] * $fix_m + $fix_p;
	$element_type = calc_get_token($element, 1, '_');

	switch ($element_type)
	{
	case 'eye':
        $r = calc_len_head_y($r, $obj); 
        $r = calc_pos_head_y($r, $obj);         
        $r = calc_pos_leg_y($r, $obj);        
        $r = calc_pos_body_y($r, $obj);         
        $r = calc_len_layer($r, $obj);
        $r = calc_pos_layer_y($r, $obj);       
        $r = calc_pos_land($r, $obj);        
        $r = calc_len_scene_y($r);         
        $r = calc_pos_flip_y($r);         

		break;
	default:
		exit("calculate pos - unknown element type: $element_type");
	}

	return $r;
}

function calculate_size($obj, $element, $var)
{
	global $v;
	$r = $v[$element][$var];
	//	$element_type = calc_get_token($element, 0, '_');

	switch ($element)	//	($element_type)
	{
	case 'eye_round':
	    $r = calc_len_head_x($r, $obj); 
        $r = calc_len_layer($r, $obj);         
        $r = calc_len_scene_x($r);         

		break;
	default:
		exit("calculate size - unknown lement: $element");
	}

	return $r;
}

?>
