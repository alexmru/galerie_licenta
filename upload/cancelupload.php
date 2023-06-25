<?php
session_start();
var_dump($_POST);
if (isset($_POST['submit']) && isset($_SESSION["username"])) {
    unlink('../temp/' . $_POST['path']);
    header("Location: ../index.php");
} else {
    echo $_SESSION["username"];
    echo "hello";
}
