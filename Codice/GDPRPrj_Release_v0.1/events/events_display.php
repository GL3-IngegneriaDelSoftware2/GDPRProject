<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
    }
?>
<html>

<head>
	<title>Query di estrazione</title>
</head>

<body>

<!-- Il seguente script php, dopo aver testato la connessione ad un db, estrae i dati da una tabella del db e li stampa
su una tabella html creata dinamicamente che "riproduce" la tabella presente nel db mostrando tutti i suoi record 
(inclusa l'intestazione della tabella con i nomi di tutte le colonne).
Autore: Pellizzari Luca  -->

<?php

$link = mysqli_connect("localhost", "root", "", "gdpr_database");

$tableName = "events"; // nome della tabella da cui estrarre i dati

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Estraggo i nomi delle colonne
$columnNames = mysqli_query($link, "SHOW COLUMNS FROM $tableName");

print "<table border=\"1\">\n"; // inizio tabella

print "\t<tr>\n"; // inizio riga per i nomi delle colonne (tutti in una riga)

while($row = mysqli_fetch_array($columnNames)){
	
	print "\t\t<td>".$row['Field']."</td>\n"; // nome della colonna
	
}

print "\t</tr>\n"; // fine riga per i nomi delle colonne

mysqli_free_result($columnNames); // svuoto per effettuare una nuova query

// Estraggo i dati dalla tabella
$query = "select * from $tableName";
$dbResult = mysqli_query($link, $query); // risultato della query

while($line = mysqli_fetch_array($dbResult, MYSQLI_NUM)){ // stampo tutte le righe: mysql_fetch_array restituisce l'i-esimo record e sposta in avanti il cursore
	
	print "\t<tr>\n"; // inizio riga
	foreach($line as $col_value){ // valori corrispondenti ad un record (ogni record del db occupa una riga della tabella)
		print "\t\t<td>$col_value</td>\n"; // valore
	}
	print "\t</tr>\n"; // fine riga
	
} // end while

print "</table>\n"; // fine tabella

mysqli_free_result($dbResult);
mysqli_close($link);

?>

</body>

</html>