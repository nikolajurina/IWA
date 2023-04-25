<?php
include 'auth.php';
include 'predmetData.php';
$predmetAukcije = getPredmetAukcijeById($con, $_GET['id']);
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php'; ?>
    <div class="card">
        <img src="<?php echo $predmetAukcije['slika'] ?> " alt="slika">
        <h1>Predmet: <?php echo $predmetAukcije['naziv'] ?> </h1>
        <p class="price">Opis</p>
        <p><?php echo $predmetAukcije['opis'] ?> </p>
        <form action="ponudaData.php" class="form" method="post">
            <div class="container">
                <p>Početna ponuda: <?php echo $predmetAukcije['pocetna_cijena'] ?> HRK</p>
                <p>Iznos trenutne najveće ponude: <?php echo $predmetAukcije['zadnja_cijena'] ?> HRK</p>
                <hr>
                <label for="ponuda"><b>Ponuda (HRK)</b></label>
                <input type="text" placeholder="Unesite ponudu" name="ponuda" required>
                <input type="hidden" name="predmet_id" value="<?php echo htmlspecialchars($_GET['id']);?>">
                <hr>
                <button type="submit" class="btn">Ponudi</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

