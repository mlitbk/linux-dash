<?php 
header('Content-Type: application/json; charset=UTF-8');

$output = shell_exec('/usr/bin/lsb_release -ds;/bin/uname -r');

// for osx
if(!$output && file_exists('/usr/bin/sw_vers')) {
    $output = explode("\n",shell_exec('/usr/bin/sw_vers | /usr/bin/cut -f2-'));
    $output = implode(" ", array($output[0], $output[1]));
}

echo json_encode($output);
