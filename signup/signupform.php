<!DOCTYPE html>
<html lang="ro">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cont nou</title>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="stylesheet" type="text/css" href="../styles/navbar.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,300&display=swap" rel="stylesheet">



</head>

<body>

	<?php
	include '../reusable/navbar.php';
	?>
	<div class="center">
		<div class="login-form">
			<!-- <h2>Sign Upfdsa</h2> -->
			<img class="logo" src="../media/logo.png">
			<form method="POST" action="signup.php">
				<input type="text" name="username" placeholder="Nume utilizator" required>
				<input type="password" id="password" placeholder="Parola" name="password" required>
				<input type="password" name="verify_password" placeholder="Rescrie parola" id="confirmPassword" required>

				<div style="color:red; font-weight: 300; font-style:italic; "><?php if (isset($_GET['error'])) echo $_GET['error'] ?></div>
				<script src="../jquery/jquery-3.7.0.js" type="text/javascript"></script>
				<script>
					// document.querySelector('form').addEventListener('submit', function(event) {
					// 	var password = document.getElementById('password').value;
					// 	var confirmPassword = document.getElementById('confirmPassword').value;
					// 	if (password !== confirmPassword) {
					// 		alert('Parolele nu se potrivesc!');
					// 		event.preventDefault(); // Împiedică trimiterea datelor către server
					// 	}
					// });
					$(document).ready(function() {
						$('form').submit(function(event) {
							var password = $('#password').val();
							var confirmPassword = $('#confirmPassword').val();
							if (password !== confirmPassword) {
								alert('Parolele nu se potrivesc!');
								event.preventDefault(); // Împiedică trimiterea datelor către server
							}
						});
					})
				</script>
				<input type="submit" class="logare" name="submit" value="Înregistrare">
			</form>
			<a class="cont-nou" href="../login/loginform.php">Am deja cont</a>
		</div>
	</div>
</body>

</html>