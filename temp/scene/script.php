<?php

//	http://38.100.22.210/bbss/forumdisplay.php?fid=17&page=1 jjjj8888:2230177

//	set OBJECT is TYPE at POS_X POS_Y size SCALE
//	say OBJECT at START for DURATION speak/smile/cry/... SENTENSE

$v['script'] = array(
	'set liuyue as kid at 0.5 0.1 size 0.5 ',
	'say liuyue at 1 for 1.5 speak cao ni ma! ');

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
/*
 * get_substr('i say you cannot win! ', 'say ') = you cannot win!;
 */

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
