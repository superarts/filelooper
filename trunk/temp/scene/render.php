<?php

function get_dest_name($i)
{
    global $v;

    $filename = '';
    $episode = str_pad($v['scene']['episode'], 3, '0', STR_PAD_LEFT);
    $scene = str_pad($v['scene']['scene'], 5, '0', STR_PAD_LEFT);
    $index = str_pad($i, 8, '0', STR_PAD_LEFT);

    $filename .= $v['scene']['name'];
    $filename .= '_' . $episode;
    $filename .= '_' . $scene;
    $filename .= '_' . $index;
    $filename .= '.png';

    return $filename;
}

function render_scene()
{
    global $v;
    $backup = $v;

    $fps = $v['scene']['fps'];
    $duration = $v['scene']['duration'];
    $count = $fps * $duration;

    for ($i = 1; $i <= $count; $i++)
    {
        //  render scene
        echo "rendering #$i\n";
        $v['image_scene'] = imagecreatetruecolor($v['scene']['res_x'], $v['scene']['res_y']);

        imagefill($v['image_scene'], 0, 0, $v['color_blue']);
        render_frame($i);

        imagepng($v['image_scene'], get_dest_name($i));
		imagedestroy($v['image_scene']);

        $v = $backup;
    }
}

function action_move($name, $part, $x, $y) 
{
    global $v;
	
	$v[$name][$part . '_x'] = $x;
	$v[$name][$part . '_y'] = $y;
	//	echo "action move: $x, $y\n";
}

function render_frame($i_frame)
{
    global $v;

    $fps = $v['scene']['fps'];

    for ($i = 0; $i < count($v['object']); $i++)
    {
        $name = $v['object'][$i];

        //  event checking
        for ($i_event = 0; $i_event < count($v[$name]['event']); $i_event++)
        {
            $event_start = $v[$name]['event'][$i_event]['start'];
            $event_start *= $fps;
            $event_end = $event_start + $v[$name]['event'][$i_event]['duration'];
            $event_end *= $fps;

            if (($event_start <= $i_frame) and ($i_frame <= $event_end))
            {
                $part = ($v[$name]['event'][$i_event]['part']);

                //  event handling
                switch ($v[$name]['event'][$i_event]['action'])
                {
                case 'move':
                    $x = ($v[$name]['event'][$i_event]['x']);
                    $y = ($v[$name]['event'][$i_event]['y']);

                    if (isset($v['set'][$part]) == true)
                    {
                        //  parts set
                        for ($i_part = 0; $i_part < count($v['set'][$part]); $i_part++)
                        {
                            $p = $v['set'][$part][$i_part];
                            action_move($name, $p, $x, $y);
                        }
                    }
                    else
                    {
                        //  single part
                        action_move($name, $p, $x, $y);
                    }

                    break;
                }
            }
        }

        //  render parts
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

    $obj_x = $v['scene']['res_x'] * $scale;
    $obj_y = $obj_x * $part_y / $part_x;
    //  echo "obj size: $obj_x, $obj_y\n";

	$x += $v[$name][$part . '_x'];
	$y += $v[$name][$part . '_y'];

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
