<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;1,300&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/navbar.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <title>Home</title>
    <script src="jquery/jquery-3.7.0.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.gallery').hover(function() {
                    // Afisare like-uri cand cursorul este deasupra imaginii
                    imgId = $(this).children('.like-container').children('.like-count').attr('id');
                    var t = $(this).children('.like-container');

                    $.post("checklike.php", {
                        id: imgId
                    }, function(response) {
                        if (response == 1) {
                            t.css("background-color", "#F72585"); //magenta
                        }
                        if (response == 0) {
                            t.css("background-color", "#3A0CA3"); //albastru
                        }
                        t.css("opacity", "1");
                    })
                },
                // Ascundere like-uri cand cursorul nu este deasupra imaginii
                function() {
                    $(this).children('.like-container').css("opacity", "0");

                }
            );

            // Adaugare like cand butonul este apasat
            $('.like-container').click(function() {
                imgId = $(this).children('.like-count').attr('id');
                var t = $(this);
                $.post("like.php", {
                    id: imgId
                }, function(response) {
                    t.children('div').load('getlikes.php?id=' + imgId);
                    // Daca a dat like butonul se devine rosu
                    if (response == 1) {
                        t.css("background-color", "#F72585"); //magenta
                    }
                    // Daca a dat unlike butonul se devine albastru
                    if (response == 0) {
                        t.css("background-color", "#3A0CA3"); //albastru
                    }
                    // redirectionare la pagina de login daca utilizatorul nu este logat 
                    else if (response == 2) {
                        window.location.replace("login/loginform.php");
                    }
                })

            });
        });
    </script>

</head>

<body>
    <?php
    session_start();
    include "reusable/navbar.php";
    include "reusable/conectare_bd.php";
    require __DIR__ . '/functions.php';
    $sql = "SELECT * FROM imagini ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    echo "<div class=gallery>";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $getlikes = "SELECT * FROM likes WHERE id = " . $row['id'] . ";";
            $likes = mysqli_num_rows(mysqli_query($conn, $getlikes));
            if (isset($_GET['query'])) {
                $query = $_GET['query'];
            }
            // Daca nu este cautare sau daca este cautare si imaginea respecta criteriile de cautare
            if (empty($_GET['cauta']) || validate($query, $row['tags'] . ' autor:' . $row['uploader'] . ' like:' . $likes)) {
    ?>

                <div class="gallery">
                    <!-- Afisare imagine  -->
                    <a href="/galerie_licenta/view.php?id=<?= $row['id'] ?>"><img src="pictures/<?= $row['url'] ?>" alt=""></a>
                    <!-- Afisare buton like -->
                    <button class="like-container">
                        <img class="like" src="media/like.png" alt="like" class="like">
                        <div class="like-count" id=<?= $row['id'] ?>">
                            <?= $likes ?>
                        </div>
                    </button>
                </div>
    <?php
            }
        }
    } ?>
    </div>
</body>

</html>