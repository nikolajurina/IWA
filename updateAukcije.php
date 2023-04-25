<?php
include 'connect.php';
include 'common.php';
include 'auth.php';
if(isAdmin()){
    $id = $_POST['id'];
    $moder = $_POST['moder'];
    $naziv = $_POST['naziv'];
    $opis = $_POST['opis'];
    $datump = $_POST['datump'];
    $vrijemep = $_POST['vrijemep'];
    $datum = $_POST['datum'];
    $vrijeme = $_POST['vrijeme'];

    $datumVrijemep = datumVrijeme($datump, $vrijemep);
    $datumVrijemez = datumVrijeme($datum, $vrijeme);
    $sql = "UPDATE `aukcija` SET `moderator_id`=".$moder.",`naziv`='".$naziv."',`opis`='".$opis."',`datum_vrijeme_pocetka`= STR_TO_DATE('" . $datumVrijemep . "','%Y-%m-%d %H:%i:%s'),`datum_vrijeme_zavrsetka`= STR_TO_DATE('" . $datumVrijemez . "','%Y-%m-%d %H:%i:%s') WHERE `aukcija_id` = " . $id;
}if(isVoditelj()){
    $datum = $_POST['datum'];
    $vrijeme = $_POST['vrijeme'];
    $id = $_POST['id'];

    $datumVrijeme = datumVrijeme($datum, $vrijeme);


    $sql = "UPDATE `aukcija` SET `datum_vrijeme_zavrsetka`= STR_TO_DATE('" . $datumVrijeme . "','%Y-%m-%d %H:%i:%s') WHERE `aukcija_id` = " . $id;
}

echo $sql;
if (mysqli_query($con, $sql)) {
    echo "Aukcija je uspješno ažurirana.";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
header('Location: mojeAukcije.php');
die();

