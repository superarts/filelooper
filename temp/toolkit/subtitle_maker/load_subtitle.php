<?php

$subtitle = file("/home/leo/studio/mv/tj_nunchakus/subtitle.txt");
$timestamp = file("/home/leo/studio/mv/tj_nunchakus/counter.txt");

$subtitle = file("/home/leo/studio/mv/manny_man/subtitle.txt");
$timestamp = file("/home/leo/studio/mv/manny_man/counter.txt");

$subtitle = file("/home/leo/studio/mv/fan_gogo_live/subtitle.txt");
$timestamp = file("/home/leo/studio/mv/fan_gogo_live/counter.txt");

$subtitle = file("/home/leo/studio/mv/tomb_tv/subtitle.txt");
$timestamp = file_get_contents("/home/leo/studio/mv/tomb_tv/counter.txt");

$name = '$subtitle';

$min = 2;
$index = 0;
$item = '';

echo "<?php\n\n";
foreach ($subtitle as $s)
{
	$len = strlen($s);

	//	if ($s == "\n")
	if ($len <= $min)
	{
		echo "$name" . "[$index] = <<< EOT\n";
		echo "$item";
		echo "EOT;\n\n";

		$item = '';
		$index++;
	}
	else
	{
		$item .= $s;
	}

	//	echo "length: $len\n";
}

echo "\$timestamp = array(\n$timestamp\n);\n\n";
echo "//	print_r(\$subtitle);\n";
echo "//	print_r(\$timestamp);\n";

echo "\n?>"

?>
