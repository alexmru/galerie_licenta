<?php
include "reusable/conectare_bd.php";
// Obtinere numar total de like-uri al unei imagini
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM likes WHERE id = '".$_GET['id'] ."'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
}