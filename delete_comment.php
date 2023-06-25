<?php
session_start();
if (isset($_POST['id']) && isset($_SESSION["username"])) {
    
    session_start();
    include "reusable/conectare_bd.php"; {
        var_dump($_POST);
        $sql = "DELETE FROM comments WHERE comment_id = '" . $_POST['id'] .  "'";
        mysqli_query($conn, $sql);
        echo "0";
    }
}
