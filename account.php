<?php
session_start();
$priv = $_SESSION["privilege"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/navbar.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <title>Document</title>
    <script src="jquery/jquery-3.7.0.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#change-password").click(function() {
                $(".hidden").toggleClass("change-password");
            });

            $("#delete-account").click(function() {

                var r = confirm("Ești sigur că vrei să ștergi contul?");
                if (r == true) {
                    $.ajax({
                        type: "POST",
                        url: "delete_account.php",
                        data: {
                            username: "<?= $_SESSION["username"] ?>"
                        },
                        success: function(data) {
                            alert(data);
                            window.location.replace("logout.php");
                        }
                    });
                }
            });
            $(".account-button").click(function() {});
        });
    </script>
</head>

<body>
    <?php

    include "reusable/navbar.php";

    ?>
    <div class="center">
        <div class="account-form">
            <h1>Salut, <?= $_SESSION["username"] ?>!</h1>

            <?php
            if ($priv == 2) {
                echo "<h3>Ești un utilizator obișnuit.</h2>";
            } else if ($priv == 1) {
                echo "<h3>Ești un moderator.</h2>";
            } else if ($priv == 0) {
                echo "<h3>Ești un administrator.</h2>";
                echo "<a href='admin/privilege.php'><button class=account-button>Administrează conturi</button></a>";
            }




            ?>

            <button class="account-button" id="change-password">Schimbă parola</button>
            <form class="hidden" action="change_password.php" method="POST">
                <input type="text" name="old-password" id="new-password" placeholder="parola veche">

                <input type="text" name="new-password" id="new-password" placeholder="parola nouă">

                <input class="account-button" id="confirm-change" type="submit" value="Confirmă">
            </form>
            <?php
            if (isset($_GET["error"])) {
                echo "<p style='color:red' class=error>Parola veche este incorectă!</p>";
            }
            if (isset($_GET["success"])) {
                echo "<p style='color:green' class=error>Parola a fost schimbată cu succes!</p>";
            }
            ?>
            <button class="account-button" id="delete-account">Șterge cont</button>
        </div>
    </div>
</body>

</html>