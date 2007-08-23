<?php

function calc_pos($element, $obj)
{
    return $element + $obj;
}

/*
 * head
 */

function calc_pos_head_x($element, $obj)
{
    global $v;
    return calc_pos($element, $v[$obj]['head_x']);
}

function calc_pos_head_y($element, $obj)
{
    global $v;
    return calc_pos($element, $v[$obj]['head_y']);
}

/*
 * leg
 */

function calc_pos_leg_y($element, $obj)
{
    global $v;
    return calc_pos($element, $v[$obj]['leg_height']);
}

/*
 * body
 */

function calc_pos_body_y($element, $obj)
{
    global $v;
    return calc_pos($element, $v[$obj]['body_height']);
}

/*
 * layer
 */

function calc_pos_layer_x($element, $obj)
{
    global $v;
    return calc_pos($element, $v['scene'][$obj]['pos_x']);
}

function calc_pos_layer_y($element, $obj)
{
    global $v;
    return calc_pos($element, $v['scene'][$obj]['pos_y']);
}

/*
 * land
 */

function calc_pos_land($element, $obj)
{
    global $v;
    return calc_pos($element, calc_get_layer_ratio($obj));
}

/*
 * flip
 */

function calc_pos_flip_y($element)
{
    global $v;
    return $v['scene']['res_y'] - $element;
}

?>
