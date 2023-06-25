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
            <script src="../jquery/jquery-3.7.0.js" type="text/javascript"></script>
</head>

<body>
    <?php
    include "../reusable/navbar.php";
    ?>
    <div class="center">
        <div class="upload-form">
            <h1>Mărește o imagine</h1>
            <p class="upload-info">Imaginile trebuie sa se supuna următoarelor cerințe:

            </p>
            <div class="upload-req">
                <ul>
                    <li>Imaginea trebuie să fie de tip .jpg sau .png</li>
                    <li>Imaginea trebuie să aibă o dimensiune mai mică de 5MB</li>
                </ul>
            </div>
            <form action="upscale_confirm.php" method="post" enctype="multipart/form-data">

                <label for="file-upload" class="custom-file-upload">
                    Alege o imagine
                </label>

                <input id="file-upload" name="fileToUpload" type="file" />
                <div class="upscale-options">
                    <div>
                        <label for="html " >2x</label>
                        <input type="radio" checked="checked" id="html" name="resize" value="2">
                    </div>
                    <div>
                        <label for="css">4x</label>
                        <input type="radio" id="css" name="resize" value="4">
                    </div>
                </div>
                <div style="color:red; font-weight: 300; font-style:italic; "><?php if (isset($_GET['error'])) echo $_GET['error'] ?></div>
                <input type="submit" class="upload" value="Upload" name="submit">
            </form>
        </div>
    </div>

</body>

</html>