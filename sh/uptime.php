<?php

header('Content-Type: application/json; charset=UTF-8'); 

$totalSeconds = shell_exec("/usr/bin/cut -d. -f1 /proc/uptime");

// If we get error then try another command
if(!$totalSeconds && file_exists('/usr/bin/uptime')) {
    $output = shell_exec("/usr/bin/uptime | /usr/bin/awk '{print $3,$5}' | /usr/bin/cut -d, -f1");
    $timeArray = explode(" ",$output);
    $hoursArray = explode(":",$timeArray[1]);

    $days = $timeArray[0];
    $hours = $hoursArray[0];
    $min = $hoursArray[1];
} else {

    $totalMin   = $totalSeconds / 60;
    $totalHours = $totalMin / 60;

    $days  = floor($totalHours / 24);
    $hours = floor($totalHours - ($days * 24));
    $min   = floor($totalMin - ($days * 60 * 24) - ($hours * 60));
}

$formatUptime = '';
if ($days != 0) {
    $formatUptime .= "$days days ";
}

if ($hours != 0) {
    $formatUptime .= "$hours hours ";
}  

if ($min != 0) {
    $formatUptime .= "$min minutes";
} 

echo json_encode($formatUptime);
