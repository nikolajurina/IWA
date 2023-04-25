<?php
include 'connect.php';

function getSvePredmete($con)
{
    $sql = 'SELECT * FROM `predmet`';
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $sviPredmeti[] = array(
            "predmet_id" => $row['predmet_id'],
            "aukcija_id" => $row['aukcija_id'],
            "korisnik_id" => $row['korisnik_id'],
            "naziv" => $row['naziv'],
            "opis" => $row['opis'],
            "slika" => $row['slika'],
            "pocetna_cijena" => $row['pocetna_cijena']
        );
    }
    mysqli_free_result($result);
    return $sviPredmeti;
}


function getPredmetiAukcijeById($con, $aId)
{
    $sql = "SELECT COUNT(po.`predmet_id`) as broj, pr.`slika` as slika, pr.`naziv` as naziv, MAX(po.`iznos_ponude`) as iznos_ponude,pr.`predmet_id` AS predmet_id FROM `predmet` pr,`ponuda` po WHERE pr.`aukcija_id` = " . $aId . " and pr.`predmet_id` = po.`predmet_id` GROUP BY po.`predmet_id`";
    $result = mysqli_query($con, $sql);
    $predmetiAukcijeById = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $predmetiAukcijeById[] = array(
            "broj" => $row['broj'],
            "slika" => $row['slika'],
            "naziv" => $row['naziv'],
            "iznos_ponude" => $row['iznos_ponude'],
            "predmet_id" => $row['predmet_id']
        );
    }
    mysqli_free_result($result);
    $sql = "SELECT '0 ' as broj,`slika`, `naziv`, `pocetna_cijena` AS iznos_ponude,`predmet_id` FROM `predmet` WHERE `aukcija_id` = ".$aId." AND `predmet_id` NOT IN (SELECT `predmet_id` FROM `ponuda`)";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $predmetiAukcijeById[] = array(
            "broj" => $row['broj'],
            "slika" => $row['slika'],
            "naziv" => $row['naziv'],
            "iznos_ponude" => $row['iznos_ponude']." (početna cijena)",
            "predmet_id" => $row['predmet_id']
        );
    }
    mysqli_free_result($result);
    return $predmetiAukcijeById;
}

function showPredmetiAukcijeById($con, $aId)
{
    $predmetiAukcijeById = getPredmetiAukcijeById($con, $aId);
    if ($predmetiAukcijeById != false) {
        echo '<tr >' .
            '<th > Predmet</th >' .
            '<th > Trenutna ponuda(KN) </th >' .
            '<th > Broj ponuda </th >' .
            '<th > Ponuda</th >' .
            '</tr >';
        for ($i = 0; $i < count($predmetiAukcijeById); $i++) {
            echo "<tr>";
            echo '<td><img src="', $predmetiAukcijeById[$i]['slika'], '"alt="slika" height="42" width="42"> ', $predmetiAukcijeById[$i]['naziv'], '</td>';
            echo "<td>", $predmetiAukcijeById[$i]['iznos_ponude'], "</td>";
            echo "<td>", $predmetiAukcijeById[$i]['broj'], "</td>";
            if(isSessionSet()){echo '<td><a href="bidding.php?id=', $predmetiAukcijeById[$i]['predmet_id'], '">Postavi ponudu</a></td>';}else{echo '<td> - </td>';}
            echo "</tr>";
        }
    } else {
        echo 'Trenutno nemamo taj predmet.';
    }
}

function getPredmetAukcijeById($con, $predmetId)
{
    $sql = "SELECT pr.`naziv`, pr.`slika`,pr.`opis`,pr.`pocetna_cijena`, MAX(po.`iznos_ponude`) AS zadnja_cijena FROM `predmet` pr, `ponuda` po WHERE pr.`predmet_id` = po.`predmet_id` AND po.`predmet_id` =" . $predmetId . " ORDER BY po.`iznos_ponude` DESC LIMIT 1";
    $result = mysqli_query($con, $sql);
    $predmetAukcijeById = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $predmetAukcijeById = array(
            "naziv" => $row['naziv'],
            "slika" => $row['slika'],
            "opis" => $row['opis'],
            "pocetna_cijena" => $row['pocetna_cijena'],
            "zadnja_cijena" => $row['zadnja_cijena']
        );
    }
    mysqli_free_result($result);
    return $predmetAukcijeById;
}

