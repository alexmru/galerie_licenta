<?php
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login/loginform.php");
    exit();
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <metaa charset="UTF-8">
        <met http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../styles/navbar.css" rel="stylesheet">
            <link href="../styles/style.css" rel="stylesheet">
            <title>Document</title>




</head>

<body>
    <?php
    include "../reusable/navbar.php";
    ?>



    <div class="center">
        <div class="upload-form">
            <h1>Încarcă o imagine</h1>


            <?php
            include "../reusable/conectare_bd.php";

            if (isset($_POST['submit']) && isset($_FILES['fileToUpload'])) {
                $img_name = $_FILES['fileToUpload']['name'];
                $img_size = $_FILES['fileToUpload']['size'];
                $tmp_name = $_FILES['fileToUpload']['tmp_name'];
                $error = $_FILES['fileToUpload']['error'];

                if ($error === 0) {
                    if ($img_size > 5000000) {
                        $em = "Imaginea depaseste dimensiunea maxima!";
                        // header("Location: upscale.php?error=$em");
                    } else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);

                        $allowed_exs = array("jpg", "jpeg", "png");

                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $hash = hash_file('sha256', $tmp_name);
                            $sql = "SELECT * FROM imagini WHERE sha256='$hash'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) == 0) {
                                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                                $img_upload_path = '../temp/' . $new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                                echo "<img class=\"upload-preview\" src=$img_upload_path>";
                                
                            }
                            else {

                                $em = "Imaginea exista deja in baza de date";
                                header("Location: upscale.php?error=$em");
                            }
                            
                        } else {
                            $em = "Nu poti adauga imagini cu aceasta extensie!";
                            header("Location: upscale.php?error=$em");
                        }
                    }
                } else {
                    $em = "Eroare necunoscuta!";
                }
            } else {
                header("Location: ../index.php");
            }
            ?>

            <form action="upscalefile.php" method="POST">
                <input type="hidden" name="path" value="<?= $new_img_name ?>" />
                <input type="hidden" name="resize" value="<?= $_POST['resize'] ?>" />
                <input type="submit" class="upload" value="Upload" name="submit">
            </form>
            <form action="cancelupload.php" method="POST">
                <input type="hidden" name="path" value="<?= $new_img_name ?>" />
                <input type="submit" class="cancel" value="Anuleaza" name="submit">
            </form>
        </div>
    </div>


</body>

</html>