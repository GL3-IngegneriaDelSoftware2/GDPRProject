<!DOCTYPE HTML>
<html>
<link href="form.css" rel="stylesheet" type="text/css">
<head>
  <title>Events Form</title>
</head>
<body>
<div>
 <form action="insert.php" method="POST"> <!-- mandiamo i dati inseriti nel form al file insert.php -->
  <table>
   <tr>
    <td>Name :</td>
    <td><input type="text" name="name" required></td>
   </tr>
   <tr>
    <td>Typology :</td>
    <td>
        <label for="typology-select">
            <select id="typology-select" name="typology">
                <option value="">--Select an event typology--</option>
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
  <td><a href="/event_typo/form.html"><input class="btn" type="button" value="Create new Event Typology"></a></td>
   </tr>
   <tr>
    <td>Description :</td>
    <td><input type="text" name="description" required></td>
   </tr>
   <tr>
    <td>Date from :</td>
    <td><input type="date" name="date_from" required></td>
   </tr> 
   <tr>
    <td>Date to :</td>
    <td><input type="date" name="date_to" required></td>
   </tr>
   <tr>
    <td>Class :</td>
    <td><input type="text" name="class" required></td>
   </tr>
   <tr>
    <td>State :</td>
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