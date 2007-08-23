<?php

function calc_len($x, $y, $z = 100)
{
    return $x * $y / $z;
}

function calc_len_obj($element, $obj, $name, $fix)
{
    global $v;
    return calc_len($element, $v[$obj][$name . '_' . $fix);
}

/*
 * head
 */

function calc_len_head($element, $obj)
{
    return calc_len_obj($element, $obj, 'head', $fix);
}

function calc_len_head_x($element, $obj)
{
    return calc_len_head($element, $obj, 'width']);
}

function calc_len_head_y($element, $obj)
{
    return calc_len_head($element, $obj, 'height']);
}

/*
 * layer
 */

function calc_len_layer($element, $obj)
{
    return calc_len($element, calc_get_layer_ratio($obj));
}

/*
 * scene
 */

function calc_len_scene($element, $fix)
{
    global $v;
    return calc_len($element, $v['scene']['res_' . $fix];
}

function calc_len_scene_x($element)
{
    global $v;
    return calc_len($element, $v['scene']['res_x']);
}

function calc_len_scene_y($element)
{
    global $v;
    return calc_len($element, $v['scene']['res_y']);
}

?>
