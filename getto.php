<?php

include './index.php';
$adr = $_GET['url'];
$url="";
    if($adr==='notre Accueil'){
        $url="Accueil.php";
    }
    if($adr==="les lieus"){
        $url="LieuParLieu.php";
    }
Header("Location:$url");
?>