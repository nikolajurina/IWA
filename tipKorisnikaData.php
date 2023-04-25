<?php
include 'connect.php';

function getTipKorisnika($con){
    $sql = 'SELECT * FROM `tip_korisnika`';
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $sviTipoviKorisnika[] = array(
            "tip_id" => $row['tip_id'],
            "naziv" => $row['naziv']
        );
    }
    mysqli_free_result($result);
    //mysqli_close($con);
    return $sviTipoviKorisnika;
}



