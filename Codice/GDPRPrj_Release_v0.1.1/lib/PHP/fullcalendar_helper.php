<!-- Il seguente script php, dopo aver testato la connessione ad un db, estrae i dati da una tabella del db e li passa ad uno script JavaScript
che li "compatta" in un unico array e li invia ad una pagina html visualizzabile da fullcalendar. Per gli utenti non amministratori vengono mostrati solo gli
eventi a cui partecipano.
Autore: Pellizzari Luca  -->

<?php

$link = mysqli_connect("localhost", "root", "", "gdpr_database");

$tableName = "events"; // nome della tabella da cui estrarre i dati

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Se l'utente non e' un amministratore devo mostrare solo i suoi eventi
$username = $_SESSION['username'];
$is_admin_query = "select u_is_admin, u_id from users u where u_username = '$username'";
$is_admin_result = mysqli_query($link, $is_admin_query);
$user_record = mysqli_fetch_assoc($is_admin_result);
mysqli_free_result($is_admin_result);

$query = "select events.e_name, events.e_date_from, events.e_date_to, et.et_color, et.et_event_repeat, events.e_participants from events join event_typologies et on events.e_typology = et.et_id";
$dbResult = mysqli_query($link, $query); // risultato della query

$eventsArray = array(); // array di array di eventi

while($line = mysqli_fetch_array($dbResult, MYSQLI_NUM)){ // stampo tutte le righe: mysql_fetch_array restituisce l'i-esimo record e sposta in avanti il cursore
	
	$eventArray = array(); // array con i dati di un singolo evento
	$count = 0;
	
	if($user_record['u_is_admin'] == true){ // utente admin, puo vedere tutti gli eventi
	
		foreach($line as $col_value){ // valori corrispondenti ad un record (ogni record del db occupa una riga della tabella)
				$eventArray[$count] = $col_value;
				$count++;
		} // foreach
		
		array_splice($eventsArray, 0, 0, $eventArray); // inserisco $eventArray dentro $eventsArray in prima posizione
	
	}else{ // utente non admin
		
		foreach($line as $col_value){ // valori corrispondenti ad un record (ogni record del db occupa una riga della tabella)
			if($count < 5){
				$eventArray[$count] = $col_value;
				$count++;
			}else{ // campo e_participants
				$e_participants = explode(";", $col_value);
				if(in_array($user_record['u_id'], $e_participants) ){ // utente fra i partecipanti
					array_splice($eventsArray, 0, 0, $eventArray); // tengo l'evento
				}
			}
		} // foreach		
	}
	
} // end while

mysqli_free_result($dbResult);
mysqli_close($link);

?>
