<?php

function calc_scale($x, $y, $z = 100)
{
    return $x * $y / $z;
}

function calc_scale_head_x($element, $obj)
{
    global $v;

    return calc_scale($element, $v[$obj]['head_width']);
}

function calc_scale_layer($element, $obj)
{
    return calc_scale($element, calc_get_layer_ratio($obj));
}

function calc_scale_scene_x($element)
{
    global $v;

    return calc_scale($element, $v['scene']['res_x']);
}

?>
