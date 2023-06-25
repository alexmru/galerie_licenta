<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/navbar.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <script src="jquery/jquery-3.7.0.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

            // Stergere comentariu
            $('.delete-comment').click(function() {
                // Trimite id-ul comentariului catre delete_comment.php
                $.post("delete_comment.php", {
                    id: $(this).attr('id')
                });
                // Ascunde comentariul
                $(this).parent(".author-date").parent(".comment-container").css("display", "none");
            });
        });
    </script>

    <title>Imagine</title>
</head>

<body>

    <?php

    // Pornire sesiune
    session_start();
    // In cazul in care utilizatorul nu e logat va avea privilegiul 3
    // if (isset($_SESSION["privilege"])) {
    //     $privilege = $_SESSION["privilege"];
    // } else {
    //     $privilege = 3;
    // }

    // Adaugare bara de navigare
    include "reusable/navbar.php";
    // Conectare la bd
    include "reusable/conectare_bd.php";

    
    $imageId = $_GET['id'];
    $sql = "SELECT * FROM imagini WHERE id='$imageId'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "pictures/" . $row['url'];
        echo "<div class=picture-container>";

        echo "<a href=pictures/" . $row['url'] . "><div class=\"picture-expanded\"><img  src = " . "pictures/" . $row['url'] . " alt = 'test'></div></a>";


        if (isset($_GET['delete'])) {
            if (isset($_SESSION["username"]) && ($_SESSION["username"] == $row['uploader'] || $privilege < 2)) {
                $sql = "SELECT url FROM imagini WHERE id='$imageId'";
                $result = mysqli_query($conn, $sql);
                $url = mysqli_fetch_assoc($result)["url"];
                var_dump($url);
                unlink('pictures/' . $url);
                $sql = "DELETE FROM imagini WHERE id='$imageId'";
                mysqli_query($conn, $sql);
                header("Location: index.php");
                exit;
            }
        }

        if (isset($_GET['edit'])) {
    ?>

            <form action="update_tags.php" class="update-tags-form" method="POST">
                <input type="hidden" name="id" value="<?= $imageId ?>" />
                <input type="text" name="tags" class="tags-update" value="<?= $row['tags'] ?>" placeholder="Cuvinte cheie">
                <input type="submit" class="update-tag-btn" value="Actualizează" name="submit">

            </form>

        <?php

        } else {
            $tags = explode(" ", $row['tags']);
            echo "<div class=tags>";
            $sql = "SELECT * FROM likes WHERE id = '" . $row['id'] . "'";
            $total =  mysqli_num_rows(mysqli_query($conn, $sql));
            echo "<a class=\"tag\" href=index.php?cauta=1&query=like:$total>" . $total . " like" . ($total != 1 ? "-uri" : "") . "</a> ";
            if (!empty($row['tags'])) {
                foreach ($tags as $tag) {
                    echo "<a class=\"tag\" href=index.php?cauta=1&query=" . $tag . ">" . $tag . "</a> ";
                }
            }
            if (isset($_SESSION["username"]) && ($_SESSION["username"] == $row['uploader'] || $_SESSION["privilege"] < 2)) {

                echo "<a class=\"edit\" href=view.php?id=" . $row['id'] . "&edit=1>Editare <img class=\"edit-icon\" src=\"media/edit_note.png\" alt=\"edit\"></a> ";
                echo "<a class=\"delete\" href=view.php?id=" . $row['id'] . "&delete=1>Șterge <img class=\"delete-icon\" src=\"media/delete.png\" alt=\"edit\"></a> ";
            }
            echo "</div>";
        }

        echo "<div class=details>";

        ?>

        <!-- Formular de adaugare comentariu -->
        <form action="add-comment.php" class="add-comment-form" method="POST">
            <input type="hidden" name="id" value="<?= $imageId ?>" />
            <input type="text" name="comment" class="comment-input" placeholder="Scrie un comentariu"></input>
            <input type="submit" class="add-comment-btn" value="Adaugă" name="submit">
        </form>

        <!-- Afisare comentarii -->
        <?php
        // Salvarea comentariilor intr-un array
        $sqlcomments = "SELECT * FROM comments WHERE id = " . $row['id'] . " ORDER BY data DESC;";
        $resultcomments = mysqli_query($conn, $sqlcomments);

        // Afisare comentarii
        if (mysqli_num_rows($result) > 0) {
            while ($rowcomments = mysqli_fetch_assoc($resultcomments)) { ?>
                <div class=comment-container>

                    <!-- Data si autorul comentariului -->
                    <div class="author-date">
                        <div class="author"><?= $rowcomments['user'] ?></div>
                        <div class="date"><?= (new DateTime($rowcomments['data']))->format('Y-m-d H:i') ?></div>
                        <?php 
                        // Daca utilizatorul e autorul, moderator sau admin, poate sterge comentariul
                        if (isset($_SESSION["username"]) && ($_SESSION["username"] == $rowcomments['user'] || $_SESSION["privilege"] < 2)) {
                            echo "<div class='delete-comment' id=" . $rowcomments['comment_id'] . ">Șterge</div>";
                        } ?>
                    </div>

                    <!-- Textul comentariului -->
                    <div class="comment"><?= $rowcomments['comment'] ?>
                    </div>
                    <hr class="comment-end">
                </div>
    <?php
            }
        }

        // Informatii aditionale
        echo "<div class=meta>";
        echo "<div>Autor: " . $row['uploader'] . "</div>";
        echo "<div>Data: " . $row['date'] . "</div>";
        echo "<div>URL: " . $row['url'] . "</div>";
        echo "<div>Hash: " . $row['sha256'] . "</div>";
        echo "</div></div></div>";
    }
    ?>
</body>
</html>