<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../styles/navbar.css" rel="stylesheet">
    <link href="../styles/style.css" rel="stylesheet">
    <script src="../jquery/jquery-3.7.0.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("tr").click(function() {
                var username = $(this).find("td").eq(0).html();
                var privilege = $(this).find("td").eq(1).html();
                $("#modify-user").val(username);
                privileges = ['Administrator', 'Moderator', 'User'];
                privilege = privileges.indexOf(privilege);
                $("#privilege").val(privilege);
            }
            )});
    </script>
    <title>Document</title>
</head>

<body>
    <div class="gallery">
        <div class="modify-table">
            <?php
            
            include "../reusable/navbar.php";

            // Daca utilizatorul nu este logat, redirectioneaza-l catre pagina de login
            if (!isset($_SESSION["username"])) {
                header("Location: ../login/loginform.php");
                exit;
            }

            if ($_SESSION["privilege"] != 0) {
                echo "Acces interzis!";
            } else {


                $privileges = ['Administrator', 'Moderator', 'User'];




                $mysql = mysqli_connect("localhost", "root");
                mysqli_select_db($mysql, "aikive");
            ?>
                <form method="POST" class="modify-form" action="modify.php">
                    <label>
                        <h2>Nume utilizator: </h2>
                    </label>
                    <input type="text" name="username" id=modify-user placeholder="nume utilizator" required><br><br>
                    <label>
                        <h2>Funcție:</h2>
                    </label>
                    <select id="privilege" name="privilege">
                        <optgroup>
                            <option value="3">Șterge</option>
                            <option value="2">User</option>
                            <option value="1">Moderator</option>
                            <option value="0">Administrator</option>
                        </optgroup>
                    </select>
                    <br><input type="submit" class="logare" name="submit" value="Modifică">
                </form>

            <?php
                $query = mysqli_query($mysql, "select * from utilizatori");
                $total = mysqli_num_rows($query);
                if ($total > 0) {

                    echo "Există " . $total . " de utilizatori<br>";


                    echo "<table align='center'>";
                    echo '<tr>';
                    echo '<th BGCOLOR="Silver">Nume utilizator</th>';
                    echo '<th BGCOLOR="Silver">Funcție</th>';
                    echo '</tr>';
                    
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr id=row-".$row['user'].">";
                        echo "<td>". $row['user']."</td>";
                        $priv = $row['privilege'];
                        echo "<td>$privileges[$priv]</td>";
                        
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Nu s-a gasit nici o inregistrare!!!";
                }
                mysqli_close($mysql);
            }
            ?>
        </div>
    </div>
</body>

</html>
