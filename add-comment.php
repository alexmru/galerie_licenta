<?php
session_start();
if (isset($_POST['submit']) && isset($_SESSION['username']) && isset($_POST['comment'])) {
    include "reusable/conectare_bd.php";
    $id = $_POST['id'];
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];
    $date = date("Y-m-d H:i");

    // Inserare comentariu in bd
    $sql = "INSERT INTO comments (id, user, comment,data) VALUES ('$id', '$username', '$comment','$date')";
    $result = mysqli_query($conn, $sql);

    // Redirectionare catre imagine
    header("Location: view.php?id=$id");
} else {
    // Daca utilizatorul ne este logat redirectionare catre pagina de login
    header("Location: login/loginform.php");
}
