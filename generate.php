<!DOCTYPE html>
<html lang="en">

<head>
    <metaa charset="UTF-8">
        <met http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="styles/navbar.css" rel="stylesheet">
            <link href="styles/style.css" rel="stylesheet">
            
            <title>Document</title>
            <script src="jquery/jquery-3.7.0.js" type="text/javascript"></script>
</head>
<body>
    <?php
    session_start();
    include "reusable/navbar.php";
    ?>
    <div class="center">
        <div class="upload-form">
            <h1>Genereaza o imagine</h1>
            <p class="upload-info">Creaza o imagine din text.

            </p>
            <div class="upload-req">
                <!-- <ul>
                    <li>Imaginea trebuie să fie de tip .jpg sau .png</li>
                    <li>Imaginea trebuie să aibă o dimensiune mai mică de 5MB</li>
                </ul> -->
            </div>
            <form action="generate_image.php" method="post" enctype="multipart/form-data">
                <p>Prompt</p>
                <input type="text" name="prompt" placeholder="Prompt" required>
                <input type="text" name="negative_prompt" placeholder="Negative Prompt">
                <div style="color:red; font-weight: 300; font-style:italic; "><?php if (isset($_GET['error'])) echo $_GET['error'] ?></div>
                <input type="submit" class="upload" value="Generează" name="submit">
            </form>
        </div>
    </div>

</body>

</html>

