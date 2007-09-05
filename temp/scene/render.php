<?php

function render_scene()
{
    global $v;

    for ($i = 0; $i < count($v['object']); $i++)
    {
        $name = $v['object'][$i];

        switch ($v[$name]['type'])
        {
        case 'kid':
            render_kid($name);
            break;
        default:
            exit("render scene - unknown object type");
        }
    }
}

function render_kid($name)
{
    global $v;

    for ($i = 0; $i < count($v['kid']); $i++)
    {
        render_part($name, $v['kid'][$i]);
    }

    return;
}

function render_get_image($name, $part)
{
    global $v;

    //  echo "get image name: $name, $part\n";
    $filename = $v[$name][$part];
    $filename = "./image/$part/$filename.png";

    return $filename;
}

function render_part($name, $part)
{
    global $v;
    $scale = $v[$name]['scale'];
    $x = $v[$name]['pos_x'];
    $y = $v[$name]['pos_y'];

    $filename = render_get_image($name, $part);

    $size = getimagesize($filename);
    //  print_r($size);
    $part_x = $size[0];
    $part_y = $size[1];

    $obj_x = $part_x * $scale;
    $obj_y = $part_y * $scale;

    $x = $x * $v['scene']['res_x'];
    $x = $x - $obj_x / 2;
    $y = (1 - $y) * $v['scene']['res_y'];
    $y = $y - $obj_y;

    $image = imagecreatefrompng($filename);
    //  echo "copy resized: $x, $y, $obj_x, $obj_y, $part_x, $part_y\n";
    imagecopyresized($v['image_scene'], $image, $x, $y, 0, 0, $obj_x, $obj_y, $part_x, $part_y);
    imagedestroy($image);
}

//	TODO: render_object('char_liuyue');
function render_object($obj)
{
    global $v;

    render_head($obj);

    return;
}

function render_head($obj)
{
    global $v;

    switch ($v[$obj]['eye_type'])
    {
    case 'eye_round':
        render_eye_round($obj);
        break;
    default:
        exit("render object - unknown eye type: $obj");
    }

    render_face($obj);

    return;
}

/*
 * render_face('char_liuyue');
 */

function render_face($obj)
{
    global $v;
}

?>
