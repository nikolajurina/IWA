<?php
//INSERT INTO `aukcija`(`moderator_id`, `naziv`, `opis`, `datum_vrijeme_pocetka`, `datum_vrijeme_zavrsetka`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])

include 'connect.php';
include 'common.php';

$moder = $_POST['moder'];
$naziv = $_POST['naziv'];
$opis = $_POST['opis'];
$datump = $_POST['datump'];
$vrijemep = $_POST['vrijemep'];
$datum = $_POST['datum'];
$vrijeme = $_POST['vrijeme'];

$datumVrijemep = datumVrijeme($datump, $vrijemep);
$datumVrijemez = datumVrijeme($datum, $vrijeme);

$sql = "INSERT INTO `aukcija`(`moderator_id`, `naziv`, `opis`, `datum_vrijeme_pocetka`, `datum_vrijeme_zavrsetka`) ";
$sql .="VALUES (".$moder.",'".$naziv."','".$opis."',STR_TO_DATE('" . $datumVrijemep.  "','%Y-%m-%d %H:%i:%s')".",STR_TO_DATE('" . $datumVrijemez . "','%Y-%m-%d %H:%i:%s'))";
//$sql = "UPDATE `aukcija` SET `datum_vrijeme_zavrsetka`= STR_TO_DATE('" . $datumVrijeme . "','%Y-%m-%d %H:%i:%s') WHERE `aukcija_id` = " . $id;
echo $sql;
if (mysqli_query($con, $sql)) {
    echo "Aukcija je uspješno dodana.";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
header('Location: mojeAukcije.php');
die();

