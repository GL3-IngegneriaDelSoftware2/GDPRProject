<?php

// This file contains the form for the creation of events
//
// Author: Pellizzari Luca
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
    }
?>
<!DOCTYPE HTML>
<html lang="en">
<!-- Il file php contiene un form da cui l'utente puo inserire i dati relativi ad un nuovo evento nella tabella del database 
che contiene gli eventi. I dati inseriti nel form vengono mandati ad un file php che tramite una query li inserisce nel database.
Autore: Pellizzari Luca -->
<head>
  <title>Nuovo evento</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="shortcut icon" href="lib/images/ABAico.ico" type="image/x-icon">
  <link href="events_form.css" rel="stylesheet" type="text/css">
</head>
<body>
<div>
 <form action="events_insert.php" method="POST" id="event-form"> <!-- mandiamo i dati inseriti nel form al file insert.php -->
   <?php 
	// Se sono in fase di update di un evento precompilo i campi dell'evento 
	//$temp_id = $_POST['user'];
	 if(isset($temp_id)){
		 $event_details_query = "SELECT * FROM events WHERE events.e_id = '$temp_id'";
		 $db = mysqli_connect('localhost', 'root', '', 'gdpr_database');
		 $result = mysqli_query($db, $event_details_query); // risultato della query
		 $event_details = mysqli_fetch_assoc($result);
		 $_SESSION['event_details'] = $event_details;
	 } 
 ?>
 <h4><p>Compila il form per inserire un nuovo evento (* alcuni campi sono obbligatori):</p></h4>
  <table>
   <tr>
    <td>Nome (*) :</td>
    <td><input type="text" name="name" required value="<?php if(isset($_SESSION["event_details"])){$text = $_SESSION["event_details"]["e_name"]; echo "$text";} ?>"></td>
   </tr>
   <tr>
    <td>Tipologia (*) :</td>
    <td>
        <label for="typology-select">
            <select id="typology-select" name="typology">
                <option value="">-- Seleziona una Tipologia di Evento --</option>
                    <?php
                        $link = mysqli_connect("localhost", "root", "", "gdpr_database");
                        $tableName = "event_typologies"; // nome della tabella da cui estrarre i dati

                        /* check connection */
                        if (mysqli_connect_errno()) {
                            printf("Connect failed: %s\n", mysqli_connect_error());
                            exit();
                        }

                        $typologies = mysqli_query($link, "SELECT * FROM $tableName where $tableName.et_id != 4");
                        while($row = mysqli_fetch_array($typologies)){
                            
                            echo "<option value=\"$row[et_id]\">$row[et_name]</option>"; // nome della colonna
                        }
                    ?>
            </select>
        </label>
  </td>
  <td><a href="../event_typologies/event_typologies_form.php"><input class="btn" type="button" value="Crea Nuova Tipologia"></a></td> <!-- I dati inseriti
  nel form vengono mandati al file specificato in questa riga che si occupa di inserire i dati tramite query al database -->
   </tr>
   <tr>
    <td>Descrizione (*) :</td>
    <td><textarea name="description" required form="event-form" cols="50" rows="3"></textarea>
   </tr>
   <tr>
    <td>Dal giorno (*) :</td>
    <td><input type="date" name="date_from" required value="<?php if(isset($_SESSION["event_details"])){$text = $_SESSION["event_details"]["e_date_from"]; $time = strtotime($text); $newformat = date('Y-m-d',$time);
	echo "$newformat";} ?>"></td> 
    <td><input type="time" name="time_from" required value="08:00"></td>
   </tr> 
   <tr>
    <td>Al giorno (*) :</td>
    <td><input type="date" name="date_to" required value="<?php if(isset($_SESSION["event_details"])){$text = $_SESSION["event_details"]["e_date_to"]; $time = strtotime($text); $newformat = date('Y-m-d',$time);
	echo "$newformat";} ?>"></td>
    <td><input type="time" name="time_to" required value="08:00"></td>
   </tr>
   <tr>
    <td>Note :</td>
    <td><textarea name="notes" form="event-form" cols="50" rows="3"></textarea>
   </tr>
   <tr>
        <td>Partecipanti (*) : <br><br> <strong>Ctrl + click</strong> <br> seleziona più utenti<br>
        <strong>Ctrl + A</strong> <br> seleziona tutti gli utenti</td>
		<td>
			<label for="participants-select">
				<select multiple="multiple" id="participants-select" name="participants[]" size="3" required> <!-- mettendo le quadre automaticamente produco un array -->
						<?php
							$link = mysqli_connect("localhost", "root", "", "gdpr_database");
							$tableName = "users"; // nome della tabella da cui estrarre i dati

							/* check connection */
							if (mysqli_connect_errno()) {
								printf("Connect failed: %s\n", mysqli_connect_error());
								exit();
							}

							$users = mysqli_query($link, "SELECT * FROM $tableName");
							while($row = mysqli_fetch_array($users)){
								
								echo "<option value=\"$row[u_id]\">$row[u_username]</option>"; // nome della colonna
							}
						?>
				</select>
			</label>
	    </td>
   </tr> 
   <tr>
    <td>Inizio effettivo :</td>
    <td><input type="date" name="actual_start"></td>
    <td><input type="time" name="actual_time_from" value="08:00"></td>
   </tr>
   <tr>
    <td>Termine effettivo :</td>
    <td><input type="date" name="actual_end"></td>
    <td><input type="time" name="actual_time_to" value="08:00"></td>
   </tr>
   <tr>
    <td><input class="btn" type="submit" value="<?php if(isset($_SESSION["event_details"])){$text = "Aggiorna Evento"; echo "$text";}else{$text = "Crea Evento"; echo "$text";} ?>"></td>
   </tr>
  </table>
 </form>
 </div>
</body>
</html>
