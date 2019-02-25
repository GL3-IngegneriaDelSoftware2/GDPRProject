<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: registration_login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: registration_login.php");
  }
?>
<!DOCTYPE html>
<html>
<!-- Pagina che segue la pagina del login: da il benvenuto all'utente chiamandolo con il suo username.
Autore: Pellizzari Luca  -->
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="registration_style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<!-- <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p> -->
		<p> <a href="../Homepage.php">Home Page </a> </p> <!-- Temporaneo LucaP -->
    <?php endif ?>
</div>
		
</body>
</html>