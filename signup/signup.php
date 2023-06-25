<?php
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	include("../reusable/conectare_bd.php");

	$sql = "SELECT * FROM utilizatori WHERE user='$username'";
	$result = mysqli_query($conn, $sql);
	if (strlen($password) < 8) {
		header("Location: signupform.php?error=Parola trebuie sa aiba minim 8 caractere!");
		exit;
	}
	if (strlen($username) > 10) {
		header("Location: signupform.php?error=Numele de utilizator trebuie sa aiba maxim 10 caractere!");
		exit;
	}
	if (strlen($username) < 2) {
		header("Location: signupform.php?error=Numele de utilizator trebuie sa aiba mai mult de 2 caractere!");
		exit;
	}
	if (mysqli_num_rows($result) > 0) {
		header("Location: signupform.php?error=Numele este deja utilizat!");
		exit;
	}

	// Creare hash parola
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	// Inserare date de logare in baza de date
	$sql = "INSERT INTO utilizatori (user, privilege, hash) VALUES ('$username',2, '$hashed_password')";
	mysqli_query($conn, $sql);
	header("Location: success.php");
	mysqli_close($conn);
} 
