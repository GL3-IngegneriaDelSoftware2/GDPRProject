<?php

// Pagina che verifica i dati inseriti durante la registrazione e durante il login
// Autore: Pellizzari Luca

session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'gdpr_database');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE u_username='$username' OR u_email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['u_username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['u_email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1); // encrypt the password before saving in the database

  	$query = "INSERT INTO users (u_username, u_email, u_password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) { // se non ci sono errori nel login
  	$password = md5($password); // cifro la password per vedere se coincide con quella nel db (che e' cifrata)
  	$query = "SELECT * FROM users WHERE u_username='$username' AND u_password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) { // se il risultato della query ha una riga -> un utente
  	  $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";

      include 'temp.php';
      $_SESSION['hiddenNotifications'] = [];
  	  header('location: ../Homepage.php'); // vado in questa pagina
  	} else { // altrimenti scrivo sulla pagina corrente il seguente messaggio d'errore
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>