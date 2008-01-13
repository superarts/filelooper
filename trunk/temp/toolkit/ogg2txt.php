<?php

$filename_ogg = "/home/leo/Desktop/studio/oneman00103/audio/018.ogg";
//	$filename_ogg = "/home/leo/mnt/e/studio/oneman/oneman_001_02_12.ogg";
//	$filename_wav = "/home/leo/mnt/e/studio/show_001_08.wav";
$filename_php = "script.php";
$char_name = 'liuyue';
$char_action = 'speak';

//	dl("oggvorbis.so");
define("OGG_RES", 441);			//	resolution
define("OGG_VOLUME", 0.02);		//	silence volume lowest
define("OGG_LENGTH", 20);		//	silence length shortest
define("OGG_VOICE", 0.1);		//	acceptable voice max
define("OGG_NOISE", 1);			//	silence noise max

/*
   helper
*/
function scanf($string = '')
{
	echo $string;
	$fp = fopen('/dev/stdin', 'r');
	$input = fgets($fp, 255); 
	fclose($fp);
	$input = chop($input); 
	return $input;
}

function str_to_s16($s1, $s2)
{
	$ret = ord($s1) + ord($s2) * 256;
	if ($ret >= 32768)
		$ret -= 65536;

	return $ret;
}

/*
   clip table: ((1.5, 1.7), (2, 4)) - (start, duration)
*/
//	$clip = array( array(1.5, 1.7), array(4, 1.5));
$word = array();

/* By default, ogg:// will decode to Signed 16-bit Little Endian */
//	$fp = fopen('ogg://e:/studio/show_001_08.ogg', 'r');
$fp = fopen("ogg://$filename_ogg", 'r');

/* Collect some information about the file. */
$metadata = stream_get_meta_data($fp);

/* Inspect the first song (usually the only song, 
   but OGG/Vorbis files may be chained) */
$songdata = $metadata['wrapper_data'][0];

echo "vim: ts=8 ss=8\n";

print_r($songdata);
//foreach($songdata['comments'] as $comment) {
//    echo "  $comment\n";
//}

$counter = 0;
$index = 0;
$left = array();
$right = array();
$vol = array();

echo "Processing ogg data";

//	$audio_data = fread($fp, 8192);
while ($audio_data = fread($fp, 8192))
{
	$count = strlen($audio_data);
	$count /= 4;
	//	echo "DATA: $count\n";
	//	echo $audio_data;

	for ($i = 0; $i < $count; $i++)
	{
		$left[$counter] = str_to_s16($audio_data{$i * 2}, $audio_data{$i * 2 + 1}) / 32768;
		$left[$counter] = abs($left[$counter]);
		$right[$counter] = str_to_s16($audio_data{$i * 2 + 2}, $audio_data{$i * 2 + 3}) / 32768;
		$right[$counter] = abs($right[$counter]);
		if ($counter >= OGG_RES)
		{
			$volume = (array_sum($left) + array_sum($right)) / OGG_RES / 2;
			$vol[$index] = $volume;

			//	if ($volume < OGG_LOWEST)
			//		$volume = '----';
			//	echo "$index:\t$volume\n";

			$index++;
			$left = array();
			$right = array();
			$counter = 0;

			if ($index % 100 == 0)
				echo ".";
		}
		$counter++;
	}

  /* Do something with the PCM audio we're extracting from the OGG.
     Copying to /dev/dsp is a good target on linux systems, 
     just remember to setup the device for your sampling mode first. */
}
echo "Done.\n";

fclose($fp);

$i = 0;
$ii = 0;
$silence_index = 0;

while (($i + $ii) < count($vol))
{
	$noise_count = 0;
	while (($noise_count <= OGG_NOISE) and (($i + $ii) < count($vol)))
	{
		if ($vol[$i + $ii] > OGG_VOLUME)
			$noise_count++;
		$ii++;
	}

	if ($ii >= OGG_LENGTH)
	{
		//	silence long enough
		$silence[$silence_index] = $i - 2;
		$silence_index++;
		$silence[$silence_index] = $i + $ii;
		$silence_index++;
	}

	$i += $ii;
	$ii = 0;
}

//	print_r($vol);
//	for ($i = 0; $i < count($vol); $i++) if ($vol[$i] <= OGG_VOLUME) echo "$i\t----\n"; else echo "$i\t$vol[$i]\n";
//	print_r($silence);

$clip = array();
for ($i = 0; $i < (count($silence) / 2 - 1); $i++)
{
	$clip[$i][0] = $silence[$i * 2 + 1] / 100;
	$clip[$i][1] = ($silence[$i * 2 + 2] - $silence[$i * 2 + 1]) / 100;
}

//	print_r($clip);
//	echo count($clip);

for ($i = 0; $i < count($clip); $i++)
{
	$clip_start = $clip[$i][0];
	$clip_duration = $clip[$i][1];

	if ($clip_duration > OGG_VOICE)
	{
		//	play sound clip
		//	$s = "mplayer $filename_wav -ss $clip_start -endpos $clip_duration -nolirc &";
		$s = "play -q $filename_ogg trim $clip_start $clip_duration";
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
}
$word_count = $i;

echo "Word array:\n";
	print_r($word);

$s = scanf("Save to file (default $filename_php):\t");
if ($s != "")
	$filename_php = $s;

$fp = fopen($filename_php, "ab");
fwrite($fp, "<?php\n\n");
fwrite($fp, "\$v[''] = array(\n");
fwrite($fp, "\t\t'script' = array(\n");
for ($i = 0; $i < $word_count; $i++)
{
	if (isset($word[$i]))
		fwrite($fp, "\t\t\t'$word[$i]',\n");
}
fwrite($fp, "\t\t\t),");
fwrite($fp, "\t\t'name' => '');\n");
fwrite($fp, "\n?>");
fclose($fp);

echo "$ cat $filename_php\n";
system("cat $filename_php");
echo "\n\n";

?>
