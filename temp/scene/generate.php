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

			break;
		default:
			exit("generate script - unknown script type: $type");
		}
	}
}

?>
