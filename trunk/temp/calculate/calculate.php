<?php

/*
 *	get $i-th substr from $s, of which seperator is $ss
 *
 *	Last char of $s must be $ss if want to get the last substr.
 *	First char of $s should not be $ss.
 *
 */
function calc_get_token($source, $i, $ss)
{
	$s = $source . $ss;
	$start = 0;

	for ($index = 0; $index < $i; $index++)
	{
		$end = strpos($s, $ss, $start);
		if ($end == 0)
		{
			//	echo "get token:	unexcepted ending\n";
			return $s;
		}
		$result = substr($s, $start, $end - $start);
		//	echo "get token:	$index, $start, $end, $result\n";

		$start = $end + 1;
	}	//	end of for

	return $result;
}

function calc_get_axis($s)
{
	$axis = array();

	switch ($s)
	{
	case 'x':
	case 'width':
		$axis['pos'] = '_x';
		$axis['len'] = '_width';
		break;
	case 'y':
	case 'height':
		$axis['pos'] = '_y';
		$axis['len'] = '_height';
		break;
	case '':
	default:
		$axis['pos'] = '';
		$axis['len'] = '';
		//	exit("calculate pos - unknown axis: $axis");
	}

	return $axis;
}

function calculate_pos($obj, $element, $var, $fix = 1)
{
	global $v;
	$r = $v[$element][$var] * $fix;
	$axis = calc_get_token($var, 2, '_');
	$axis = calc_get_axis($axis);
	$element_type = calc_get_token($element, 1, '_');

	//	echo "calc pos: $obj, $var, $element, $axis, $element_type\n";
	//	print_r($axis);

	//	print_r($v);
	//	$temp = 'head' . $axis['len'];
	//	echo $v[$obj][$temp];
	
	echo "calc pos 1: $r\n";

	switch ($element_type)
	{
	case 'eye':
		$r = $r * $v[$obj]['head' . $axis['len']] / 100;		//	percentage to cm
			echo "calc pos 2: $r\n";
		$r = $r + $v[$obj]['head' . $axis['pos']];				//	add head pos fix
			echo "calc pos 3: $r\n";
		$r = $r * $v['scene'][$v['scene'][$obj]['layer']]['ratio'] / 100;	//	put char in layer
			echo "calc pos 4: $r\n";
        $r = $r + $v['scene'][$obj]['pos' . $axis['pos']];                  //	put char in scene
		$r = $r * $v['scene']['res' . $axis['pos']] / 100;				
        echo "calc pos 5: $r\n";

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
		$r = $r * $v[$obj]['head_width'] / 100;		//	percentage to cm
		$r = $r * $v['scene'][$v['scene'][$obj]['layer']]['ratio'] / 100;
		$r = $r * $v['scene']['res_x'] / 100;		//	put char in scene
		break;
	default:
		exit("calculate size - unknown lement: $element");
	}

	return $r;
}

?>
