<?php
session_start();

if (isset($_POST['submit']) && isset($_SESSION["username"]) && isset($_POST['tags'])) {
    // Conectare bd
    include "reusable/conectare_bd.php";
    
    //verifica daca utilizator este autorul
    $sql = "SELECT * FROM imagini WHERE id=" . $_POST['id'] . ";";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['uploader'] != $_SESSION["username"] && $_SESSION["privilege"] == 2) {
        echo("Nu aveti dreptul sa faceti modificari asupra acestei imagini!");
        exit();
    }

    // Actualizare etichete
    $sql="UPDATE imagini SET tags='" . trim($_POST['tags']) . "' WHERE id=" . $_POST['id'] . ";";
    mysqli_query($conn, $sql);
    // Redirectionare catre pagina imaginii
    header("Location: /galerie_licenta/view.php?id=" . $_POST['id'] );

}
