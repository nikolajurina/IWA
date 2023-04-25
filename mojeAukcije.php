<?php
include 'auth.php';
include 'aukcijaData.php';
include 'common.php';
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php';?>
<section>
    <h2>Aukcije</h2>
    <?php if(isAdmin()) echo '<a href="unosAukcije.php" class="a">Unesi aukciju</a>';?>
    <table>
        <tr>
            <th>Aukcija</th>
            <th>Opis</th>
            <th>Moderator</th>
            <th>Stanje</th>
            <th>Ažuriraj</th>
        </tr>
        <?php  if(isAdmin()) showAukcijeEdit($con);?>
        <?php if(isVoditelj()) showAukcijeEditM($con,$_SESSION["korisnik_id"]);?>
    </table>
    </section>
</div>

</body>
</html>

