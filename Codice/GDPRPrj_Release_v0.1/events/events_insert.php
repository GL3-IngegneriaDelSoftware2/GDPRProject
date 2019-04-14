<!-- Il seguente script php, riceve i dettagli relativi ad un evento da un form e dopo aver testato la connessione con un db, controlla che il 
nome dell'evento che si vuole inserire non sia gia presente nel db, in questo caso esegue una query per inserire i dati nella tabella events.
Se l'evento e' gia presente stampa un messaggio che invita l'utente a scegliere un nome diverso.
Autore: Pellizzari Luca -->
<?php

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
	  $event_check_query = "select $tableName.e_name from $tableName where $tableName.e_name = '$name' LIMIT 1";
	  $db = mysqli_connect('localhost', 'root', '', 'gdpr_database');
	  $result = mysqli_query($db, $event_check_query); // risultato della query
	  if($result != FALSE){ // nome evento non presente nel db quindi posso inserirlo
		$INSERT = "insert into $tableName (e_name, e_typology, e_description, e_date_from, e_date_to, e_class, e_state, e_notes, e_participants, e_actual_start, e_actual_end) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // Prepare statement
        $stmt = $conn->prepare($INSERT); // Prepariamo per INSERT
        $stmt->bind_param("sisssssssss", $name, $typology, $description, $dateFrom, $dateTo, $class, $state, $notes, $participants, $actualStart, $actualEnd);
        $stmt->execute();
        $stmt->close();
        $conn->close();
	    echo "<h1>Event Recap</h1><p>New event has been correctly inserted.</p><p>Event Name : <em>$name</em></p><p>Event Description : $description</p><p>Event Date From : $dateFrom</p><p>Event Date To : $dateTo</p><p>Event Class : $class</p>";
	  }else{ // evento con lo stesso nome gia presente nel db
		echo "<p>An event with the same name already exist. Please choose another name for the event.</p>"; // messaggio per l'utente
	  }
	}
}else{ // se le variabili sono vuote
 echo "All field are required";
 die();
}

?>
