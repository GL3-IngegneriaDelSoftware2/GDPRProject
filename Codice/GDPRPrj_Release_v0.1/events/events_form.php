<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
    }
?>
<!DOCTYPE HTML>
<html>
<!-- Il file php contiene un form da cui l'utente puo inserire i dati relativi ad un nuovo evento nella tabella del database 
che contiene gli eventi. I dati inseriti nel form vengono mandati ad un file php che tramite una query li inserisce nel database.
Autore: Pellizzari Luca -->
<link href="events_form.css" rel="stylesheet" type="text/css">
<head>
  <title>Events Form</title>
</head>
<body>
<div>
 <form action="events_insert.php" method="POST"> <!-- mandiamo i dati inseriti nel form al file insert.php -->
 <p>Fill the form to insert a new event (* some fields are required):</p>
  <table>
   <tr>
    <td>Name (*) :</td>
    <td><input type="text" name="name" required></td>
   </tr>
   <tr>
    <td>Typology (*) :</td>
    <td>
        <label for="typology-select">
            <select id="typology-select" name="typology">
                <option value="">-- Select an event typology --</option>
                    <?php
                        $link = mysqli_connect("localhost", "root", "", "gdpr_database");
                        $tableName = "event_typologies"; // nome della tabella da cui estrarre i dati

                        /* check connection */
                        if (mysqli_connect_errno()) {
                            printf("Connect failed: %s\n", mysqli_connect_error());
                            exit();
                        }

                        $typologies = mysqli_query($link, "SELECT * FROM $tableName");
                        while($row = mysqli_fetch_array($typologies)){
                            
                            echo "<option value=\"$row[et_id]\">$row[et_name]</option>"; // nome della colonna
                        }
                    ?>
            </select>
        </label>
  </td>
  <td><a href="../event_typologies/event_typologies_form.php"><input class="btn" type="button" value="Create new Event Typology"></a></td> <!-- I dati inseriti
  nel form vengono mandati al file specificato in questa riga che si occupa di inserire i dati tramite query al database -->
   </tr>
   <tr>
    <td>Description (*) :</td>
    <td><input type="text" name="description" required></td>
   </tr>
   <tr>
    <td>Date from (*) :</td>
    <td><input type="date" name="date_from" required></td>
   </tr> 
   <tr>
    <td>Date to (*) :</td>
    <td><input type="date" name="date_to" required></td>
   </tr>
   <tr>
    <td>Class (*) :</td>
    <td><input type="text" name="class" required></td>
   </tr>
   <tr>
    <td>State (*) :</td>
    <td><input type="text" name="state" required></td>
   </tr>
   <tr>
    <td>Notes :</td>
    <td><input type="text" name="notes"></td>
   </tr>
   <tr>
    <td>Participants :</td>
    <td><input type="text" name="participants"></td>
   </tr> 
   <tr>
    <td>Actual start :</td>
    <td><input type="date" name="actual_start"></td>
   </tr>
   <tr>
    <td>Actual end :</td>
    <td><input type="date" name="actual_end"></td>
   </tr>
   <tr>
    <td><input class="btn" type="submit" value="Create Event"></td>
   </tr>
  </table>
 </form>
 </div>
</body>
</html>