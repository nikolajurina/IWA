<?php
include 'auth.php';
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php'; ?>
    <form action="addUser.php" method="post">
        <div class="cont">
            <h1>Dodavanje korisnika</h1>
            <hr>
            <label for="name"><b>Ime</b></label>
            <input type="text" placeholder="Unesite ime" name="name" required>
            <label for="lastname"><b>Prezime</b></label>
            <input type="text" placeholder="Unesite prezime" name="lastname" required>
            <label for="username"><b>Korisničko ime</b></label>
            <input type="text" placeholder="Unesite korisničko ime" name="username" required>
            <label for="password"><b>Lozinka</b></label>
            <input type="password" placeholder="Unesite lozinku" name="password" required>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Unesite email" name="email" required>
            <label for="img"><b>Slika (URL)</b></label>
            <input type="text" placeholder="Unesite url od slike" name="img" required>
            <input type="checkbox" value="1" name="tip">
            <label for="tip"><b>Postavi za moderatora</b></label>
            <input type="submit" class="btn" value="Spremi">
        </div>
    </form>
</div>
</body>
</html>

