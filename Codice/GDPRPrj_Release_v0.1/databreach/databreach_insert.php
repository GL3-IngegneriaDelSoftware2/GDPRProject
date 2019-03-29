<!-- Il seguente script php, riceve i dati da un form e dopo aver testato la connessione con un db esegue una query
per inserire i dati in una tabella del db.
Autore: Pellizzari Luca -->
<?php
// Salviamo i dati che ci arrivano dal form html in variabili php
// name, typology e class hanno valori fissi in quanto sappiamo gia che l'evento e' di tipo data breach
$name = "Data Breach";
$typology = 4; // la tipologia di evento "Segnalazione data breach" ha et_id = 4
$class = "Event";
// gli altri campi li prendo dal form
$description = $_POST['description'];
$dateFrom = $_POST['date_from'];
$date = DateTime::createFromFormat('Y-m-d', $dateFrom); // creo un oggetto di tipo date per poter sommare tre giorni a $dateFrom
$date2 = date_add($date, date_interval_create_from_date_string('3 days')); // sommo tre giorni (tempo massimo per chiudere la pratica data breach)
$dateTo = $date2->format('Y-m-d'); // riporto la data in formato stringa per la query
$notes = $_POST['notes']; // puo essere null
$participants = implode(";", $_POST['participants']); // id degli utenti (separati da ";") a cui sara mostrata la notifica della violazione
$state = $participants; // uguale, la violazione puo essere risolta da uno di questi utenti
$actualStart = $dateFrom;
$actualEnd = $dateTo;

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
	  echo "<h1>Event Recap</h1><p>New event has been correctly inserted.</p><p>Event Name : <em>$name</em></p><p>Event Description : $description</p><p>Event Date From : $dateFrom</p><p>Event Date To : $dateTo</p><p>Event Class : $class</p>";
    }
	
}else{ // se le variabili sono vuote
 echo "All field are required";
 die();
}

?>
