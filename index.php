<?php
include 'auth.php';
include 'common.php';
include 'aukcijaData.php';
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php';
    showMessage($_GET);
    include 'otvoreneAukcije.php';
    if(isAdmin()){
        include 'popisSvihAukcija.php';
        include 'stanjeMojihPonuda.php';
        include 'mojeZatvAukcije.php';
    }
    if(isKorisnik()|| isVoditelj()){
       include 'stanjeMojihPonuda.php';
       include 'mojeZatvAukcije.php';
   }
    ?>
</div>

</body>
</html>

