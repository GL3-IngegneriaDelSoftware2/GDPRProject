<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
    }
?>
<!DOCTYPE HTML>
<html lang="en">
<!-- Il file php contiene un form da cui l'utente puo inserire i dati relativi ad una potenziale violazione della privacy nella tabella del database 
che contiene gli eventi. I dati inseriti nel form vengono mandati ad un file php che tramite una query li inserisce nel database.
Autore: Pellizzari Luca -->
<link href="databreach_form.css" rel="stylesheet" type="text/css">
<head>
  <title>Databreach</title>
</head>
<body>
<div>
 <form action="databreach_insert.php" method="POST" id="event-form"> <!-- mandiamo i dati inseriti nel form al file insert.php -->
 <h4><p>Fill the form to insert a potentially privacy violation (* some fields are required):</p></h4>
  <table>
   <tr>
    <td>Description (*) :</td>
    <td><textarea name="description" required form="event-form" cols="50" rows="3"></textarea>
   </tr>
   <tr>
    <td>Date from (*) :</td>
    <td><input type="date" name="date_from" required></td>
   </tr> 
   <tr>
    <td>Notes :</td>
    <td><textarea name="notes" form="event-form" cols="50" rows="3"></textarea>
   </tr>
   <tr>
    <td>Participants (*) :</td>
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
    <td><input class="btn" type="submit" value="Send"></td>
   </tr>
  </table>
 </form>
 </div>
</body>
</html>
