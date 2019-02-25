<!-- Autore: Baradel Luca -->
<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Events Table</title>
	<script type="text/javascript">
		alert("Questa pagina è provvisoria, qua ci andrà il calendario. Eventualmente per aggiungere funzionalità: https://stackoverflow.com/questions/9351871/drop-down-menu-to-sort-query-results-on-a-php-page");
	</script>
	<link href="events_form.css" rel="stylesheet" type="text/css">
</title>

<body>
	<h1>Events Table</h1>
	<a href="events_form.php"><input class="btn" type="button" value="Create new Event"></a>
	<table>
		<thead>
			<tr>
				<td>Name</td>
				<td>Description</td>
				<td>Typology</td>
				<td>From</td>
				<td>To</td>
				<td>Class</td>
				<td>State</td>
				<td>Notes</td>
				<td>Participants</td>
				<td>Actual Start</td>
				<td>Actual End</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$link = mysqli_connect("localhost", "root", "", "gdpr_database");
				$tableName = "events"; // nome della tabella da cui estrarre i dati
													
				/* check connection */
				if (mysqli_connect_errno()) {
					printf("Connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				$query = "select * from $tableName";
				$dbResult = mysqli_query($link, $query); // risultato della query

				echo "<tr>";
											
				while($line = mysqli_fetch_array($dbResult)){ // stampo tutte le righe: mysql_fetch_array restituisce l'i-esimo record e sposta in avanti il cursore
					echo "<tr class=\"row100 body\">";
					echo "<td class=\"cell100 column1\">${line['e_name']}</td>";
					echo "<td class=\"cell100 column2\">${line['e_description']}</td>";
					echo "<td class=\"cell100 column3\">${line['e_typology']}</td>";
					echo "<td class=\"cell100 column4\">${line['e_date_from']}</td>";
					echo "<td class=\"cell100 column5\">${line['e_date_to']}</td>";
					echo "<td class=\"cell100 column6\">${line['e_class']}</td>";
					echo "<td class=\"cell100 column7\">${line['e_state']}</td>";
					echo "<td class=\"cell100 column8\">${line['e_notes']}</td>";
					echo "<td class=\"cell100 column9\">${line['e_notes']}</td>";
					echo "<td class=\"cell100 column10\">${line['e_actual_start']}</td>";
					echo "<td class=\"cell100 column11\">${line['e_actual_end']}</td>";
					echo "</tr>";
														
				} // end while
				
				mysqli_free_result($dbResult);
				mysqli_close($link);

				echo "</tr>";
			?>
		</tbody>
	</table>

</body>