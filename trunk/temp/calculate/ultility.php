<?php

function calc_rand($min, $max, $scale = 10000)
{
	return rand($min * $scale, $max * $scale) / $scale;
}

/*
 *	get $i-th substr from $s, of which seperator is $ss
 *
 *	Last char of $s must be $ss if want to get the last substr.
 *	First char of $s should not be $ss.
 *
 */
function calc_get_token($source, $i, $ss = ' ')
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

function calc_get_layer_ratio($obj)
{
    global $v;
    return $v['scene'][$v['scene'][$obj]['layer']]['ratio'];
}

function calc_get_layer_land($obj)
{
    global $v;
    return $v['scene'][$v['scene'][$obj]['layer']]['land'];
}

/*
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
 */

?>
