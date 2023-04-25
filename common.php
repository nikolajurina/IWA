<?php
function datumVrijeme($datum, $vrijeme){
    $datum = trim($datum);
    $vrijeme = trim($vrijeme);

    $d = explode(".", $datum);
    $v = explode(":", $vrijeme);
    if (count($d) != 3 || count($v) != 3) return false;

    if (strlen($d[0]) != 2 || strlen($d[1]) != 2 || strlen($d[2]) != 4 || strlen($v[0]) != 2 || strlen($v[1]) != 2 || strlen($v[2]) != 2) return false;

    if (!checkdate((int)$d[1], (int)$d[0], (int)$d[2])) return false;

    if ((int)$v[0] < 0 || (int)$v[0] >=24 || (int)$v[1] < 0 || (int)$v[1] >= 60 ||  (int)$v[2] < 0 || (int)$v[2] >= 60) return false;

    return $d[2] . '-' . $d[1] . '-' . $d[0] . ' ' . $v[0] . ':' . $v[1] . ':' . $v[2];
}

function showMessage($message){
    if(isset($message['message']) && !empty($message['message'])){
        echo '<p class="message">'.$message['message'].'</p>';
    }
}

function dateToHrFormat($dateFromDB){
    $date = date_create($dateFromDB);
    return date_format($date, "d.m.Y H:i:s");
}
function dateOnlyToHrFormat($dateFromDB){
    $date = date_create($dateFromDB);
    return date_format($date, "d.m.Y");
}

function timeOnlyToHrFormat($dateFromDB){
    $date = date_create($dateFromDB);
    return date_format($date, " H:i:s");
}
