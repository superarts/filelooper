<?php

//	http://38.100.22.210/bbss/forumdisplay.php?fid=17&page=1 jjjj8888:2230177
//	http://www.christophkhouri.com/leo/source.zip
//
//	set OBJECT is TYPE at POS_X POS_Y size SCALE
//	say OBJECT at START for DURATION speak/smile/cry/... SENTENSE
//	goto OBJECT at START for/stay DURATION walk/jump POS_X POS_Y [for ... to ... for ... to ...]
//	zoom OBJECT at START for DURATION from SCALE to SCALE_TO

$v['script'] = array(
	           'set sky_sunny as sky at 0.5 -0.2 size 1.3 ',
	    'set ground_normal as ground at 0.5 -0.2 size 1.3 ',
	'set school_building as building at 0.5 -0.15 size 0.8 ',
	    'set school_flag as building at 0.5 -0.18 size 0.8 ',
		'set school_wall as building at 0.5 -0.2 size 1 ',
	'zoom school_building at 0 for 3 from 0.8 to 0.85 ',
	'zoom school_flag at 0 for 3 from 0.8 to 0.9 ',
	'zoom school_wall at 0 for 3 from 1 to 1.1 ',
	/*
	'set liuyue as kid at 0.5 0.1 size 0.5 ',
	'set liuyue_clone as kid at 0.2 0.2 size 0.1 ',
	'say liuyue at 1 for 1.5 speak cao ni ma! ',
	'say liuyue_clone at 1 for 1.5 speak ni ma bi. ',
	'zoom liuyue at 0 for 5 from 0.5 to 0.55 ',
	//	'goto liuyue at 1 for 3 walk 0.1 -0.1 ',
	'goto liuyue_clone at 1 for 2 walk 0.1 -0.1 for 2 walk 0.1 0.1 '
	 */
);

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
