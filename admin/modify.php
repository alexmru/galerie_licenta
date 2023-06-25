<?php
session_start();

// Daca utilizatorul nu este logat, redirectioneaza-l catre pagina de login
if (!isset($_SESSION["username"])) {
    header("Location: loginform.php");
    exit;
}

// Daca utilizatorul nu este admin, redirectioneaza-l catre pagina de eroare
if ($_SESSION["privilege"] != 0) {
    echo "Access denied!";
} else {
    $privileges = ['admin', 'moderator', 'user'];
    $username = $_POST['username'];
    $privilege = $_POST['privilege'];

    // Conectare la BD
    $conn = mysqli_connect("localhost", "root", "", "aikive");

    // Verificare conectiune
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // daca privilege == 3, sterge utilizatorul
    if ($privilege == 3) {
        $query = "DELETE FROM utilizatori WHERE user='$username'";
    } else {
        $query = "UPDATE utilizatori SET privilege='$privilege' WHERE user='$username'";
    }
    if (mysqli_query($conn, $query)) {
        echo "$username privilege updated successfully to $privileges[$privilege]!";
        echo "<br><a href=privilege.php>Go Back</a>";
        header("Location: privilege.php");
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
}
