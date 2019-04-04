<?php
    header('Content-Type: application/json');

    if( isset($_POST['notifToHideId']) ) { array_push($_SESSION, $_POST['notifToHideId']); }

?>