<?php
session_start();
// var_dump($_POST);

if (isset($_POST['submit']) && isset($_SESSION["username"]) && isset($_POST['tags'])) {
    var_dump($_POST['tags']);
    include "../reusable/conectare_bd.php";
    echo "<pre>";
    echo "</pre>";
    // $img_name = $_FILES['fileToUpload']['name'];
    // $img_size = $_FILES['fileToUpload']['size'];
    // $tmp_name = $_FILES['fileToUpload']['tmp_name'];
    // $error = $_FILES['fileToUpload']['error'];

    $img_upload_path = '../pictures/' . $_POST['path'];
    rename('../temp/' . $_POST['path'], $img_upload_path);
    // Insert into Database
    // echo $_POST['path'];
    $new_img_name = $_POST['path'];

    $hash = hash_file('sha256', $img_upload_path);
    $sql = "INSERT INTO imagini (url, tags, uploader,date,sha256) VALUES('$new_img_name', '" . $_POST['tags'] . "', '" . $_SESSION["username"] . "', NOW(), '$hash')";  
    mysqli_query($conn, $sql);
    header("Location: ../index.php");
} else {
    echo $_SESSION["username"];
    echo "hello";
    var_dump($_POST['tags']);
    //sleep(5);
    //header("Location: ../index.php");
}
