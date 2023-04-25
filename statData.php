<?php
include 'connect.php';
function getStats($con,$dv_p,$dv_z)
{
    $sql = "select a.`aukcija_id`, a.`naziv`, count(*) as broj_kupaca from `korisnik` k, `ponuda` po, `predmet` pr, `aukcija` a where a.`aukcija_id` = pr.`aukcija_id` and pr.`predmet_id` = po.`predmet_id` and k.`korisnik_id` = po.`korisnik_id` and a.`datum_vrijeme_zavrsetka` < NOW() and a.`datum_vrijeme_pocetka` between STR_TO_DATE('" . $dv_p . "','%Y-%m-%d %H:%i:%s') and STR_TO_DATE('" . $dv_z . "','%Y-%m-%d %H:%i:%s') group by a.`aukcija_id`";
    $result = mysqli_query($con, $sql);
    $stat = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $stat[] = array(
            "broj_kupaca" => $row['broj_kupaca'],
            "naziv" => $row['naziv'],
            "aukcija_id" => $row['aukcija_id'],
        );
    }
    mysqli_free_result($result);
    return $stat;
}
function getStats2($con,$dv_p,$dv_z)
{
    $sql = "SELECT COUNT(*) AS broj_prodavaca, a.`naziv` FROM `korisnik` k, `predmet` pr, `aukcija` a
WHERE a.`aukcija_id` = pr.`aukcija_id` AND k.`korisnik_id` = pr.`korisnik_id` 
AND a.`datum_vrijeme_zavrsetka` < NOW() 
AND a.`datum_vrijeme_pocetka` between STR_TO_DATE('" . $dv_p . "','%Y-%m-%d %H:%i:%s') and STR_TO_DATE('" . $dv_z . "','%Y-%m-%d %H:%i:%s')
GROUP BY a.`naziv`";
    $result = mysqli_query($con, $sql);
    $stat = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $stat[] = array(
            "naziv" => $row['naziv'],
            "broj_prodavaca" => $row['broj_prodavaca'],
        );
    }
    mysqli_free_result($result);
    return $stat;
}

function showStats($con,$dv_p,$dv_z)
{
    $stat = getStats($con,$dv_p,$dv_z);
    if ($stat != false) {
        echo '<table>';
        echo '<tr>' .
            '<th>Aukcija</th>' .
            '<th>Broj kupaca</th>' .
            '</tr>';
        for ($i = 0; $i < count($stat); $i++) {
            echo "<tr>";
            echo "<td>", $stat[$i]['naziv'], "</td>";
            echo "<td>", $stat[$i]['broj_kupaca'], "</td>";
            echo "</tr>";
        }
        echo '</table>';
    } else {
        echo '<table>';
        echo "<tr>";
        echo "<td>Trenutno nema podataka.</td>";
        echo "</tr>";
        echo '</table>';
    }
    $stat = getStats2($con,$dv_p,$dv_z);
    if ($stat != false) {
        echo '<table>';
        echo '<tr>' .
            '<th>Aukcija</th>' .
            '<th>Broj prodavac</th>' .
            '</tr>';
        for ($i = 0; $i < count($stat); $i++) {
            echo "<tr>";
            echo "<td>", $stat[$i]['naziv'], "</td>";
            echo "<td>", $stat[$i]['broj_prodavaca'], "</td>";
            echo "</tr>";
        }
        echo '</table>';
    } else {
        echo '<table>';
        echo "<tr>";
        echo "<td>Trenutno nema podataka.</td>";
        echo "</tr>";
        echo '</table>';
    }
}


