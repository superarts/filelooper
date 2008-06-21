<?php

function print_backspace($count = 1)
{
	for ($i = 0; $i < $count; $i++)
	{
		echo "\010";
	}

	return $i;
}

$scale = 10;	//	delay 1/x seconds
if (isset($argv[1]))
	$start = $argv[1];
else
	$start = 0;

$counter = $start * 10;
$length = 10;

if (false)
{
	echo "/*
		Hit <Enter> when you think it's time to make formatted output.
		Copy the code below from console to a php file.
		TODO add ');' in the end of the code:
	 */\n\n";
	echo "\$name = array(\n";
}

while (true)
{
	//	$index = str_pad($counter, $length, '0', STR_PAD_LEFT);
	$index = $counter;
	echo "\t$index, " . 
	usleep(1000000 / $scale);
	print_backspace($length + 3 + 8);
	$counter++;
}

?>
