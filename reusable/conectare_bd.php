<?php

$conn = mysqli_connect("localhost", "root", "", "aikive");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>