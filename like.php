<?php
// Ascunderea erorilor pentru a nu afecta raspunsul  AJAX
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

if (isset($_POST['id']) && isset($_SESSION["username"])) {
    session_start();
    include "reusable/conectare_bd.php";
    $sql = "SELECT * FROM likes WHERE id = '" . $_POST['id'] . " ' AND user = '" . $_SESSION["username"] . "'";

    $result = mysqli_query($conn, $sql);
    // Daca utilizatorul nu a dat deja like, adaugare like
    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO likes (id, user) VALUES ('" . $_POST['id'] . "', '" . $_SESSION["username"] . "');";
        mysqli_query($conn, $sql);
        echo "1";
        // In caz contrar, stergere like
    } else {
        $sql = "DELETE FROM likes WHERE id = '" . $_POST['id'] . " ' AND user = '" . $_SESSION["username"] . "'";
        mysqli_query($conn, $sql);
        echo "0";
    }
}
// Daca utilizatorul nu este logat, returnare cod 2
else {
    echo "2";
}
