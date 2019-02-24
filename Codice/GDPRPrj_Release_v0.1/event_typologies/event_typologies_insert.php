<!-- Descrizione: Il seguente script php, riceve i dati da un form html e dopo aver testato la connessione con un db esegue una query
per inserire i dati in una tabella del db -->
<?php

// Salviamo i dati che ci arrivano dal form html in variabili php
$name = $_POST['name']; // Stringa nome tipologia dell'evento
$priority = $_POST['priority']; // Priorita' evento, stringa di un interno da 1 a 5 compresi
$early_notification = $_POST['early_notification']; // Notifica anticipata, stringa anel formato ("hh");
$repeat_interval = $_POST['repeat_interval']; // Stringa che indica l'intervallo di ripetizione
$typology_color = $_POST['typology_color']; // colore legato alla tipologia di evento

$early_notification_hours = (int)$early_notification; // Rendo la variabile un intero

// Dettagli del db
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "gdpr_database";
$tableName = "event_typologies";

if (!empty($name) || !empty($priority) || !empty($early_notification) || !empty($repeat_interval)) {
	
    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
    if (mysqli_connect_error()) { // connessione fallita
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{ // connessione ha successo
      $INSERT = "insert into $tableName (et_name, et_priority, et_early_notification, et_event_repeat, et_color) values(?, ?, ?, ?, ?)";
      // Prepare statement
      $stmt = $conn->prepare($INSERT); // Prepariamo per INSERT
      $stmt->bind_param('siiss', $name, $priority, $early_notification_hours, $repeat_interval, $typology_color);
      $stmt->execute();
      $stmt->close();
      $conn->close();
      echo "<h1>Event Typology Recap</h1><p>New event typology has been correctly created.</p><p>Event Typology Name : <em>$_POST[name]</em></p><p>Event Priority : $_POST[priority]</p><p>Early Notification: $early_notification_hours hours before</p><p>Event repetition: $repeat_interval</p>";
        }
	
}else{ // se le variabili sono vuote
 echo "All field are required";
 die();
}

?>