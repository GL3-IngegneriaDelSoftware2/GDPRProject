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

<head>
    <title>Accademia delle Belle Arti - Udine</title>
    <link rel="shortcut icon" href="ABAico.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="Homepage.css">
    <style>
        .notif {
            padding: 10px;
            border-radius: 10px;
            border: 1.5px solid black;
            margin-top: 5px;
            padding: 0px, 10px, 0px, 0px;
            width: 100%;
            height: 100%;
        }

        .notif-button {
            font-size: 12px;
            height: 25px;
            width: 60px;
            align: center;
            cursor: pointer;
            border: 1px solid black;
            border-radius: 2px;
            margin: 2px;
            padding: 4px;
        }

        .notif-button:hover{
            background-color: #666;
            color: white;
            transition: 0.5s;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        function close_notification(object) {
            $(object.parentElement).slideUp();
        }

        function postpone_notification(object) {
            $(object.parentElement).slideUp();
        }

    </script>
    <script>
    function midHighNotif(){
          Swal.fire({
            titleText: 'Evento con Medio-alta Priorità!',
            text: "Questo evento ha priorità media. Risolvilo al più presto!",
            type: "info",
            footer: "Uscire dall'evento lo riproporrà al prossimo accesso o visita",
            confirmButtonText: "Risolvi evento",
            showCancelButton: true,
            cancelButtonText: 'Posponi notifica',
            confirmButtonColor: '#1abc9c'
          })
        }

        function highNotif() {
            Swal.fire({
                titleText: 'Evento Alta Priorità!',
                text: "Evento ad alta priorità, risolvilo ora dio cane!",
                confirmButtonText: 'Solve Event Now',
                allowOutsideClick: false,
                type: "warning",
                footer: "Uscire dalla pagina o ricaricari non serve a un cazzo, io tornerò.",
                confirmButtonText: "Risolvi evento ora",
                confirmButtonColor: '#1abc9c'
            })
        }

        function toastNotif() {
            Swal.fire({
                toast: true,
                showConfirmButton: false,
                timer: 2000,
                title: "Evento creato!",
                html: "<p>L'evento <strong>Riunione</strong> è stato creato correttamente</p>",
                type: "success",
                position: "top-end"

            })
        }
    </script>

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
                include 'temp.php';
                $events = getLastTenNotifications();
                foreach ($events as $event) {
                  if ($event['priority'] < 4) {
                    echo "<div class='notif' style='border-color: $event[color]'>";
                    echo "<h4>$event[name] -> $event[priority]</h4>";
                    echo "<p>$event[description]</p>";
                    if ($event['priority'] < 2) {
                      echo "<p class='notif-button' onclick='close_notification(this)'>Chiudi</p>";
                    }
                    if ($event['priority'] > 0) {
                      echo "<p class='notif-button' onclick='postpone_notification(this)'>Posponi</p>";
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

            <!-- <br> <!-- line break/carriage return -->

            <h3>Vai al calendario: <a href="fullcalendar-4.0.0-alpha.4/demos/events_jsontest.php">Link calendario</a></h3>

            <!-- <br> <!-- line break/carriage return -->
            <button onclick="midHighNotif()">Try Mid High Notification</button>
            <button onclick="highNotif()">Try High Notification</button>
            <button onclick="toastNotif()">Try Toast Notification</button>
            
            <h3>Lista eventi del mese:</h3>
            <?php
            getLastEvents();
            ?>

        </div>
    </div>

    <div class="footer">
        <h2>Page Footer</h2>
    </div>

</body>

</html> 