<?php

include 'connect.php';

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$img = $_POST['img'];
if(isset($_POST['tip'])){$tip = 1;}else{$tip = 2;}

$sql = "INSERT INTO `korisnik`(`tip_id`,`korisnicko_ime`, `lozinka`, `ime`, `prezime`, `email`, `slika`) VALUES (".$tip.",'".$username."','".$password."','".$name."','".$lastname."','".$email."','".$img."')";
if (mysqli_query($con, $sql)) {
    echo "Korisnik je uspješno dodan.";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
header('Location: korisnici.php?id=' . $id);
die();

