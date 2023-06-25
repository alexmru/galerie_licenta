<!DOCTYPE html>
<html lang="ro">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="stylesheet" type="text/css" href="../styles/navbar.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,300&display=swap" rel="stylesheet">
	<title>Logare</title>
</head>

<body>
	<?php
	include '../reusable/navbar.php';
	?>
	<div class="center">
		<div class="login-form">
			<img class="logo" src="../media/logo.png">
			<form method="POST" action="login.php">
				<input type="text" name="username" placeholder="Nume utilizator" required>
				<input type="password" placeholder="Parola" name="password" required>
				
				<!-- Afiseaza eroare obtinuta cu GET -->
				<div style="color:red; font-weight: 300; font-style:italic; "><?php if (isset($_GET['error'])) echo $_GET['error'] ?></div>

				<input class="logare" type="submit" name="submit" value="Logare">
			</form>
			<a class="cont-nou" href="../signup/signupform.php">Cont nou</a>
		</div>
	</div>
</body>

</html>