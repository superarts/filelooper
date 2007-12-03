<?php

$filename_ogg = "~/show_001_01.ogg";
$filename_php = "script.php";
$char_name = 'liuyue';
$char_action = 'speak';

function scanf($string = '')
{
	echo $string;
	$fp = fopen('/dev/stdin', 'r');
	$input = fgets($fp, 255); 
	fclose($fp);
	$input = chop($input); 
	return $input;
}

/*
   clip table: ((1.5, 1.7), (2, 4)) - (start, duration)
*/
$clip = array(
		array(1.5, 1.7),
		array(4, 1.5),
		);
$word = array();

//	echo count($clip);

for ($i = 0; $i < count($clip); $i++)
{
	$clip_start = $clip[$i][0];
	$clip_duration = $clip[$i][1];

	//	play sound clip
	$s = "mplayer $filename_ogg -ss $clip_start -endpos $clip_duration -nolirc &";
	//	echo "$s\n";
	exec($s);

	//	read word
	$s = "#$i -\t$clip_start\tto\t$clip_duration:\t";
	$s = scanf($s);
	switch ($s)
	{
		case '':
			$i--;
			break;

		case 'exit':
		case 'quit':
			exit("EXIT: user abort.\n");

		default:
			$word[$i] = "say $char_name at $clip_start for $clip_duration $char_action $s ";
	}
}

//	print_r($word);
echo "\n";

$fp = fopen($filename_php, "wb");
fwrite($fp, "<?php\n\n");
fwrite($fp, "\$v[''] = array(\n");
fwrite($fp, "\t\t'script' = array(\n");
for ($i = 0; $i < count($word); $i++)
{
	fwrite($fp, "\t\t\t'$word[$i]',\n");
}
fwrite($fp, "\t\t\t),");
fwrite($fp, "\t\t'name' => '');\n");
fwrite($fp, "\n?>");
fclose($fp);

system("cat $filename_php");
echo "\n\n";

?>
