<?php
include 'auth.php';
include 'predmetData.php';
?>

<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php'; ?>
    <?php if(isSessionSet()){echo '<a href="addAukcija.php?id='.$_GET['id'].'" class="a">Dodaj novi predmet</a>';} ?>
    <section>
        <h2>Popis svih aukcija</h2>
        <table>
            <?php showPredmetiAukcijeById($con, $_GET['id']); ?>
        </table>
    </section>
</div>
</body>
</html>

