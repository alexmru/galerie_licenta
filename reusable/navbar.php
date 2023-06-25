<nav class="navbar">
    <div class="titlu-site"><a href="/galerie_licenta/index.php">AIKIVE</a></div>
    <a href="#" class="toggle-button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>

    <script>
        $(document).ready(function() {
            $('.toggle-button').click(function() {
                $('.navbar-links').toggleClass('active');
                $('.searchbox').toggleClass('active');
            })
        });
    </script>

    <?php if (isset($_SESSION["username"])) { ?>
    <form method="GET" class="searchbox" action="index.php?">
        <input type="hidden" name="cauta" value="1">
        <input type="text" name="query" <?php
                                        if (isset($_GET['query'])) {
                                            echo "value=" . htmlspecialchars($_GET['query']);
                                        }
                                        ?> placeholder="Caută" required>
        <button type="submit"><img src="/galerie_licenta/media/search.png" alt="search"></button>
    </form>
    <?php } ?>
    <div class="navbar-links">
        <ul>

            <?php if (isset($_SESSION["username"])) { ?>
                <li><a href="/galerie_licenta/upscale/upscale.php">Upscale</a></li>
                <li><a href="/galerie_licenta/generate.php">Genereaza</a></li>
                <li><a href="/galerie_licenta/upload/upload.php">Încarcă</a></li>
                <li><a href="/galerie_licenta/account.php"><?= $_SESSION["username"] ?></a></li>
                <li><a href="/galerie_licenta/logout.php">Deconectare</a></li>
            <?php } else { ?>
                <li><a href="/galerie_licenta/logout.php">Conectare</a></li>
            <?php } ?>
        </ul>
    </div>

</nav>