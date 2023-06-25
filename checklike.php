<?php
// Verifica daca utilizatorul a dat like la o postare
session_start();
include "reusable/conectare_bd.php";
if (isset($_POST['id'])) {
    $sql = "SELECT * FROM likes WHERE id = '".$_POST['id'] ." ' AND user = '".$_SESSION["username"] . "'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
}?>