<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<!-- Questo file contiene la home page dell'applicazione web da consegnare all'Accademia delle Belle Arti di Udine, per poter utilizzare le funzionalita
disponibili da questa pagina e' necessario aver effettuato il login al sito (e la registrazione utente se necessario).
Autore: Pellizzari Luca -->
<head>
<title>Accademia delle Belle Arti - Udine</title>
<link rel="shortcut icon" href="ABAico.ico" type="image/x-icon">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="Homepage.css">
</head>
<body>

<div class="header">
  <h1>Accademia delle Belle Arti di Udine</h1>
  <img src="BelleArtiUd.png" alt="Logo Accademia delle Belle Arti">
  <p>A website created by GL3</p>
</div>

<div class="navbar">
  <a href="events/events_form.php">Events Form</a>
  <a href="events/events_display.php">Display Events</a> <!-- TEMPORANEO solo per i test -->
  <a href="event_typologies/event_typologies_form.php">Event Typology Form</a>
  <a href="event_typologies/event_typologies_display.php">Display Event Typology</a> <!-- TEMPORANEO solo per i test -->

  <?php
  if(isset($_SESSION['username'])){
    echo "<a href=\"registration/index.php?logout='1'\" class=\"right\">Logout</a> <!-- Effettuo il logout passando per il file registration/index.php -->";
  }else{
    echo "<a href=\"registration/registration_login.php\" class=\"right\">Login</a> <!-- Da nascondere in base al valore session, passare per JS?-->";
  }
  ?>

</div>

<div class="row">
  <div class="side"> <!-- Lato sinistro dello schermo, sotto l'header -->
    <h2>Sezione notifiche</h2>
	<h4>Notifica 1</h4>
	<h4>Notifica 2</h4>
	<h4>Notifica 3</h4>
	<h4>Notifica 4</h4>
	<h4>Notifica 5</h4>
    <!-- <h5>Photo of me:</h5>
    <img src="BelleArtiUd.png" alt="Logo Accademia delle Belle Arti">
    <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
    <h3>More Text</h3>
    <p>Lorem ipsum dolor sit ame.</p>
    <div class="fakeimg" style="height:60px;">Image</div><br>
    <div class="fakeimg" style="height:60px;">Image</div><br>
    <div class="fakeimg" style="height:60px;">Image</div> -->
  </div>
  <div class="main"> <!-- Parte centrale dello schermo, sotto l'header -->
    <h2>Sezione Eventi</h2>
	
	<!-- <br> <!-- line break/carriage return -->
	
	<h3>Vai al calendario: <a href="#">Link calendario (da implementare)</a></h3>
	
	<!-- <br> <!-- line break/carriage return -->
	
	<h3>Lista eventi del mese:</h3>
    <?php


      $link = mysqli_connect("localhost", "root", "", "gdpr_database");
      $tableName = "events"; // nome della tabella da cui estrarre i dati

      /* check connection */
      if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

      $query = "SELECT * FROM $tableName ORDER BY e_date_from"; // Tutti gli eventi
      $dbResult = mysqli_query($link, $query);
      $today = date("Y-m-d");

      while($line = mysqli_fetch_array($dbResult, MYSQLI_NUM)){
        
        if($today <= $line[5]) {
          $stato = "In arrivo";
          if($today >= $line[4]) {
            $stato = "In corso";
          }
          $event_start = date_parse($line[4]);
          echo "<h3>$event_start[day]/$event_start[month]/$event_start[year]: $line[2] ($stato)</h3>\n<p>$line[3]</p>\nTermine: ";
          $event_end = date_parse($line[5]);
          echo "$event_end[day]/$event_end[month]/$event_end[year]";
          echo "<hr>";
        }
      }

    ?>
    
  </div>
</div>

<div class="footer">
  <h2>Page Footer</h2>
</div>

</body>
</html>
