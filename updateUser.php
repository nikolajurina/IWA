<?php
include 'connect.php';

$id = $_POST['id'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$lozinka = $_POST['lozinka'];
$ponovljena_lozinka = $_POST['ponovljena_lozinka'];
$img = $_POST['img'];
if(isset($_POST['tip'])){$tip = 1;}else{$tip = 2;}
if($lozinka == $ponovljena_lozinka){


$sql = "UPDATE `korisnik` SET lozinka ='" . $lozinka . "', `korisnicko_ime`='" . $username . "',`ime`='" . $name . "',`prezime`='" . $lastname . "',`email`='" . $email . "', `slika` = '" . $img . "', `tip_id` =".$tip." WHERE `korisnik_id` =" . $id;
echo $sql;
if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($con);
}
header('Location: korisnici.php?id='.$id);
die();
}else{
    header('Location: korisnici.php');
    die();
}

