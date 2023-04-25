<?php
session_start();

function isSessionSet()
{
    $bool = false;
    if (isset($_SESSION["korisnik_id"]) && isset($_SESSION["tip_id"]) && isset($_SESSION["korisnicko_ime"]) && isset($_SESSION["ime"]) && isset($_SESSION["prezime"]) && isset($_SESSION["email"]) && isset($_SESSION["slika"])) {
        $bool = true;
    }
    return $bool;

}

function isAdmin()
{
    $bool = false;
    if (isSessionSet() == true) {
        if ($_SESSION["tip_id"] == 0) {
            $bool = true;
        }
    }
    return $bool;
}

function isVoditelj()
{
    $bool = false;
    if (isSessionSet() == true) {
        if ($_SESSION["tip_id"] == 1) {
            $bool = true;
        }
    }
    return $bool;
}

function isKorisnik()
{
    $bool = false;
    if (isSessionSet() == true) {
        if ($_SESSION["tip_id"] == 2) {
            $bool = true;
        }
    }
    return $bool;
}

function onlyAdmin(){
    if(isAdmin() == false){
        header('Location: index.php');
        die();
    }
}

function adminAndVoditelj(){
    if(isKorisnik() == true){
        header('Location: index.php');
        die();
    }
}

