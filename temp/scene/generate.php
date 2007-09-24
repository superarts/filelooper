<?php

function generate_script_say($name, $script, $count)
{
	global $v;

	$count++;
	$start = calc_get_token($script, $count);
	$count++;
	$count++;
	$duration = calc_get_token($script, $count);
	$count++;
	$action = calc_get_token($script, $count);
	$count++;
	$text = script_substr($script, $action . ' ');

	$action = $v['exp'][$action];
	$text = language_filter($text);
	//	echo "generate script - text: $text\n";
	$text = str_word_count($text, 1, ',;.?!');

	$text_count = count($text);
	$word_duration = $duration / $text_count;

	//	adding mouth substitute
	for ($i_say = 0; $i_say < $text_count; $i_say++)
	{
		$word = $text[$i_say];

		for ($i_word = 0; $i_word < strlen($word); $i_word++)
		{
			$char_duration = $word_duration / strlen($word);

			$char = $word{$i_word};
			$char = $v['chinese'][$char];

			$source = $action . $char;

			$v[$name]['event'][count($v[$name]['event'])] = array(
				'action'	=> 'sub',
				'start'		=> $start + $i_say * $word_duration + $i_word * $char_duration,
				'duration'	=> $char_duration,
				'part'		=> 'mouth',
				'source'	=> $source);
		}
	}

	//	adding habit speaking move
	$habit = $v[$name]['habit']['speak']['move'];
	$scale = $v[$name]['scale'];
	if (rand(0, 1) == 1)
		$sign = -1;
	else
		$sign = 1;

	for ($i_habit = 0; $i_habit < $text_count; $i_habit++)
	{
		$rate = $habit['rate'];

		if ($rate >= calc_rand(0, 1))
		{
			$x = calc_rand($habit['x_min'], $habit['x_max']);
			$y = calc_rand($habit['y_min'], $habit['y_max']);
			$x *= $sign;
			$y *= -1;
			$x *= $scale;
			$y *= $scale;

			$sign *= -1;
			$last = calc_rand($habit['last_min'], $habit['last_max']);

			$v[$name]['event'][count($v[$name]['event'])] = array(
				'action'	=> 'move',
				'start'		=> $start + $i_habit * $word_duration,
				'duration'	=> $last / 3,
				'part'		=> 'head',
				'x'			=> 0,
				'y'			=> 0,
				'dest_x'	=> $x,
				'dest_y'	=> $y,
				'name'		=> 'Action Move Start');

			$v[$name]['event'][count($v[$name]['event'])] = array(
				'action'	=> 'move',
				'start'		=> $start + $i_habit * $word_duration + $last / 3,
				'duration'	=> $last / 3,
				'part'		=> 'head',
				'x'			=> $x,
				'y'			=> $y,
				'dest_x'	=> $x,
				'dest_y'	=> $y,
				'name'		=> 'Action Move Still');

			$v[$name]['event'][count($v[$name]['event'])] = array(
				'action'	=> 'move',
				'start'		=> $start + $i_habit * $word_duration + $last * 2 / 3,
				'duration'	=> $last / 3,
				'part'		=> 'head',
				'x'			=> $x,
				'y'			=> $y,
				'dest_x'	=> 0,
				'dest_y'	=> 0,
				'name'		=> 'Action Move End');

			$last = floor($last) - 1;	//	floor or round?

			if ($last > 0)
				$i_habit += $last;
		}
	}

	return;
}

function generate_script_zoom($name, $script, $count)
{
	global $v;

	do {
		$s = calc_get_token($script, $count);
		$count++;
		$ss = calc_get_token($script, $count);
		$count++;

		switch ($s)
		{
		case 'at':
			$start = $ss;
			break;
		case 'for':
			$duration = $ss;
			break;
		case 'from':
			$scale = $ss;
			break;
		case 'to':
			$scale_to = $ss;
			break;
		default:
			exit("generate script zoom - unknown keyword: $s");
		}

		//	echo "generate script zoom: $s, $ss\n";
		$s = calc_get_token($script, $count);
	} while ($s != '');	//	($script . ' '));

	$v[$name]['event'][count($v[$name]['event'])] = array(
		'action'	=> 'zoom',
		'start'		=> $start,
		'duration'	=> $duration,
		'scale'		=> $scale,
		'scale_to'	=> $scale_to,
		'name'		=> 'Event Zoom');

	return;
}

function generate_script_goto($name, $script, $count)
{
	global $v;

	$x = $v[$name]['pos_x'];
	$y = $v[$name]['pos_y'];
	$scale = $v[$name]['scale'];
	$type = $v[$name]['type'];
	$habit = $v[$name]['habit']['goto']['move'];
	$step = $habit['step'];
	$step *= $scale;

	//	at
	$count++;
	$start = calc_get_token($script, $count);
	$count++;

	$last_x = 0;
	$last_y = 0;

	do {
		//	move(for) or stay
		$flag_stay = calc_get_token($script, $count);
		$count++;

		$duration = calc_get_token($script, $count);
		$count++;

		//	walk or jump
		$flag_walk = calc_get_token($script, $count);
		$count++;

		$dest_x = calc_get_token($script, $count);
		$count++;
		$dest_y = calc_get_token($script, $count);
		$count++;

		$loop = abs($x - $dest_x) / $step;
		if (($loop < 1) or ($flag_walk == 'jump'))
			$loop = 1;

		$duration /= $loop;
		$dest_x /= $loop;
		$dest_y /= $loop;

		//	echo "script generator goto - name, script, loop: $name, $script, $loop\n";

		for ($i_loop = 0; $i_loop < $loop; $i_loop++)
		{
			if ($flag_stay == 'for')
				$jump = 0 - calc_rand($habit['y_min'], $habit['y_max']) * $scale;	//	jump height
			else
				$jump = 0;

			//	echo "script generator goto - jump: $jump\n";

			$v[$name]['event'][count($v[$name]['event'])] = array(
				'action'	=> 'move',
				'start'		=> $start,
				'duration'	=> $duration / 2,
				'part'		=> $type . '_all',
				'x'			=> $last_x + $dest_x * $i_loop,
				'y'			=> $last_y + $dest_y * $i_loop,
				'dest_x'	=> $last_x + $dest_x * ($i_loop + 0.5),
				'dest_y'	=> $last_y + $dest_y * ($i_loop + 0.5) + $jump,
				'name'		=> 'Goto Habit Action Move Start');

			$v[$name]['event'][count($v[$name]['event'])] = array(
				'action'	=> 'move',
				'start'		=> $start + $duration / 2,
				'duration'	=> $duration / 2,
				'part'		=> $type . '_all',
				'x'			=> $last_x + $dest_x * ($i_loop + 0.5),
				'y'			=> $last_y + $dest_y * ($i_loop + 0.5) + $jump,
				'dest_x'	=> $last_x + $dest_x * ($i_loop + 1),
				'dest_y'	=> $last_y + $dest_y * ($i_loop + 1),
				'name'		=> 'Goto Habit Action Move End');

			$start += $duration;
		}

		$last_x += $dest_x * $loop;
		$last_y += $dest_y * $loop;
		//	echo "script generator goto - dest and last: $dest_x, $dest_y, $last_x, $last_y\n";

		$s = calc_get_token($script, $count);
		//	echo "s: ($s)\n";
	} while ($s != '');		//	($s != ($script . ' '));

	return;
}

function generate_script_sub($name, $script, $count)
{
	global $v;

	//	echo "generate script sub: $script\n";

	do {
		$s = calc_get_token($script, $count);
		$count++;
		$ss = calc_get_token($script, $count);
		$count++;

		switch ($s)
		{
		case 'at':
			$start = $ss;
			break;
		case 'for':
			$duration = $ss;
			break;
		case 'with':
			$count_source = $ss;
			$part = calc_get_token($script, $count);
			$count++;
			//	echo "generate script sub - with loop: $count_source\n";
			for ($i = 0; $i < $count_source; $i++)
			{
				$source[$i] = calc_get_token($script, $count);
				$count++;
				$delay[$i] = calc_get_token($script, $count);
				$count++;
			}
			break;
		default:
			exit("generate script sub - unknown keyword: $s");
		}

		//	echo "generate script sub: $s, $ss\n";
		$s = calc_get_token($script, $count);
	} while ($s != '');	//	($script . ' '));

	$time = 0;
	$index = 0;
	while ($time < $duration)
	{
		$v[$name]['event'][count($v[$name]['event'])] = array(
			'action'	=> 'sub',
			'start'		=> $start + $time,
			'duration'	=> $delay[$index],
			'part'		=> $part,
			'source'	=> $source[$index],
			'name'		=> 'Event Sub Generated by Script');

		$time += $delay[$index];
		$index++;
		if ($index == $count_source)
			$index = 0;
		//	echo "script generate sub: $name, $part, $time, $duration\n";
	}

	return;
}

function generate_script_look($name, $script, $count)
{
	global $v;

	$count++;
	$start = calc_get_token($script, $count);
	$count++;
	$count++;
	$duration = calc_get_token($script, $count);
	$count++;
	$count++;
	$direction = calc_get_token($script, $count);
	$count++;

	$eye = $v[$name]['eye'];
	$eye = substr($eye, 0, -3);

	switch ($direction)
	{
	case '180':		//	left
		$eye .= '180';
		break;
	case '0':		//	right
	case '360':
		$eye .= '360';
		break;
	default:
		exit("generate script look - unknown direction: $direction");
	}

	$s = "sub $name at $start for $duration with 1 eye $eye $duration ";
	//	echo "generate script look - script: $s\n";
	generate_script_sub($name, $s, 3);
}

function generate_script()
{
	global $v;

	for ($i = 0; $i < count($v['script']); $i++)
	{
		$script = $v['script'][$i];
		$count = 1;

		$type = calc_get_token($script, $count);
		$count++;
		$name = calc_get_token($script, $count);
		$count++;

		switch ($type)
		{
		case 'set':
			do {
				$s = calc_get_token($script, $count);
				$count++;

				switch ($s)
				{
				case 'as':
					$type = calc_get_token($script, $count);
					$count++;

					$v[$name]['type'] = $type;

					break;
				case 'at':
					$x = calc_get_token($script, $count);
					$count++;
					$y = calc_get_token($script, $count);
					$count++;

					$v[$name]['pos_x'] = $x;		//	floatval($x);
					$v[$name]['pos_y'] = $y;		//	floatval($y);

					break;
				case 'size':
					$scale = calc_get_token($script, $count);
					$count++;

					$v[$name]['scale'] = $scale;	//	floatval($scale);

					break;
				}

				//	echo "generate script - set loop: '$s', '$script'\n";
			} while ($s != ($script . ' '));

			break;
		case 'say':
			generate_script_say($name, $script, $count);

			break;
		case 'goto':
			generate_script_goto($name, $script, $count);

			break;
		case 'zoom':
			generate_script_zoom($name, $script, $count);

			break;
		case 'sub':
			generate_script_sub($name, $script, $count);

			break;
		case 'look':
			generate_script_look($name, $script, $count);

			break;
		default:
			exit("generate script - unknown script type: $type");
		}
	}
}

?>
