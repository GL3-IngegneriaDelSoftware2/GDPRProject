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
<!-- This file contains the homepage of the application. Login is needed to have access to this section.
Author: Pellizzari Luca -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="lib/javascript/notifications.js"></script>
<script type="text/javascript" src="lib/javascript/sweetalert_functions.js"></script>
<script type="text/javascript" src="lib/javascript/jquery_functions.js"></script>
<script src='fullcalendar-4.0.0-alpha.4/dist/fullcalendar.js'></script>

<head>
  <title>Accademia delle Belle Arti - Udine</title>
  <link rel="shortcut icon" href="lib/images/ABAico.ico" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="Homepage.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Per la freccia nel bottone dropdown -->
  <link href='fullcalendar-4.0.0-alpha.4/dist/fullcalendar.css' rel='stylesheet' />

<body>

  <div class="header">
    <h1>Accademia delle Belle Arti di Udine</h1>
    <img src="lib/images/BelleArtiUd.png" alt="Logo Accademia delle Belle Arti">
    <p>A website created by GL3</p>
  </div>

  <div class="navbar">
	<a href="#">Home</a>
	<div class="dropdown">
	  <button class="dropbtn" onclick="myDropdownFunction()">Segnalazioni
		<i class="fa fa-caret-down"></i>
	  </button>
	  <div class="dropdown-content" id="myDropdown">
		<a href="#">Richiesta Esercizio Diritti</a>
		<a href="#">Data Breach</a>
	  </div>
	</div>	
	<script src="lib/javascript/dropdown_helper.js"></script> <!-- to use the dropdown button -->
    <a href="events/events_form.php">Nuovo Evento</a>
    <a href="event_typologies/event_typologies_form.php">Nuova Tipologia di Evento</a>
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
      <!-- Left side under the header -->
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
            if ($event['priority'] < 3) {
              echo "<span class='btn' onclick='close_notification(this, $event[id])' style='border: 1px solid $event[color];'>Chiudi</span>";
            }
            if ($event['priority'] > 1) {
              echo "<span class='btn' onclick='hide_notification(this, $event[id])' style='border: 1px solid $event[color];'>Nascondi</span>";
            }
            echo "</div>";
          }
        }
        ?>
      </div>
    </div>
    <div class="main">
      <!-- Central section of page -->
	  <?php include 'lib/PHP/fullcalendar_helper.php'; ?> <!-- prendo gli eventi dal db -->
	  <script>
		var eventsTemp = <?php echo json_encode($eventsArray, JSON_PRETTY_PRINT) ?>; // pass PHP array with events to JavaScript 
	  </script>
	  <script src="lib/javascript/fullcalendar_helper.js"></script> <!-- trasformo l'array di eventi ricevuto da php in un array js leggibile da fullcalendar -->
	  <div id="calendar" style="padding: 10px">
	  </div>
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