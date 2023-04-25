<?php
include 'auth.php';
include 'connect.php';

$naziv = $_POST['naziv'];
$opis = $_POST['opis'];
$slika = $_POST['slika'];
$cijena = $_POST['cijena'];
$id = $_POST['id'];
$userId = $_SESSION["korisnik_id"];

$sql = "INSERT INTO `predmet`(`aukcija_id`, `korisnik_id`, `naziv`, `opis`, `slika`, `pocetna_cijena`) VALUES (".$id.",".$userId.",'".$naziv."','".$opis."','".$slika."',".$cijena.")";
if (mysqli_query($con, $sql)) {
    echo "Predmet je uspješno dodan.";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
header('Location: predmetiAukcije.php?id=' . $id);
die();

