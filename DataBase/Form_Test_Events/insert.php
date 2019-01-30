<!-- Il seguente script php, riceve i dati da un form html e dopo aver testato la connessione con un db esegue una query
per inserire i dati in una tabella del db -->
<?php

// Salviamo i dati che ci arrivano dal form html in variabili php
$name = $_POST['name']; // va passato il valore dell'attributo "name" del file html che contiene quel dato
$typology = $_POST['typology'];
$description = $_POST['description'];
$dateFrom = $_POST['date_from'];
$dateTo = $_POST['date_to'];
$class = $_POST['class'];
$state = $_POST['state'];
$notes = $_POST['notes']; // puo essere null
$participants = $_POST['participants']; // puo essere null
$actualStart = $_POST['actual_start']; // puo essere null
$actualEnd = $_POST['actual_end']; // puo essere null

// Dettagli del db
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "gdpr_database";
$tableName = "events";

if (!empty($name) || !empty($typology) || !empty($description) || !empty($dateFrom) || !empty($dateTo) || !empty($class) || !empty($state)) {
	
    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
    if (mysqli_connect_error()) { // connessione fallita
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{ // connessione ha successo
      $INSERT = "insert into $tableName (e_name, e_typology, e_description, e_date_from, e_date_to, e_class, e_state, e_notes, e_participants, e_actual_start, e_actual_end) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      // Prepare statement
      $stmt = $conn->prepare($INSERT); // Prepariamo per INSERT
      $stmt->bind_param("sisssssssss", $name, $typology, $description, $dateFrom, $dateTo, $class, $state, $notes, $participants, $actualStart, $actualEnd);
      $stmt->execute();
      $stmt->close();
      $conn->close();
	  echo "New record inserted sucessfully";
    }
	
}else{ // se le variabili sono vuote
 echo "All field are required";
 die();
}

?>