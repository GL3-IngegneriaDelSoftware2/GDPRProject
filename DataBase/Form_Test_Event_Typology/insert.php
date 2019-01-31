<!-- Il seguente script php, riceve i dati da un form html e dopo aver testato la connessione con un db esegue una query
per inserire i dati in una tabella del db -->
<?php

// Salviamo i dati che ci arrivano dal form html in variabili php
$name = $_POST['name']; // Stringa nome tipologia dell'evento
$priority = $_POST['priority']; // Priorita' evento, stringa di un interno da 1 a 5 compresi
$early_notification = $_POST['early_notification']; // Notifica anticipata, stringa anel formato ("hh/mm")
$repeat_value = $_POST['repeat_value']; // Interno da 1 a 99 compresi che rappresenta l'indice di ripetizione
$repeat_interval = $_POST['repeat_interval']; // Stringa che indica l'intervallo di ripetizione

//==== Elaborazione dei dati ====

// Elaborazione early_notification
$notification_time = explode(":",$early_notification); // Divido in ore :: minuti
$notification_time[0] = (int)$notification_time[0]; // trasformo le stringhe in interi
$notification_time[1] = (int)$notification_time[1];
$early_notification_minutes = $notification_time[0]*60 + $notification_time[1]; // Sommo ore * 60 + minuti => minuti totali

// Elaborazione repat ((TEMP))
$repeat_after_hours = 0; // 0 = non ripetere, > 0 ripeti dopo n ore;
$interval_multiplier = 24; // Indica il moltiplicatore dei giorni di ripetizione, 24 indica giornaliero, 720 indica "mensile" 

switch ($repeat_interval) { // non include daily, in quanto lo e' di default
    case "no-repeat":
        $interval_multiplier = 0;
        break;
    case "weekly":
        $interval_multiplier*=7;
        break;
    case "monthly":
        $interval_multiplier*=30; // ERRORE
        break;
    case "yearly":
        $interval_multiplier*=365; // ERRORE
        break;
    case "":
        $interval_multiplier = 0; // Si potrebbe unire con no-repeat ma con || non funziona
}

$repeat_after_hours = $interval_multiplier * $repeat_value;

// Dettagli del db
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "gdpr_database";
$tableName = "event_typologies";

if (!empty($name) || !empty($priority) || !empty($early_notification) || !empty($repeat_value) || !empty($repeat_interval) || !empty($class) || !empty($state)) {
	
    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
    if (mysqli_connect_error()) { // connessione fallita
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{ // connessione ha successo
      // $INSERT = "insert into $tableName (e_name, e_typology, e_description, e_date_from, e_date_to, e_class, e_state, e_notes, e_participants, e_actual_start, e_actual_end) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $INSERT = "insert into $tableName (et_name, et_priority, et_early_notification, et_event_repeat) values(?, ?, ?, ?)";
      // Prepare statement
      $stmt = $conn->prepare($INSERT); // Prepariamo per INSERT
      $stmt->bind_param('siii', $name, $priority, $early_notification_minutes, $repeat_after_hours); // $dateFrom, $dateTo, $class, $state, $notes, $participants, $actualStart, $actualEnd);
      $stmt->execute();
      $stmt->close();
      $conn->close();
      echo "<h1>Event Typology Recap</h1><p>New event typology has been correctly created.</p><p>Event Typology Name : <em>$_POST[name]</em></p><p>Event Priority : $_POST[priority]</p><p>Early Notification: $early_notification_minutes minutes before</p><p>Event will be repeated every $repeat_after_hours hours</p>";
        }
	
}else{ // se le variabili sono vuote
 echo "All field are required";
 die();
}

?>