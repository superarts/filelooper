<?php

/*
 * How to use:
 *      Simply edit the contents below and execute this script.
 *      For example, if you are using vim under win32, 'edit' and 'make' are all you have to do.
 */

$path = 'E:\download\Trixie_Teen_All_Pics\Pictures';

$process_count = 4;

function handler($f, $process_index)
{
    global $path;

    switch ($process_index)
    {
    case 1:
        delete_all_ext($f, array('html', 'htm'));
        break;
    case 2:
        //  delete_but_ext($f, array('jpg', 'jpeg'));
        break;
    case 3:
        move_rename($f, $path);
        break;
    case 4:
        //	rename_fill_number($f, 3);
        break;
    }

    return;
}

/*
 * Notice:
 *      You don't need to worry about contents below, dude... 
 *      Have a good loop.
 *      Check result.txt if you want to view what you've done (or should I say, what I've done for you :p)
 */

$mode = "debug";
$mode = "release";

function execute($s)
{
    echo "executing $s...\n";
    shell_exec($s);
}

/*
 * Example:
 *      move 'd:/project/a.bat to d:/project_a.bat'
 */
function move_rename($filename, $dest)
{
    global $path;

    $source = substr($filename, strlen($path) + 1, strlen($filename) - strlen($path));
    $source = str_replace("\\", '_', $source);
    $source = "$dest\\$source";

    execute("move \"$filename\" \"$source\"");
}

/*
 * Example:
 *      length = 3, 1_23_4.bmp -> 001_023_004.bmp
 */
function rename_fill_number($filename, $length)
{
    $file = pathinfo($filename);
    $name = $file["basename"];
    $path = $file["dirname"];
    $count = 0;
    $dest = '';
    $num = '';

    for ($i = 0; $i < strlen($name); $i++)
    {
        $char = $name{$i};
        if (('0' <= $char) and ($char <= '9'))
        {
            if ($count == 0)
            {
                $num = $char;
            }
            else
            {
                $num .= $char;
            }
            $count++;
        }
        else
        {
            if ($count != 0)
            {
                for ($ii = 0; $ii < $length - $count; $ii++)
                {
                    $dest .= '0';
                }
                $dest .= $num;
                $count = 0;
            }
            $dest .= $char;
        }
    }

    execute("ren \"$filename\" \"$dest\"");
}

function delete_all_ext($filename, $ext)
{
	$extend = pathinfo($filename);
    $extend = strtolower($extend["extension"]);

    for ($i = 0; $i < count($ext); $i++)
    {
        if ($extend == $ext[$i])
            execute("del \"$filename\" /f");
    }
}

function delete_but_ext($filename, $ext)
{
    $extend = pathinfo($filename);
    $extend = strtolower($extend["extension"]);

    $del_tag = true;
    for ($i = 0; $i < count($ext); $i++)
    {
        if ($extend == $ext[$i])
            $del_tag = false;
    }
    if ($del_tag == true)
        execute("del \"$filename\" /f");
}

function loop($path, $process_index)
{
    if ($handle = opendir($path))
    {
        while (false !== ($filename = readdir($handle)))
        {
            if (($filename != '.') and ($filename != '..'))
            {
                if (is_dir("$path\\$filename"))
                {
                    loop("$path\\$filename", $process_index);
                }
                else
                {
                    //  echo "in $path found $path\\$filename\n";
                    handler("$path\\$filename", $process_index);
                }
            }
        }
        closedir($handle);
    }
    else
    {
        echo "error opening $path\n";
    }
}

switch ($mode)
{
case "release":
    for ($i = 1; $i <= $process_count; $i++)
    {
        loop($path, $i);
    }
    break;
case "debug":
    echo "----start of debug----\n";

	//  $extend = pathinfo("c:\\test\\abc.txt");
    //  print_r($extend);
    
    //  echo rename_fill_number('1_23_245.bmp', g);
    
    echo move_rename("$path\\a\bb\ccc\dddd.txt", "c:\\test");

    echo "---- end of debug ----\n";
    break;
}

?>
