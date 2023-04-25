<?php
include 'auth.php';
include 'common.php';
include 'aukcijaData.php';
include 'korisnikData.php';
include  'predmetData.php';
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php';$aukc = getMojeAukcije($con,$_GET['id']);?>

   <?php if(isAdmin()) include 'urediAukcijeFormA.php'?>
    <?php if(isVoditelj()) include 'urediAukcijeFormM.php'?>

    <table>
        <?php showPredmetiAukcijeById($con, $_GET['id']); ?>
    </table>
    ?>
</div>

</body>
</html>

