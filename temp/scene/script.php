<?php

//	http://38.100.22.210/bbss/forumdisplay.php?fid=17&page=1 jjjj8888:2230177

//	set OBJECT is TYPE at POS_X POS_Y size SCALE
//	event OBJECT at START for DURATION say SENTENSE

$v['script'] = array(
	'set liuyue as kid at 0.5 0.1 size 0.5 ',
	'event liuyue at 1 for 1.5 say cao ni ma! ');

/*
 * get_substr('i say you cannot win', 'say') = you cannot win;
 */

function script_substr($s, $sub)
{
	$p = strpos($s, $sub);
	return substr($s, $p + strlen($sub), -1);
}

?>