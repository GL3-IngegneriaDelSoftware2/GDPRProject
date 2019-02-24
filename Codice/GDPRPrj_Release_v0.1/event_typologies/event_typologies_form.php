<?php
    session_start();
    if(!isset($_SESSION['username'])){
      header("location: /dashboard/GDPRPrj_Release_v0.1/registration/registration_login.php");
  }
?>
<!DOCTYPE HTML>
<html>
<link href="event_typologies_form.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
  <title>New Event Typology Form</title>
  <script>

    // Di queste funzioni verra' fatta una libreria
    function printPriority(){
      var priority = document.getElementById("priority").value;
      var literalPriority = "";
      switch (priority) {
        case "1": literalPriority = "Low";
          break;
        case "2": literalPriority = "Low-Mid";
          break;
        case "3": literalPriority = "Mid";
          break;
        case "4": literalPriority = "Mid-high";
          break;
        case "5": literalPriority = "High";
          break;
        default: literalPriority = "Not Set";
          break;
      }
      document.getElementById("print-priority").innerHTML = literalPriority;
    }
  </script>
</head>
<body>

<div class="event-typology-form">

 <form action="event_typologies_insert.php" method="POST">
 
 <p>Fill the form to insert a new event typology (* some fields are required):</p>

  <table>
   <tr>
    <td>Typology Name (*) :</td>
    <td><input type="text" name="name" required placeholder="Enter a name for event typology"></td>
   </tr>

   <tr>
    <td>Priority (*) :</td>
    <td><input type="range" min="1" max="5" id="priority" name="priority" required onmouseup="printPriority()">
      <span id="print-priority">Select a priority</span>
    </td>
   </tr>

   <tr>
    <td>Early Notification (hours) (*) :</td>
    <td><input type="number" name="early_notification" value="1" min="0" max="168" required></td>
   </tr>

   <tr>
    <td>Event Repeat (*) :</td>
    <td><label for="repeat-select">
      <select id="repeat-select" name="repeat_interval" required>
        <option value="">-- Select a repeat interval --</option>
        <option value="no-repeat">Don't repeat</option>
        <option value="daily">Daily</option>
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
        <option value="yearly">Yearly</option>
      </select>
    </label></td>
   </tr> 

   <tr>
     <td id="color-tag">Color tag :</td>
     <td>
       <input type="color" name="typology_color" value="#FE840E">
     </td>
   </tr>

   <tr>
     <td><input type="submit" value="Create Typology"></td>
    </tr>
  </table>
 </form>
 </div>
</body>
</html>
