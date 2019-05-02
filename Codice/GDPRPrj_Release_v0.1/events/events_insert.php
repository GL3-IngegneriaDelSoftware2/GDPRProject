<!-- -->
<?php

// This file receives the details from the events form and validates the event (non-duplicated, presence of fields etc.) then stores the event in the DB.
//
// Author: Pellizzari Luca

// Salviamo i dati che ci arrivano dal form html in variabili php
$name = $_POST['name']; // va passato il valore dell'attributo "name" del file html che contiene quel dato
$typology = $_POST['typology'];
$description = $_POST['description'];
$dateFrom = $_POST['date_from'];
$dateTo = $_POST['date_to'];
$class = "Task"; // l'utente puo inserire solo Task, gli Event dovrebbero essere inseriti automaticamnte dal sistema
$participants = implode(";", $_POST['participants']); // id degli utenti (separati da ";") a cui sara mostrata la notifica dell'evento
$state = $participants; // come sopra, poi quando un utente risolve la notifica da $state viene tolto il suo id
$notes = $_POST['notes']; // puo essere null
$actualStart = $_POST['actual_start']; // puo essere null
$actualEnd = $_POST['actual_end']; // puo essere null

// Dettagli del db a cui fare la query
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "gdpr_database";
$tableName = "events";

// Controllo se i campi ricevuti dal form (che dovranno essere != NULL hanno un valore)
if(!empty($name) || !empty($typology) || !empty($description) || !empty($dateFrom) || !empty($dateTo) || !empty($class) || !empty($state) || !empty($participants)){
    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
    if(mysqli_connect_error()){ // connessione fallita
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{ // connessione ha successo
	  // Query per controllare che il nome dell'evento non sia gia presente nel db
	  $event_check_query = "SELECT * FROM $tableName WHERE $tableName.e_name = '$name' LIMIT 1";
	  $db = mysqli_connect('localhost', 'root', '', 'gdpr_database');
	  $result = mysqli_query($db, $event_check_query); // risultato della query
	  $event = mysqli_fetch_assoc($result);
	  if ($event){ // evento con stesso nome gia presente nel db
		if ($event['e_name'] === $name){
		  echo "<p>Esiste già un evento con lo stesso nome, per favore scegliere un nome diverso.</p>"; // messaggio per l'utente
		}
	  }else{ // evento non presente
		$INSERT = "INSERT into $tableName (e_name, e_typology, e_description, e_date_from, e_date_to, e_class, e_state, e_notes, e_participants, e_actual_start, e_actual_end) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // Prepare statement
        $stmt = $conn->prepare($INSERT); // Prepariamo per INSERT
        $stmt->bind_param("sisssssssss", $name, $typology, $description, $dateFrom, $dateTo, $class, $state, $notes, $participants, $actualStart, $actualEnd);
        $stmt->execute();
        $stmt->close();
        $conn->close();
	    echo "<h1>Riepilogo Evento</h1><p>L'evento è stato inserito correttamente.</p><p>Nome Evento : <em>$name</em></p><p>Descrizione : $description</p><p>Dal giorno : $dateFrom</p><p>Al giorno : $dateTo</p>";
	  }
	}
}else{ // se le variabili sono vuote
 echo "Per favore inserire un valore per tutti i campi del form segnati con un asterisco.";
 die();
}

?>
