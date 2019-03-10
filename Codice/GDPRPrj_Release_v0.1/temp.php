<?php

function getLastFiveNotifications() {
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
        $current_event['name'] = $line[2];
        $current_event['description'] = $line[3];

        if ($today >= $line[4] && $index < 5) {
            $typology = mysqli_query($link, "SELECT * FROM `event_typologies` WHERE et_id = $line[1]");

            $typology = $typology->fetch_assoc();
            $current_event['color'] = $typology['et_color'];
            $events["event_$index"] = $current_event;
            $index++;
        }
    }
    return $events;

}

function getLastFiveEvents()
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
            echo "<hr>";
        }
    }
}
 