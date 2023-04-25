<?php
include 'connect.php';
include 'tipKorisnikaData.php';

function getSveKorisnike($con)
{
    $sql = 'SELECT * FROM `korisnik`';
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $sviKorisnici[] = array(
            "korisnik_id" => $row['korisnik_id'],
            "tip_id" => $row['tip_id'],
            "korisnicko_ime" => $row['korisnicko_ime'],
            "lozinka" => $row['lozinka'],
            "ime" => $row['ime'],
            "prezime" => $row['prezime'],
            "email" => $row['email'],
            "slika" => $row['slika']
        );
    }
    mysqli_free_result($result);
    //mysqli_close($con);
    return $sviKorisnici;
}


function getKorisnikById($con, $id)
{
    $sql = 'SELECT * FROM `korisnik` WHERE `korisnik_id` = ' . $id;
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $korisnik = array(
            "korisnik_id" => $row['korisnik_id'],
            "tip_id" => $row['tip_id'],
            "korisnicko_ime" => $row['korisnicko_ime'],
            "lozinka" => $row['lozinka'],
            "ime" => $row['ime'],
            "prezime" => $row['prezime'],
            "email" => $row['email'],
            "slika" => $row['slika']
        );
    }
    mysqli_free_result($result);
    //mysqli_close($con);
    return $korisnik;
}


function tipUser($tip_korisnika, $odabrano)
{   echo'<p>Izaberi tip korisnika:</p>';
    echo '<select name="tip_korisnika" required>';
    foreach ($tip_korisnika as $tip) {
        if($tip['tip_korisnika_id'] == $odabrano)
            echo
                ' <option value="' . $tip['tip_korisnika_id'] . '" selected="selected"> ' . strtoupper($tip['naziv']) . '</option>';
        else
            echo
                ' <option value="' . $tip['tip_korisnika_id'] . '"> ' . strtoupper($tip['naziv']) . '</option>';
    }
    echo "</select>";}

function showSveKorisnike($con)
{
    $sviKorisnici = getSveKorisnike($con);
    $tipKorisnika = getTipKorisnika($con);
    $nazivTipaKorisnika = "";

    for ($i = 0; $i < count($sviKorisnici); $i++) {
        for ($j = 0; $j < count($tipKorisnika); $j++) {
            if ($tipKorisnika[$j]['tip_id'] == $sviKorisnici[$i]['tip_id']) {
                $nazivTipaKorisnika = $tipKorisnika[$j]['naziv'];
            }
        }
        echo "<tr>";
        echo "<td>", $sviKorisnici[$i]['korisnik_id'], "</td>";
        echo "<td>", $nazivTipaKorisnika, "</td>";
        echo '<td><img src="', $sviKorisnici[$i]['slika'], '"alt="profilna" height="42" width="42">', $sviKorisnici[$i]['ime'], " ", $sviKorisnici[$i]['prezime'], "</td>";
        echo "<td>", $sviKorisnici[$i]['korisnicko_ime'], "</td>";
        echo "<td>", $sviKorisnici[$i]['email'], "</td>";
        if ($sviKorisnici[$i]['tip_id'] == 0) {
            echo "<td> - </td>";
        } else {
            echo '<td><a href="updateKorisnik.php?id=', $sviKorisnici[$i]['korisnik_id'], '">Ažuriraj</a></td>';
        }
        echo "</tr>";
    }
}

function getVoditelje($con)
{
    $sql = "SELECT `korisnik_id`,CONCAT(`ime`,' ', `prezime`) AS voditelj FROM korisnik WHERE  tip_id = 1 ";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $korisnik[] = array(
            "korisnik_id" => $row['korisnik_id'],
            "voditelj" => $row['voditelj']
        );
    }
    mysqli_free_result($result);
    return $korisnik;
}

function showVoditeljeU($con,$id)
{
    $voditelji = getVoditelje($con);
    echo '<label for="moder"><b>Moderator</b></label><br>';
    echo '<select id="moder" name="moder">';
    for ($i = 0; $i < count($voditelji); $i++) {
        if($id == $voditelji[$i]['korisnik_id'])
            echo '<option value="'.$voditelji[$i]['korisnik_id'].'" selected="selected">'.$voditelji[$i]['voditelj'].'</option>';
        else
            echo '<option value="'.$voditelji[$i]['korisnik_id'].'" >'.$voditelji[$i]['voditelj'].'</option>';
    }
    echo '</select><br>';
}

function showVoditelje($con)
{
    $voditelji = getVoditelje($con);
    echo '<label for="moder"><b>Moderator</b></label><br>';
    echo '<select id="moder" name="moder">';
    for ($i = 0; $i < count($voditelji); $i++) {
            echo '<option value="'.$voditelji[$i]['korisnik_id'].'" >'.$voditelji[$i]['voditelj'].'</option>';
    }
    echo '</select><br>';
}