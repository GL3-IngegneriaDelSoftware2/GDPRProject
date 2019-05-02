<?php

// This file contains the form for the creation of new event typologies
//
// Author: Pellizzari Luca
    session_start();
    if(!isset($_SESSION['username'])){
      header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
  }
?>
<!DOCTYPE HTML>
<html>
<!-- Il file php contiene un form da cui l'utente puo inserire i dati relativi ad una nuova tipologia di evento nella tabella del database 
che contiene le tipologie di evento. I dati inseriti nel form vengono mandati ad un file php che tramite una query li inserisce nel database.
Autore: Baradel Luca -->
<link href="event_typologies_form.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
  <title>Nuova Tipologia di Evento</title>
  <script>

    // Di queste funzioni verra' fatta una libreria
    function printPriority(){
      var priority = document.getElementById("priority").value;
      var literalPriority = "";
      switch (priority) {
        case "1": literalPriority = "Bassa";
          break;
        case "2": literalPriority = "Medio - Bassa";
          break;
        case "3": literalPriority = "Media";
          break;
        case "4": literalPriority = "Medio - Alta";
          break;
        case "5": literalPriority = "Alta";
          break;
        default: literalPriority = "Non Selezionata";
          break;
      }
      document.getElementById("print-priority").innerHTML = literalPriority;
    }
  </script>
</head>
<body>

<div class="event-typology-form">

 <form action="event_typologies_insert.php" method="POST"> <!-- I dati inseriti nel form vengono mandati al file specificato in questa riga che si occupa
 di inserire i dati tramite query al database -->
 
 <h4><p>Compila il form per inserire una nuova tipologia di evento (* alcuni campi sono obbligatori):</p></h4>

  <table>
   <tr>
    <td>Nome della tipologia (*) :</td>
    <td><input type="text" name="name" required placeholder="Inserisci un nome per la nuova tipologia di evento"></td>
   </tr>

   <tr>
    <td>Priorità (*) :</td>
    <td><input type="range" min="1" max="5" id="priority" name="priority" required onmouseup="printPriority()"> 
    </td>
	<td><span id="print-priority">Non Selezionata</span></td>
   </tr>

   <tr>
    <td>Notifica preventiva (ore) (*) :</td>
    <td><input type="number" name="early_notification" value="1" min="0" max="168" required></td>
   </tr>

   <tr>
    <td>Ripetizione dell'evento (*) :</td>
    <td><label for="repeat-select">
      <select id="repeat-select" name="repeat_interval" required>
        <option value="">-- Seleziona il tipo di ripetizione --</option>
        <option value="no-repeat">Non ripetere</option>
        <option value="daily">Giornaliero</option>
        <option value="weekly">Settimanale</option>
        <option value="monthly">Mensile</option>
        <option value="yearly">Annuale</option>
      </select>
    </label></td>
   </tr> 

   <tr>
     <td id="color-tag">Colore :</td>
     <td>
       <input type="color" name="typology_color" value="#FE840E">
     </td>
   </tr>

   <tr>
     <td><input type="submit" value="Crea Tipologia"></td>
    </tr>
  </table>
 </form>
 </div>
</body>
</html>
