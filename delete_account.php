<?php
error_reporting(0);
session_start();
if (isset($_POST['username']) && isset($_SESSION["username"])) {
    if ($_POST['username'] == $_SESSION["username"]) {
        include "reusable/conectare_bd.php"; {
            $sql = "DELETE FROM utilizatori WHERE user = '" . $_POST['username'] .  "'";
            mysqli_query($conn, $sql);
            session_destroy();
        }
    }
}
