<?php
session_start();
include 'connect.php';

$uname = $_POST['uname'];
$password = $_POST['password'];
$message;
$sql = "SELECT `korisnik_id`, `tip_id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `email`, `slika` FROM `korisnik` WHERE `korisnicko_ime` = '".$uname."' AND `lozinka` = '".$password."'";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $_SESSION["korisnik_id"] = $row['korisnik_id'];
        $_SESSION["tip_id"] = $row['tip_id'];
        $_SESSION["korisnicko_ime"] = $row['korisnicko_ime'];
        $_SESSION["ime"] = $row['ime'];
        $_SESSION["prezime"] = $row['prezime'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["slika"] = $row['slika'];
}


if ($result) {
        $message = "Uspjeh";
} else {
        $message = "Error updating record: " . mysqli_error($con);
}
mysqli_free_result($result);
header('Location: index.php?message='.$message);
die();

