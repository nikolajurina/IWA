<?php
include 'connect.php';

function getSveAukcije($con)
{
    $sql = 'SELECT * FROM `aukcija`';
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $sveAukcije[] = array(
            "aukcija_id" => $row['aukcija_id'],
            "moderator_id" => $row['moderator_id'],
            "naziv" => $row['naziv'],
            "opis" => $row['opis'],
            "datum_vrijeme_pocetka" => $row['datum_vrijeme_pocetka'],
            "datum_vrijeme_zavrsetka" => $row['datum_vrijeme_zavrsetka']
        );
    }
    mysqli_free_result($result);
    return $sveAukcije;
}

function getMojeZatvAukcije($con, $id)
{
    $sql = " SELECT * FROM(SELECT a.`naziv` AS aukcija, pr.`naziv` AS predmet, po.`iznos_ponude`, k.`korisnicko_ime`, po.`datum_vrijeme_ponude` FROM `aukcija` a, `predmet` pr, `ponuda` po, `korisnik` k WHERE k.`korisnik_id` = po.`korisnik_id` AND a.`aukcija_id` = pr.`aukcija_id` AND pr.`predmet_id` = po.`predmet_id` AND a.`datum_vrijeme_zavrsetka` < NOW() AND pr.`korisnik_id` = " . $id . " ORDER BY po.`iznos_ponude` DESC, po.`datum_vrijeme_ponude`) AS SVE_PONUDE GROUP BY aukcija";
    $result = mysqli_query($con, $sql);
    $mojeZatvAukcije = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $mojeZatvAukcije[] = array(
            "aukcija" => $row['aukcija'],
            "predmet" => $row['predmet'],
            "iznos_ponude" => $row['iznos_ponude'] . " HRK",
            "korisnicko_ime" => $row['korisnicko_ime'],
            "datum_vrijeme_ponude" => $row['datum_vrijeme_ponude']
        );
    }
    mysqli_free_result($result);
    return $mojeZatvAukcije;
}

function getMojeAukcije($con, $id)
{
    $sql = "SELECT * FROM `aukcija` WHERE `aukcija_id` =".$id;
    $result = mysqli_query($con, $sql);
    $aukc = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $aukc[] = array(
            "naziv" => $row['naziv'],
            "opis" => $row['opis'],
            "datum_vrijeme_pocetka" => $row['datum_vrijeme_pocetka'],
            "datum_vrijeme_zavrsetka" => $row['datum_vrijeme_zavrsetka'],
            "moderator_id" => $row['moderator_id']
        );
    }
    mysqli_free_result($result);
    return $aukc;
}

function getOtvoreneAukcije($con)
{
    $sql = 'SELECT a.`naziv`, a.`opis` , COUNT(*) AS `kolicina_predmeta`, a.`datum_vrijeme_zavrsetka`,a.`aukcija_id` as id FROM `aukcija` a, `predmet` p WHERE a.`aukcija_id` = p.`aukcija_id` AND a.`datum_vrijeme_zavrsetka` > NOW() GROUP BY a.`naziv` ORDER BY a.`datum_vrijeme_zavrsetka` DESC';
    $result = mysqli_query($con, $sql);
    $otvoreneAukcije = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $otvoreneAukcije[] = array(
            "naziv" => $row['naziv'],
            "opis" => $row['opis'],
            "kolicina_predmeta" => $row['kolicina_predmeta'],
            "datum_vrijeme_zavrsetka" => $row['datum_vrijeme_zavrsetka'],
            "id" => $row['id']
        );
    }
    mysqli_free_result($result);
    return $otvoreneAukcije;
}

function getStanjeMojihPonuda($con, $idKorisnika)
{
    $sql = 'SELECT a.`naziv` AS aukcija,pr.`naziv` AS predmet,po.`iznos_ponude` AS moj_iznos, po.`datum_vrijeme_ponude` AS datump ,(SELECT MAX(`iznos_ponude`) AS iznos_ponude FROM `ponuda` WHERE `predmet_id` = pr.`predmet_id`) AS stanje,a.`datum_vrijeme_zavrsetka` AS zavrsetak,pr.`predmet_id` AS predmet_id FROM `aukcija` a, `predmet` pr, `ponuda` po WHERE a.`aukcija_id` = pr.`aukcija_id` AND pr.`predmet_id` = po.`predmet_id` AND a.`datum_vrijeme_zavrsetka` > NOW() AND po.`korisnik_id` =' . $idKorisnika;
    $result = mysqli_query($con, $sql);
    $stanjeMojihPonuda = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $stanjeMojihPonuda[] = array(
            "aukcija" => $row['aukcija'],
            "predmet" => $row['predmet'],
            "moj_iznos" => $row['moj_iznos'],
            "datump" => $row['datump'],
            "stanje" => $row['stanje'],
            "zavrsetak" => $row['zavrsetak'],
            "predmet_id" => $row['predmet_id']
        );
    }
    mysqli_free_result($result);
    return $stanjeMojihPonuda;
}

function showStanjeMojihPonuda($con, $idKorisnika)
{
    $stanjeMojihPonuda = getStanjeMojihPonuda($con, $idKorisnika);
    if ($stanjeMojihPonuda != false) {
        echo '<tr>' .
            '<th>Aukcija</th>' .
            '<th>Predmet</th>' .
            '<th>Moja ponuda</th>' .
            '<th>Datum ponude</th>' .
            '<th>Stanje</th>' .
            '<th>Završetak aukcije</th>' .
            '<th>Akcija</th>' .
            '</tr>';
        for ($i = 0; $i < count($stanjeMojihPonuda); $i++) {
            echo "<tr>";
            echo "<td>", $stanjeMojihPonuda[$i]['aukcija'], "</td>";
            echo "<td>", $stanjeMojihPonuda[$i]['predmet'], "</td>";
            echo "<td>", $stanjeMojihPonuda[$i]['moj_iznos'], "</td>";
            echo "<td>", dateToHrFormat( $stanjeMojihPonuda[$i]['datump'] ), "</td>";
            echo "<td>", $stanjeMojihPonuda[$i]['stanje'], "</td>";
            echo "<td>", dateToHrFormat( $stanjeMojihPonuda[$i]['zavrsetak'] ), "</td>";
            echo '<td><a href="bidding.php?id=', $stanjeMojihPonuda[$i]['predmet_id'], '">Postavi ponudu</a></td>';
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td>Trenutno nema ponuda.</td>";
        echo "</tr>";
    }
}

function showPopisSvihAukcija($con)
{
    $psAukcija = getSveAukcije($con);

    for ($i = 0; $i < count($psAukcija); $i++) {
        echo "<tr>";
        echo "<td>", $psAukcija[$i]['naziv'], "</td>";
        echo "<td>", $psAukcija[$i]['opis'], "</td>";
        echo "<td>", dateToHrFormat( $psAukcija[$i]['datum_vrijeme_pocetka'] ), "</td>";
        echo "<td>", dateToHrFormat( $psAukcija[$i]['datum_vrijeme_zavrsetka'] ), "</td>";
        echo "</tr>";
    }
}


function getAukcijeEdit($con)
{
    $sql = "SELECT a.`aukcija_id`,(SELECT CONCAT(k.`ime`, ' ',k.`prezime`) AS moderator FROM `korisnik` k WHERE k.`korisnik_id` =  a.`moderator_id`) AS moderator, a.`naziv`, a.`opis`, a.`datum_vrijeme_zavrsetka` FROM `aukcija` a";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $aukcijeEdit[] = array(
            "aukcija_id" => $row['aukcija_id'],
            "moderator" => $row['moderator'],
            "naziv" => $row['naziv'],
            "opis" => $row['opis'],
            "datum_vrijeme_zavrsetka" => $row['datum_vrijeme_zavrsetka']
        );
    }
    mysqli_free_result($result);
    return $aukcijeEdit;
}

function showAukcijeEditM($con,$id)
{
    $editAukcija = getAukcijeEditM($con,$id);

    for ($i = 0; $i < count($editAukcija); $i++) {
        echo "<tr>";
        echo "<td>", $editAukcija[$i]['naziv'], "</td>";
        echo "<td>", $editAukcija[$i]['opis'], "</td>";
        echo "<td>", $editAukcija[$i]['moderator'], "</td>";
        echo "<td>", dateToHrFormat( $editAukcija[$i]['datum_vrijeme_zavrsetka'] ), "</td>";
        echo '<td><a href="urediAukcije.php?id=', $editAukcija[$i]['aukcija_id'], '">Ažuriraj</a></td>';
        echo "</tr>";
    }
}

function getAukcijeEditM($con,$id)
{
    $sql = "SELECT a.`aukcija_id`,(SELECT CONCAT(k.`ime`, ' ',k.`prezime`) AS moderator FROM `korisnik` k WHERE k.`korisnik_id` =  a.`moderator_id`) AS moderator, a.`naziv`, a.`opis`, a.`datum_vrijeme_zavrsetka` FROM `aukcija` a WHERE a.moderator_id =".$id;
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $aukcijeEdit[] = array(
            "aukcija_id" => $row['aukcija_id'],
            "moderator" => $row['moderator'],
            "naziv" => $row['naziv'],
            "opis" => $row['opis'],
            "datum_vrijeme_zavrsetka" => $row['datum_vrijeme_zavrsetka']
        );
    }
    mysqli_free_result($result);
    return $aukcijeEdit;
}

function showAukcijeEdit($con)
{
    $editAukcija = getAukcijeEdit($con);

    for ($i = 0; $i < count($editAukcija); $i++) {
        echo "<tr>";
        echo "<td>", $editAukcija[$i]['naziv'], "</td>";
        echo "<td>", $editAukcija[$i]['opis'], "</td>";
        echo "<td>", $editAukcija[$i]['moderator'], "</td>";
        echo "<td>", dateToHrFormat( $editAukcija[$i]['datum_vrijeme_zavrsetka'] ), "</td>";
        echo '<td><a href="urediAukcije.php?id=', $editAukcija[$i]['aukcija_id'], '">Ažuriraj</a></td>';
        echo "</tr>";
    }
}

function showMojeZatvAukcije($con, $id)
{
    $mzAukcije = getMojeZatvAukcije($con, $id);
    if ($mzAukcije != false) {
        echo "<tr><th>Aukcija</th><th>Predmet</th><th>Dobitnik</th><th>Konačna cijena</th></tr>";
        for ($i = 0; $i < count($mzAukcije); $i++) {
            echo "<tr>";
            echo "<td>", $mzAukcije[$i]['aukcija'], "</td>";
            echo "<td>", $mzAukcije[$i]['predmet'], "</td>";
            echo "<td>", $mzAukcije[$i]['korisnicko_ime'], "</td>";
            echo "<td>", $mzAukcije[$i]['iznos_ponude'], "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td>Trenutno nemate završenih aukcija.</td>";
        echo "</tr>";
    }
}

function showOtvoreneAukcije($con)
{
    $otvoreneAukcije = getOtvoreneAukcije($con);
    if ($otvoreneAukcije != false) {
        echo '<tr>' .
            '<th>Naziv</th>' .
            '<th>Opis</th>' .
            '<th>Broj predmeta:</th>' .
            '<th>Završetak:</th>' .
            '<th></th>' .
            '</tr>';
        for ($i = 0; $i < count($otvoreneAukcije); $i++) {
            echo "<tr>";
            echo "<td>", $otvoreneAukcije[$i]['naziv'], "</td>";
            echo "<td>", $otvoreneAukcije[$i]['opis'], "</td>";
            echo "<td>", $otvoreneAukcije[$i]['kolicina_predmeta'], "</td>";
            echo "<td>", dateToHrFormat( $otvoreneAukcije[$i]['datum_vrijeme_zavrsetka'] ), "</td>";
            echo '<td><a href="predmetiAukcije.php?id=', $otvoreneAukcije[$i]['id'], '">Detalji</a></td>';
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td>Trenutno nema otvorenih aukcija.</td>";
        echo "</tr>";
    }
}

