<!-- 
  This file contains all the markup and logic of the homepage
  Author: Pellizzari Luca
-->
<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Questo file contiene la home page dell'applicazione web da consegnare all'Accademia delle Belle Arti di Udine, per poter utilizzare le funzionalita
disponibili da questa pagina e' necessario aver effettuato il login al sito (e la registrazione utente se necessario).
Autore: Pellizzari Luca -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="lib/javascript/notifications.js"></script>
<script type="text/javascript" src="lib/javascript/sweetalert_functions.js"></script>
<script type="text/javascript" scr="lib/javascript/jquery_functions.js"></script>

<head>
  <title>Accademia delle Belle Arti - Udine</title>
  <link rel="shortcut icon" href="ABAico.ico" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="Homepage.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Per la freccia nel bottone dropdown -->
  <style>
    .notif {
      padding: 10px;
      border-radius: 15px;
      border: 3px solid black;
      margin-top: 10px;
      padding: 0px, 10px, 0px, 0px;
      width: 100%;
      height: 100%;
    }

    .notif span {
      font-size: 12px;
      cursor: pointer;
      border: 1px solid black;
      border-radius: 5px;
      margin: 2px;
      padding: 4px;
      transition: 0.5s;
    }

    span:hover {
      background-color: rgba(255, 255, 255, 0.6);
      color: black;
      transition: 0.5s;
      box-shadow: 0 0 7px white;
    }
  </style>
<body>

  <div class="header">
    <h1>Accademia delle Belle Arti di Udine</h1>
    <img src="BelleArtiUd.png" alt="Logo Accademia delle Belle Arti">
    <p>A website created by GL3</p>
  </div>

  <div class="navbar">
	<a href="#">Home</a>
    <a href="events/events_form.php">Nuovo Evento</a>
    <a href="event_typologies/event_typologies_form.php">Nuova Tipologia di Evento</a>
	<div class="dropdown">
	  <button class="dropbtn" onclick="myFunction()">Segnalazioni
		<i class="fa fa-caret-down"></i>
	  </button>
	  <div class="dropdown-content" id="myDropdown">
		<a href="#">Richiesta Esercizio Diritti</a>
		<a href="#">Data Breach</a>
	  </div>
	</div>
	
	<script>
	/* When the user clicks on the button, 
	toggle between hiding and showing the dropdown content */
	function myFunction() {
	  document.getElementById("myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(e) {
	  if (!e.target.matches('.dropbtn')) {
	  var myDropdown = document.getElementById("myDropdown");
		if (myDropdown.classList.contains('show')) {
		  myDropdown.classList.remove('show');
		}
	  }
	}
	</script>

    <?php
    if (isset($_SESSION['username'])) {
      echo "<a href=\"registration/index.php?logout='1'\" class=\"right\">Logout</a> <!-- Effettuo il logout passando per il file registration/index.php -->";
      echo "<a class=\"right\">$_SESSION[username]</a>";
    } else {
      echo "<a href=\"registration/registration_login.php\" class=\"right\">Login</a> <!-- Da nascondere in base al valore session, passare per JS?-->";
    }
    ?>

  </div>

  <div class="row">
    <div class="side">
      <!-- Lato sinistro dello schermo, sotto l'header -->
      <div class="notif-section">
        <h2>Sezione notifiche</h2>
        <?php
        include 'lib/PHP/notifications_helper.php';
        $events = getLastNotifications();
        foreach ($events as $event) {
          if ($event['priority'] < 4) {
            echo "<div class='notif' style='border-color: $event[color]; background-color: $event[second_color];'>";
            echo "<h4>$event[name]</h4>";
            echo "<p>$event[description]</p>";
            if ($event['priority'] < 2) {
              echo "<span class='btn' onclick='close_notification(this, $event[id])' style='border: 1px solid $event[color];'>Chiudi</span>";
            }
            if ($event['priority'] > 0) {
              echo "<span class='btn' onclick='hide_notification(this, $event[id])' style='border: 1px solid $event[color];'>Nascondi</span>";
            }
            echo "</div>";
          }
        }
        ?>
      </div>
    </div>
    <div class="main">
      <!-- Parte centrale dello schermo, sotto l'header -->
      <h2>Sezione Eventi</h2>
      <button onclick="midHighNotif()">Try Mid High Notification</button>
      <button onclick="highNotif()">Try High Notification</button>
      <h3>Vai al calendario: <a href="fullcalendar-4.0.0-alpha.4/demos/events_jsontest.php">Link calendario</a></h3>

      <h3>Lista eventi del mese:</h3>
      <?php
        getLastEvents();
        ?>

    </div>
  </div>

  <div class="footer">
    <h2>Page Footer</h2>
    <p id="spoiler" hidden>
    Test functions from php go here
    <br><br>
        <?php
        print_r($_SESSION);
        ?>
      </p>
  </div>

</body>

</html>