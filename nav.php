<header>
    <nav class="clearfix">
        <ul style="float: left;">
            <li><a href="index.php">Aukcije</a></li>
            <?php if (isAdmin()) {
                    echo '<li ><a href = "mojeAukcije.php" > Moje aukcije </a ></li >'.
                    '<li ><a href = "korisnici.php" > Korisnici</a ></li >'.
                    '<li ><a href = "stat.php" > Statistika</a ></li >';
                }
            if (isVoditelj()) {
                echo '<li ><a href = "mojeAukcije.php"" > Moje aukcije </a ></li >';
            }?>
        <li><a href="o_autoru.html">O autoru</a></li>
        </ul>
        <ul style="float: right;">
            <li><?php if (isSessionSet()) {
                    echo '<img src="' . $_SESSION['slika'] . '" class="img"><span>' . $_SESSION["korisnicko_ime"] . '</span>';
                } else {
                    echo '<span>' . 'Gost' . '</span>';
                } ?></li>
            <?php if (isSessionSet()) {
                echo '<li><a href="logout.php">Odjava</a></li>';
            } else {
                echo '<li><a href="login.php">Prijavi se</a></li>';
            } ?>
        </ul>
    </nav>
</header>

