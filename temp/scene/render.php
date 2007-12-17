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

	$pathname = $v['scene']['name'] . '_' . $episode . '_' . $scene;
	$filename = "./output/$pathname/$filename";

    return $filename;
}

function event_check($i_frame)
{
	global $v;
	$result = false;
	$filter = $v['render']['filter'];

	switch ($filter)
	{
	case 'all':
		$result = true;

		break;
	case 'event':
		if ($i_frame == 1)
		{
			$result = true;
		}

		$fps = $v['scene']['fps'];

		for ($i = 0; $i < count($v['object']); $i++)
		{
			$name = $v['object'][$i];

			//	echo "event checking: $name\n"; 	//	print_r($v[$name]);
			for ($i_event = 0; $i_event < count($v[$name]['event']); $i_event++)
			{
				$event_start = $v[$name]['event'][$i_event]['start'];
				$event_end = $event_start + $v[$name]['event'][$i_event]['duration'];
				$event_start *= $fps;
				$event_end *= $fps;
				$event_start = round($event_start);
				$event_end = round($event_end);
				//	echo "event checking: $i_event, $event_start, $event_end, $i_frame\n";

				if (($event_start == $i_frame) or ($i_frame == $event_end))
				{
					$result = true;
				}
			}
		}

		break;
	default:
		if ($i_frame == $filter)
			$result = true;
		//	exit('event checking - unknown filter');
	}

	return $result;
}

function render_scene()
{
    global $v;
    $backup = $v;

    $fps = $v['scene']['fps'];
    $duration = $v['scene']['duration'];
    $count = $fps * $duration;

	$time_start = time();
    for ($i = 1; $i < $count; $i++)
	{
		$overwrite = $v['render']['overwrite'];
		if ($overwrite == false)
		{
			if (file_exists(get_dest_name($i)) == true)
				continue;
		}

		if (event_check($i) == true)
		{
			$time_now = time() - $time_start;
			$time_all = round($time_now * $count / $i);
			$time_rest = round(($time_all - $time_now) / 60);

			//  render scene
			echo "rendering #$i / $count, time: $time_now - $time_all ($time_rest min left)\n";
			$v['image_scene'] = imagecreatetruecolor($v['scene']['res_x'], $v['scene']['res_y']);

			imagefill($v['image_scene'], 0, 0, $v['bg_color']);
			render_frame($i);

			imagepng($v['image_scene'], get_dest_name($i));
			imagedestroy($v['image_scene']);

			$v = $backup;
		}
		else
		{
			echo "skipped #$i\n";
		}
    }
}

function action_handler($name, $part, $param, $start, $end, $index) 
{
    global $v;

    $action = $param['action'];

    switch ($action)
    {
    case 'move':
        $x = $param['x'];
        $y = $param['y'];

		//	smooth move
		if (isset($param['dest_x']) == true)
			$dest_x = $param['dest_x'];
		else
			$dest_x = $x;
		if (isset($param['dest_y']) == true)
			$dest_y = $param['dest_y'];
		else
			$dest_y = $y;

		$x += ($dest_x - $x) * ($index - $start) / ($end - $start);
		$y += ($dest_y - $y) * ($index - $start) / ($end - $start);

		if (isset($v[$name][$part . '_x']) == false)
			$v[$name][$part . '_x'] = 0;
		if (isset($v[$name][$part . '_x']) == false)
			$v[$name][$part . '_x'] = 0;
        $v[$name][$part . '_x'] += $x;
		$v[$name][$part . '_y'] -= $y;
		$x1 = $v[$name][$part . '_x'];
		$y1 = $v[$name][$part . '_y'];
        //	echo "action move: $name, $part, $x1=$x/$dest_x, $y1=$y/$dest_y, $index=$start/$end\n";
        //	print_r($param); 
		break;
	case 'sub':
		$source = $param['source'];
		$v[$name][$part] = $source;

		break;
	case 'zoom':
		//	echo "$name:\n";
		//	print_r($param);
		$scale = $param['scale'];
		$scale_to = $param['scale_to'];

		if ($scale == 0)
			$scale = $v[$name]['scale'];
		if ($scale_to == 0)
			$scale_to = $v[$name]['scale'];

		$v[$name]['scale'] = $scale + ($scale_to - $scale) * ($index - $start) / ($end - $start);
        //	echo "action zoom: $name, $part, $scale, $scale_to, $index of $start - $end\n";

		break;
	case 'blend':
		$alpha = $param['alpha'];
		$alpha_to = $param['alpha_to'];

		/*
		if ($alpha == 0)
			$alpha = $v[$name]['alpha'];
		if ($alpha_to == 0)
			$alpha_to = $v[$name]['alpha'];
		 */

		$v[$name]['alpha'] = $alpha + ($alpha_to - $alpha) * ($index - $start) / ($end - $start);
        //	echo "action zoom: $name, $part, $alpha, $alpha_to, $index of $start - $end\n";

		break;
    default:
        exit("unknown action: $action\n");
    }
}

function calc_get_gradual($start, $end, $index, $count)
{
	return $start + ($end - $start) * $index / $count;
}

function camera_handler($i_frame)
{
	global $v;

	$fps = $v['scene']['fps'];
	$camera = $v['camera_script'];
	$start = 0;

	for ($i = 0; ($i < count($camera) - 1); $i++)
	{
		$start_pos_x = $camera[$i][0];
		$start_pos_y = $camera[$i][1];
		$start_center_x = $camera[$i][2];
		$start_center_y = $camera[$i][3];
		$start_scale = $camera[$i][4];
		$start_duration = $camera[$i][5] * $fps;
		$end = $start + $start_duration;

		if (($start <= $i_frame) and ($i_frame < $end))
		{
			$end_pos_x = $camera[$i + 1][0];
			$end_pos_y = $camera[$i + 1][1];
			$end_center_x = $camera[$i + 1][2];
			$end_center_y = $camera[$i + 1][3];
			$end_scale = $camera[$i + 1][4];
			$end_duration = $camera[$i + 1][5] * $fps;

			$v['camera']['pos_x'] = calc_get_gradual($start_pos_x, $end_pos_x, $i_frame - $start, $end);
			$v['camera']['pos_y'] = calc_get_gradual($start_pos_y, $end_pos_y, $i_frame - $start, $end);
			$v['camera']['center_x'] = calc_get_gradual($start_center_x, $end_center_x, $i_frame - $start, $end);
			$v['camera']['center_y'] = calc_get_gradual($start_center_y, $end_center_y, $i_frame - $start, $end);
			$v['camera']['scale'] = calc_get_gradual($start_scale, $end_scale, $i_frame - $start, $end);

			//	print_r($v['camera']);
			//	echo "camera handler: $start_pos_x, $start_pos_y, $start_center_x, $start_center_y, $start_scale, $i_frame, $start_duration, $end_duration\n";
			//	echo "camera handler: $end_pos_x, $end_pos_y, $end_center_x, $end_center_y, $end_scale, $start, $end\n";

			break;
		}

		$start = $end;
	}
}

function render_frame($i_frame)
{
    global $v;

	$fps = $v['scene']['fps'];
	//	camera handling
	camera_handler($i_frame);

    for ($i = 0; $i < count($v['object']); $i++)
    {
        $name = $v['object'][$i];

        //  event checking
        for ($i_event = 0; $i_event < count($v[$name]['event']); $i_event++)
        {
            $event_start = $v[$name]['event'][$i_event]['start'];
            $event_end = $event_start + $v[$name]['event'][$i_event]['duration'];
            $event_start *= $fps;
			$event_end *= $fps;
			//	$temp = $event_start - $i_frame;
            //  echo "event checking: $i_event, $event_start, $event_end, $i_frame, $temp\n";
			//	if ($event_start == $i_frame) echo "gotcha\n";

            if (calc_le($event_start, $i_frame) and calc_l($i_frame, $event_end))
			{
				//  event handling
				$temp = $event_end - $i_frame;
				//	echo "event checking: $temp, $i_frame < $event_end\n";
				$param = $v[$name]['event'][$i_event];

				//	no 'part' means it's for a whole object
				if (isset($v[$name]['event'][$i_event]['part']) == false)
				{
					action_handler($name, '', $param, $event_start, $event_end, $i_frame);
				}
				else
				{
					$part = ($v[$name]['event'][$i_event]['part']);

					if (isset($v['set'][$part]) == true)
					{
						//  parts set
						for ($i_part = 0; $i_part < count($v['set'][$part]); $i_part++)
						{
							$p = $v['set'][$part][$i_part];
							action_handler($name, $p, $param, $event_start, $event_end, $i_frame);
						}
					}
					else
					{
						//  single part
						action_handler($name, $part, $param, $event_start, $event_end, $i_frame);
					}
				}
            }
        }

        //  render parts
        render_object($v[$name]['type'], $name);
    }
}

function render_object($type, $name)
{
    global $v;

    for ($i = 0; $i < count($v[$type]); $i++)
    {
        render_part($name, $v[$type][$i]);
    }

    return;
}

function render_get_image($name, $part)
{
    global $v;

    //  echo "get image name: $name, $part\n";
	$filename = $v[$name][$part];
	if (substr_count($filename, '/') == 0)
		$filename = "./image/$part/$filename.png";
	else
		$filename = "./image/$filename.png";

    return $filename;
}

function render_part($name, $part)
{
    global $v;
	$scale = $v[$name]['scale'];
	if (isset($v[$name]['alpha']))
	{
		$alpha = $v[$name]['alpha'];
		$alpha = $alpha * 127 / 100;
	}
	else
		$alpha = 0;


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

	//	print_r($v[$name]);
    //	echo "render part - copy resized: $name, $part, $x, $y, $obj_x, $obj_y, $part_x, $part_y\n";
	$camera_scale = $v['camera']['scale'];
	$camera_x = $v['camera']['pos_x'] * $v['scene']['res_x'];
	$camera_y = $v['camera']['pos_y'] * $v['scene']['res_y'];
	$center_x = $v['scene']['res_x'] * ($v['camera']['center_x'] - $camera_scale / 2);
	$center_y = $v['scene']['res_y'] * ($v['camera']['center_y'] - $camera_scale / 2);

	$x *= $camera_scale;
	$y *= $camera_scale;
	$obj_x *= $camera_scale;
	$obj_y *= $camera_scale;

	$x += $camera_x;
	$y += $camera_y;

	$x += $center_x;
	$y += $center_y;

	/*
	 * TODO: alpha blending
	 * 		currently a null picture is used to replace the original picture when blend level is under 64.
	 */
	//	echo "alpha $filename: $alpha\n";
	if ($alpha < 64)
		$image = imagecreatefrompng($filename);
	else
		$image = imagecreatefrompng('image/null.png');

	/*
	if ($alpha != 0)
	{
		$sx = imagesx($image);
		$sy = imagesy($image);
		$blend = imagecolorallocatealpha($image, 255, 255, 255, $alpha);
		imagealphablending($image, true);
		imagefilledrectangle($image, 0, 0, $sx, $sy, $blend);
	}
	 */
	switch ($v['render']['renderer'])
	{
	case 'release':
		imagecopyresampled($v['image_scene'], $image, $x, $y, 0, 0, $obj_x, $obj_y, $part_x, $part_y);
		break;
	case 'debug':
		imagecopyresized($v['image_scene'], $image, $x, $y, 0, 0, $obj_x, $obj_y, $part_x, $part_y);
		break;
	default:
		exit("unknown renderer");
	}

    imagedestroy($image);
}

//	TODO: render_object('char_liuyue');
/*
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

function render_face($obj)
{
    global $v;
}
 */
?>
