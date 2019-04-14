<?php

// File used in 
/*
- Homepage.php
*/

function getLastTenNotifications()
{
    $link = mysqli_connect("localhost", "root", "", "gdpr_database");
    $tableName = "events"; // nome della tabella da cui estrarre i dati

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT * FROM $tableName ORDER BY e_date_from"; // Tutti gli eventi
    $dbResult = mysqli_query($link, $query);
    $today = date("Y-m-d");
    $index = 0;

    $events = [];

    while ($line = mysqli_fetch_array($dbResult, MYSQLI_NUM)) {
        $current_event = [];
        $current_event['id'] = $line[0];
        $current_event['name'] = $line[2];
        $current_event['description'] = $line[3];
        $current_event['participants'] = $line[9];
        $current_event['state'] = explode(";",$line[7]);

        $inState = in_array($_SESSION['username'],$current_event['state']);
        $hiddenNotification = !in_array($current_event['id'], $_SESSION['hiddenNotifications']);
        $isUserNotified = userShouldBeNotified($_SESSION['username'], $current_event['participants']);

        if ($today >= $line[4] && $index < 10 && $isUserNotified && $hiddenNotification && $inState) {
            $typology = mysqli_query($link, "SELECT * FROM `event_typologies` WHERE et_id = $line[1]");

            $typology = $typology->fetch_assoc();
            $current_event['color'] = $typology['et_color'];
            $current_event['second_color'] = rgbToHsl($typology['et_color'], 30);
            $current_event["priority"] = $typology['et_priority'];
            $events["event_$index"] = $current_event;
            $index++;
        }
    }
    return $events;
}

function getLastEvents()
{
    $link = mysqli_connect("localhost", "root", "", "gdpr_database");
    $tableName = "events"; // nome della tabella da cui estrarre i dati

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT * FROM $tableName JOIN event_typologies on $tableName.e_typology = event_typologies.et_id ORDER BY e_date_from"; // Tutti gli eventi
    $dbResult = mysqli_query($link, $query);
    $today = date("Y-m-d");

    while ($line = mysqli_fetch_array($dbResult, MYSQLI_NUM)) {

        if ($today <= $line[5]) {
            $stato = "In arrivo";
            if ($today >= $line[4]) {
                $stato = "In corso";
            }
            $event_start = date_parse($line[4]);
            echo "<h3>$event_start[day]/$event_start[month]/$event_start[year]: $line[2] ($stato)</h3>\n<p>$line[3]</p>\nTermine: ";
            $event_end = date_parse($line[5]);
            echo "$event_end[day]/$event_end[month]/$event_end[year]";
            echo "<p>Tipologia: $line[13]</p>";
            echo "<hr>";
        }
    }
}

function rgbToHsl($color, $correction)
{
    $r = hexdec(substr($color, 1, 2)) / 255;
    $g = hexdec(substr($color, 3, 2)) / 255;
    $b = hexdec(substr($color, 5, 2)) / 255;

    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $h;
    $s;
    $l = ($max + $min) / 2;
    $d = $max - $min;
    if ($d == 0) {
        $h = $s = 0; // achromatic
    } else {
        $s = $d / (1 - abs(2 * $l - 1));
        switch ($max) {
            case $r:
                $h = 60 * fmod((($g - $b) / $d), 6);
                if ($b > $g) {
                    $h += 360;
                }
                break;
            case $g:
                $h = 60 * (($b - $r) / $d + 2);
                break;
            case $b:
                $h = 60 * (($r - $g) / $d + 4);
                break;
        }
    }
    $h = round($h, 2);
    $s = round($s, 2) * 100;
    $l = round($l, 2) * 100;
    $l += $correction;
    return "hsl($h, $s%, $l%)";
}

function userShouldBeNotified($current_user, $list)
{
    if (strlen($list) > 0) {
        //$current_id = ;

        $link = mysqli_connect("localhost", "root", "", "gdpr_database");
    
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    
        $query = "SELECT u_id FROM `users` WHERE u_username = '$current_user'"; // Tutti gli eventi
        $dbResult = mysqli_query($link, $query);
        $data = $dbResult->fetch_assoc();
        if(!empty($data)){
            return 1;
        }else{
            return 0;
        }
    }
}
