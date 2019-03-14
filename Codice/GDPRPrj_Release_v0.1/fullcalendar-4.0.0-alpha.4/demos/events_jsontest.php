<!-- Il seguente script php, dopo aver testato la connessione ad un db, estrae i dati da una tabella del db e li passa ad uno script JavaScript
che li "compatta" in un unico array e li invia ad una pagina html visualizzabile da fullcalendar.
Autore: Pellizzari Luca  -->

<?php
    session_start();
    if(!isset($_SESSION['username'])){
      header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
  }
?>

<?php

$link = mysqli_connect("localhost", "root", "", "gdpr_database");

$tableName = "events"; // nome della tabella da cui estrarre i dati

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Estraggo i dati dalla tabella
$query = "select $tableName.e_name, $tableName.e_date_from, $tableName.e_date_to, et.et_color from $tableName join event_typologies et on $tableName.e_typology = et.et_id";
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

<script type="text/javascript">
	// pass PHP array to JavaScript 
	var eventsTemp = <?php echo json_encode($eventsArray, JSON_PRETTY_PRINT) ?>;
	
	function Event(title, start, end, color){
		this.title = title;
		this.start = start;
		this.end = end;
		this.color = color;
	}
	
	var events = new Array();
	
	for(var i = 0; i < eventsTemp.length; i+=4){
		events.push(new Event(eventsTemp[i], eventsTemp[i+1], eventsTemp[i+2], eventsTemp[i+3]));
	}

	// how to access 
	console.log( events );
</script>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='../dist/fullcalendar.css' rel='stylesheet' />
<script src='../dist/fullcalendar.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek' // per la lista degli eventi della settimana
      },
      defaultDate: Date.now(),
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events
    });

    calendar.render();
  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
</head>
<body>

  <div id='calendar'></div>

</body>
</html>
