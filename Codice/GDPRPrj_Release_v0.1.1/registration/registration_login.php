<?php include('registration_server.php') ?>
<!DOCTYPE html>
<html>
<!-- Pagina da cui e' possibile effettuare il login dopo essersi registrati al sistema 
Autore: Pellizzari Luca -->
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" content-type="text/css" href="registration_style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="registration_login.php">
  	<?php include('registration_errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="registration_register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>