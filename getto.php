<?php

include './index.php';
$adr = $_GET['url'];
$url = "";
switch ($adr) {
    case 'notre Accueil':
        $url = "Accueil.php";
        break;
        ;
    case 'les lieus':
        $url = "LieuParLieu.php";
        break;
    case 'reserver les billes':
        $url = "Reservation.php";
        break;
    default :
        break;
}
Header("Location:$url");
?>