<?php
include 'auth.php';
include 'statData.php';
include 'common.php';
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="style.css">
</head>
<body>
<div class="content">
    <?php include 'nav.php';?>
<form method="POST">
	<h3>Zadaj interval (baziran na početku vremena aukcije)</h3>
	<label>Početni datum intervala </label>
	<input type="text" name="datum_p" placeholder="dd.mm.gggg" required>
	<label>Početno vrijeme intervala </label>
	<input type="text" name="vrijeme_p" placeholder="hh:mm:ss" required>
	<label>Završni datum intervala </label>
	<input type="text" name="datum_z" placeholder="dd.mm.gggg" required>
	<label>Završno vrijeme intervala </label>
	<input type="text" name="vrijeme_z" placeholder="hh:mm:ss" required>
	<button type="submit" class="a">Pogledaj</button>
</form>


<?php
if (isset($_POST['datum_p']) && isset($_POST['vrijeme_p']) && isset($_POST['datum_z']) && isset($_POST['vrijeme_z'])){
$d_p = $_POST['datum_p']; $v_p = $_POST['vrijeme_p'];
$d_z = $_POST['datum_z']; $v_z = $_POST['vrijeme_z'];

$dv_p = datumVrijeme($d_p, $v_p);
$dv_z = datumVrijeme($d_z, $v_z);

showStats($con,$dv_p,$dv_z);
}
?>
</div>

</body>
</html>

