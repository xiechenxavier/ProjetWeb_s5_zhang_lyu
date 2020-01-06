<?php

include './index.php';
$adr = $_GET['url'];
$url = "";
switch ($adr) {
    case 'notre Accueil':
        $url = "Accueil.php";
        break;
    case 'Programme par lieus':
        $url = "./FirstPart/LieuParLieu.php";
        break;
    case 'Programme par jour':
        $url = "./FirstPart/JourParJour.php";
        break;
    case 'Programme par Troupe':
        $url = "./FirstPart/TroupeParTroupe.php";
        break;
    case 'reserver les billes':
        $url = "Reservation.php";
        break;
    default :
        break;
}
Header("Location:$url");
?>