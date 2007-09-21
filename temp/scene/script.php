<?php

$v['exp'] = array(
	'speak'	=> 'speak',
	'smile'	=> 'smile',
	'name'	=> 'Expression Mapping');

$v['chinese'] = array(
	'-'		=> '001',
	'a'		=> '002',
	'o'		=> '003',
	'e'		=> '004',
	'i'		=> '005',
	'u'		=> '006',
	'v'		=> '007',
	'b'		=> '001',
	'p'		=> '001',
	'm'		=> '001',
	'f'		=> '008',
	'name'	=> 'Language Mapping - Chinese');

//	get_substr('i say you cannot win! ', 'say ') = you cannot win!;

function script_substr($s, $sub)
{
	$p = strpos($s, $sub);

	return substr($s, $p + strlen($sub), -1);
}

function language_filter($s, $language = 'chinese')
{
	global $v;
	$result = '';

	for ($i = 0; $i < strlen($s); $i++)
	{
		$char = $s{$i};
		foreach ($v[$language] as $letter => $name)
		{
			if (($char == ' ') or ($char == $letter))
			{
				$result .= $char;
				break;
			}
		}
	}

	return $result;
}

?>
