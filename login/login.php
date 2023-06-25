<?php

	
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		include("../reusable/conectare_bd.php");

		$sql = "SELECT * FROM utilizatori WHERE user='$username'";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0){
			// Verify password
			$row = mysqli_fetch_assoc($result);
            $privilege = $row['privilege'];
			if(password_verify($password, $row['hash'])){
				// Asignare variabile de sesiune
				session_start();
				$_SESSION['username'] = $username;
                $_SESSION['privilege'] = $privilege;

				// Redirect catre pagina principala
				header("Location: ../index.php");
				exit;
			}
			else{
				header("Location: loginform.php?error=Parola incorecta!");
				exit;
			}
		}
		else{
			header("Location: loginform.php?error=Utilizatorul nu exista!");
			exit;
		}
		mysqli_close($conn);
	}
