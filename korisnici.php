<?php
include 'auth.php';
include 'korisnikData.php';
onlyAdmin();
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">

    <?php include 'nav.php';?>

    <section>
        <h2>Korisnici</h2>
        <a href="addKorisnik.php" class="a">Dodaj korisnika</a>
        <div style=" height: 600px;overflow: scroll;">
          <table>
              <tr>
                  <th>ID</th>
                  <th>Tip</th>
                  <th>Ime i prezime</th>
                  <th>Korisničko ime</th>
                  <th>email</th>
                  <th>ažuriraj</th>
              </tr>
              <?php showSveKorisnike($con);?>
          </table>
        </div>

    </section>
</div>

