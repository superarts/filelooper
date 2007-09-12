<?php

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
			$sign = -1;
			
			for ($i_habit = 0; $i_habit < $text_count; $i_habit++)
			{
				$rate = $habit['rate'];

				if ($rate >= calc_rand(0, 1))
				{
					$x = calc_rand($habit['x_min'], $habit['x_max']);
					$y = calc_rand($habit['y_min'], $habit['y_max']);
					$x *= $sign;
					$y *= -1;

					$sign *= -1;
					$last = calc_rand($habit['last_min'], $habit['last_max']);

					$v[$name]['event'][count($v[$name]['event'])] = array(
						'action'	=> 'move',
						'start'		=> $start + $i_habit * $word_duration,
						'duration'	=> $last,
						'part'		=> 'head',
						'x'			=> $x,
						'y'			=> $y);

					$last = floor($last) - 1;

					if ($last > 0)
						$i_habit += $last;
				}
			}

			break;
		default:
			exit("generate script - unknown script type: $type");
		}
	}
}

?>
