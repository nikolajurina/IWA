<?php
session_start();
include 'connect.php';
$predmet_id = $_POST['predmet_id'];
$korisnik_id = $_SESSION["korisnik_id"];
$ponuda = $_POST['ponuda'];
$sql = "INSERT INTO `ponuda`(`predmet_id`, `korisnik_id`, `datum_vrijeme_ponude`, `iznos_ponude`) VALUES (" . $predmet_id . "," . $korisnik_id . ",NOW()," . $ponuda . ")";
if (mysqli_query($con, $sql)) {
    echo "Ponuda je uspjesno poslana.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
header('Location: bidding.php?id=' . $predmet_id);
die();

