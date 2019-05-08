<!-- Il seguente script php, dopo aver testato la connessione ad un db, estrae i dati da una tabella del db e li passa ad uno script JavaScript
che li "compatta" in un unico array e li invia ad una pagina html visualizzabile da fullcalendar.
Autore: Pellizzari Luca  -->

<?php

$link = mysqli_connect("localhost", "root", "", "gdpr_database");

$tableName = "events"; // nome della tabella da cui estrarre i dati

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Estraggo i dati dalla tabella
$query = "select events.e_name, events.e_date_from, events.e_date_to, et.et_color, et.et_event_repeat from events join event_typologies et on events.e_typology = et.et_id";
$dbResult = mysqli_query($link, $query); // risultato della query
$eventsArray = array(); // array di array di eventi

while($line = mysqli_fetch_array($dbResult, MYSQLI_NUM)){ // stampo tutte le righe: mysql_fetch_array restituisce l'i-esimo record e sposta in avanti il cursore
	
	$eventArray = array(); // array con i dati di un singolo evento
	$count = 0;
	
	foreach($line as $col_value){ // valori corrispondenti ad un record (ogni record del db occupa una riga della tabella)
			$eventArray[$count] = $col_value;
			$count++;
	} // foreach
	
	array_splice($eventsArray, 0, 0, $eventArray); // inserisco $eventArray dentro $eventsArray in prima posizione
	
} // end while

mysqli_free_result($dbResult);
mysqli_close($link);

?>
