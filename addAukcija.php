<?php
include 'auth.php';
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="../style/style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php'; ?>
    <form action="addPredmet.php" method="post">
        <div class="cont">
            <h1>Dodavanje predmeta</h1>
            <hr>
            <label for="naziv"><b>Naziv</b></label>
            <input type="text" placeholder="Unesite naziv" name="naziv" required>
            <label for="opis"><b>Opis</b></label>
            <input type="text" placeholder="Unesite opis predmeta" name="opis" required>
            <label for="slika"><b>Slika (URL)</b></label>
            <input type="text" placeholder="Unesite url od slike" name="slika" required>
            <label for="cijena"><b>Početna cijena (u HRK)</b></label>
            <input type="text" placeholder="Unesite cijenu" name="cijena" required>
            <input type="hidden" value="<?php echo htmlspecialchars($_GET['id']);?>" name="id">
            <input type="submit" class="btn" value="Dodaj">
        </div>
    </form>
</div>
</body>
</html>
