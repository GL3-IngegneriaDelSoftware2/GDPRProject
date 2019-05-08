<!-- Il seguente script php, riceve i dettagli relativi ad una tipologia da un form e dopo aver testato la connessione con un db, controlla che il 
nome della tipologia che si vuole inserire non sia gia presente nel db, in questo caso esegue una query per inserire i dati nella tabella event_typologies.
Se la tipologia e' gia presente stampa un messaggio che invita l'utente a scegliere un nome diverso.
Autore: Baradel Luca -->
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

if(!empty($name) && !empty($priority) && !empty($early_notification) && !empty($repeat_interval)){
    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
    if (mysqli_connect_error()) { // connessione fallita
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{ // connessione ha successo
	  // Query per controllare che il nome della tipologia non sia gia presente nel db
	  $typology_check_query = "SELECT * FROM $tableName WHERE et_name = '$name' LIMIT 1";
	  $db = mysqli_connect('localhost', 'root', '', 'gdpr_database');
	  $result = mysqli_query($db, $typology_check_query); // risultato della query
	  $typology = mysqli_fetch_assoc($result);
	  if ($typology){ // tipologia di evento con stesso nome gia presente nel db
		if ($typology['et_name'] === $name){
		  echo "<p>Esiste già una tipologia di evento con lo stesso nome, per favore scegliere un nome diverso.</p>"; // messaggio per l'utente
		}
	  }else{ // tipologia di evento non presente
		$INSERT = "INSERT into $tableName (et_name, et_priority, et_early_notification, et_event_repeat, et_color) values(?, ?, ?, ?, ?)";
		// Prepare statement
		$stmt = $conn->prepare($INSERT); // Prepariamo per INSERT
		$stmt->bind_param('siiss', $name, $priority, $early_notification_hours, $repeat_interval, $typology_color);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		echo "<h1>Riepilogo Tipologia</h1><p>Una nuova tipologia di evento è stata inserita correttamente.</p><p>Nome Tipologia : <em>$_POST[name]</em></p><p>Priorità : $_POST[priority]</p><p>Notifica di preavviso : $early_notification_hours ore prima</p><p>Ripetizione Evento : $repeat_interval</p>";
	  }
	}	
}else{ // se le variabili sono vuote
 echo "Per favore inserire un valore per tutti i campi del form segnati con un asterisco.";
 die();
}

?>