<?php
$con = mysqli_connect('127.0.0.1', 'iwa_2017', 'foi2017', 'iwa_2017_zb_projekt');
mysqli_set_charset($con,"utf8");

if (mysqli_connect_errno()){
    exit("Greška kod spajanja na bazu. Greška: " . mysqli_connect_error());
}
