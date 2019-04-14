<?php
session_start();
header('Content-Type: application/json');

$operation = $_POST["operation"];
$notificationToHide = $_POST["notifToHideId"];

if($operation == "close" && isset($operation)){
    removeFromState($notificationToHide);
}

if($operation == "hide" && isset($operation)) {
    hideNotification($notificationToHide);
}

function removeFromState($eventId)
{
    $link = mysqli_connect("localhost", "root", "", "gdpr_database");
    $events = "events"; // nome della tabella da cui estrarre i dati

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT e_state FROM $events WHERE e_id = $eventId"; // Tutti gli eventi
    $dbResult = mysqli_query($link, $query);
    $result = $dbResult->fetch_assoc();
    $e_state = explode(";", $result["e_state"]);
    print_r($e_state);

    $link = mysqli_connect("localhost", "root", "", "gdpr_database");
    $tableName = "events"; // nome della tabella da cui estrarre i dati

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $link = mysqli_connect("localhost", "root", "", "gdpr_database");
    $tableName = "events"; // nome della tabella da cui estrarre i dati

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $username = $_SESSION["username"];

    $query = "SELECT u_id FROM users WHERE u_username = '$username'";
    $dbResult = mysqli_query($link, $query);
    $result = $dbResult->fetch_assoc();
    $userId = $result['u_id'];

    // Remove the user from the status column
    $newState = [];
    foreach ($e_state as $stateUser) {
        if ($stateUser != $userId) {
            $newState[] = $stateUser;
        }
    }
    $newState = implode(";", $newState);

    

    // Update the column to reflect changes in DB
    $query = "UPDATE `$events` SET e_state = '$newState' WHERE e_id = $eventId";
    $dbResult = mysqli_query($link, $query);

    //print_r($_SESSION);
}

function hideNotification($eventId) {
    if(!in_array($eventId, $_SESSION["hiddenNotifications"])){
        $_SESSION["hiddenNotifications"][] = $eventId;
    }
    
    print_r($_SESSION);
}
