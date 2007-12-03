<?php

function scanf($string = '')
{
	echo $string;
	$fp = fopen('/dev/stdin', 'r');
	$input = fgets($fp, 255); 
	fclose($fp);
	$input = chop($input); 
	return $input;
}

while (true)
{
	$s = scanf();
	echo "$s\n# ";
}

?>
