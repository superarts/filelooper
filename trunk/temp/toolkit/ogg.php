<?php

//	dl("oggvorbis.so");
define("OGG_RES", 441);			//	resolution
define("OGG_VOLUME", 0.03);		//	silence volume lowest
define("OGG_LENGTH", 30);		//	silence length shortest
define("OGG_NOISE", 1);			//	silence noise max

function str_to_s16($s1, $s2)
{
	$ret = ord($s1) + ord($s2) * 256;
	if ($ret >= 32768)
		$ret -= 65536;

	return $ret;
}

/* By default, ogg:// will decode to Signed 16-bit Little Endian */
//	$fp = fopen('ogg://e:/studio/show_001_08.ogg', 'r');
$fp = fopen('ogg:///home/leo/mnt/e/studio/show_001_08.ogg', 'r');

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
		$silence[$silence_index] = $i;
		$silence_index++;
		$silence[$silence_index] = $i + $ii;
		$silence_index++;
	}

	$i += $ii;
	$ii = 0;
}

	print_r($silence);
//	print_r($vol);

$clip = array();
for ($i = 0; $i < (count($silence) / 2 - 1); $i++)
{
	$clip[$i][0] = $silence[$i * 2 + 1];
	$clip[$i][1] = $silence[$i * 2 + 2];
}

print_r($clip);

?>
