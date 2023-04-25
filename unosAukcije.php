<?php
include 'auth.php';
include 'aukcijaData.php';
include  'predmetData.php';
include  'korisnikData.php';
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php';?>
    <form action="addAukciju.php" method="post">
        <div class="container">
            <h1>Unos Aukcije</h1>
            <hr>
            <?php showVoditelje($con);?>
            <label for="naziv"><b>Naziv</b></label>
            <input type="text" placeholder="Naziv" name="naziv" required>
            <label for="opis"><b>Opis</b></label>
            <input type="text" placeholder="Opis" name="opis" required>
            <label for="datump"><b>Datum početka</b></label>
            <input type="text" placeholder="dd.mm.gggg" name="datump" required>
            <label for="vrijemep"><b>Vrijeme početka</b></label>
            <input type="text" placeholder="hh:mm:ss" name="vrijemep" required>
            <label for="datum"><b>Datum završetka</b></label>
            <input type="text" placeholder="dd.mm.gggg" name="datum">
            <label for="vrijeme"><b>Vrijeme završetka</b></label>
            <input type="text" placeholder="hh:mm:ss" name="vrijeme">
            <input type="submit" value="Spremi" class="btnLogin">
        </div>

    </form>
</div>

</body>
</html>

