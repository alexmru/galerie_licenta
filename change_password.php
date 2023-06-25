<?php
include "reusable/conectare_bd.php";
session_start();
var_dump($_POST);
if (isset($_POST["old-password"]) && isset($_POST["new-password"])) {
    $old_password = $_POST["old-password"];
    $new_password = $_POST["new-password"];
    $username = $_SESSION["username"];
    $sql = "SELECT * FROM utilizatori WHERE user='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (password_verify($old_password, $row["hash"])) {
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE utilizatori SET hash='$new_password' WHERE user='$username'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: /galerie_licenta/account.php?success=true");
        } else {
            echo "Eroare la schimbarea parolei!";
        }
    } else {
        header("Location: /galerie_licenta/account.php?error=parola");

    }
}