<?php

// This file receives the details from the events form and validates the event (presence of fields, correct dates, etc.) then stores the event in the DB.
//
// Author: Pellizzari Luca

session_start();
if(!isset($_SESSION['username'])){
	header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
}

// Salviamo i dati che ci arrivano dal form html in variabili php
$name = $_POST['name']; // va passato il valore dell'attributo "name" del file html che contiene quel dato
$typology = $_POST['typology'];
$description = $_POST['description'];
$dateFrom = $_POST['date_from'];
$timeFrom = $_POST['time_from'];
$dateTo = $_POST['date_to'];
$timeTo = $_POST['time_to'];
$class = "Task"; // l'utente puo inserire solo Task, gli Event dovrebbero essere inseriti automaticamnte dal sistema
$participants = implode(";", $_POST['participants']); // id degli utenti (separati da ";") a cui sara mostrata la notifica dell'evento
$state = $participants; // come sopra, poi quando un utente risolve la notifica da $state viene tolto il suo id
$notes = $_POST['notes']; // puo essere null
$actualStart = $_POST['actual_start']; // puo essere null
$actualTimeFrom = $_POST['actual_time_from']; // puo essere null
$actualEnd = $_POST['actual_end']; // puo essere null
$actualTimeTo = $_POST['actual_time_to']; // puo essere null
$flag_update = isset($_SESSION['event_details']['e_id']); // se i dettagli dell'evento sono nella variabile di sessione vuol dire che sto facendo un update

$dateFrom = $dateFrom ." ". $timeFrom;
$dateTo = $dateTo ." ". $timeTo;
$actualStart = $actualStart ." ". $actualTimeFrom;
$actualEnd = $actualEnd ." ". $actualTimeTo;

// Dettagli del db a cui fare la query
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "gdpr_database";
$tableName = "events";

// Validazione 1: Controllo se i campi ricevuti dal form (che dovranno essere != NULL hanno un valore)
if(!empty($name) && !empty($typology) && !empty($description) && !empty($dateFrom) && !empty($dateTo) && !empty($class) && !empty($state) && !empty($participants)){
    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	// Validazione 2: Controllo la connessione al database
    if(mysqli_connect_error()){ // connessione fallita
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{ // connessione ha successo
	  // Validazione 3: Controllo che dateFrom <= dateTo
	  $dateBegin = date('Y-m-d-h-m', strtotime($dateFrom));
      $dateEnd = date('Y-m-d-h-m', strtotime($dateTo));
	  if($dateBegin > $dateEnd){
		  echo "La data di inizio evento non può essere successiva alla data di fine evento.";
	  }else{
		// Controllo se devo fare un UPDATE o un INSERT
		if($flag_update){ // devo fare un update
			$event_to_change = $_SESSION['event_details']['e_id'];
			$UPDATE = "UPDATE $tableName 
			           SET e_name = ?, e_typology = ?, e_description = ?, e_date_from = ?, e_date_to = ?,
					   e_class = ?, e_state = ?, e_notes = ?, e_participants = ?, e_actual_start = ?, e_actual_end = ?
					   WHERE e_id = '$event_to_change'";
			// Prepare statement
			$stmt = $conn->prepare($UPDATE);
			$stmt->bind_param("sisssssssss", $name, $typology, $description, $dateFrom, $dateTo, $class, $state, $notes, $participants, $actualStart, $actualEnd);
			$stmt->execute();
			$stmt->close();
			$conn->close();
			echo "<h1>Riepilogo Evento</h1><p>L'evento è stato aggiornato correttamente.</p><p>Nome Evento : <em>$name</em></p><p>Descrizione : $description</p><p>Dal giorno : $dateFrom</p><p>Al giorno : $dateTo</p>";
		}else{ // devo fare un INSERT
			$INSERT = "INSERT into $tableName (e_name, e_typology, e_description, e_date_from, e_date_to, e_class, e_state, e_notes, e_participants, e_actual_start, e_actual_end) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			// Prepare statement
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sisssssssss", $name, $typology, $description, $dateFrom, $dateTo, $class, $state, $notes, $participants, $actualStart, $actualEnd);
			$stmt->execute();
			$stmt->close();
			$conn->close();
			echo "<h1>Riepilogo Evento</h1><p>L'evento è stato inserito correttamente.</p><p>Nome Evento : <em>$name</em></p><p>Descrizione : $description</p><p>Dal giorno : $dateFrom</p><p>Al giorno : $dateTo</p>";
		}
	  }
		  
	}
}else{ // se le variabili sono vuote
 echo "Per favore inserire un valore per tutti i campi del form segnati con un asterisco.";
 die();
}

?>
