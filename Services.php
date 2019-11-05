<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './Tableaus.php';
include_once './Reservation.php';
include_once './Fonctions.php';

$fs = new Fonctions();
$tab = Tableaus::$table1;
if (!empty($_POST['d_lieu']) && !empty($_POST['a_lieu']) && !empty($_POST['Date'])&&!empty($_POST['heure'])) {
    $lieua = $_POST['a_lieu']; //lieu arrive
    $lieud = $_POST['d_lieu']; //lieu depart
    $Dist_temps = $fs->getDistanceTempsdesLieus($lieud, $lieua);
    $TempsBesoin = $fs->getTemps_DistanceEtTemps($Dist_temps);
    $HeureArrive = $fs->CalculateTime($TempsBesoin,$_POST['heure']);
    $formal_date = $_POST['Date'];
    $date_v = $fs->ReformerDate($formal_date);
    $arr = $tab["$lieua"];
    echo "<div class='theatre'>";
    foreach ($arr as $key => $value) {
        echo $key;
        foreach ($value as $cle => $val) {
            if ($cle == $date_v) {
                echo "&nbsp le &nbsp" . $cle;
                foreach ($val as $p_cle => $val2) {
                    $res = $fs->comparerDeuxTemps($HeureArrive, $val2["Heure"]);
                    if ($res > 0) {//表示没有迟到
                        echo "<p>" . $val2["Jour"] . " " . $val2["Heure"] . " " . $val2["title"] . " de " . $val2["spectateur"];
                        //$racine = $this->Path();
                        //$racine .= "ReservationForm";
                        echo "&nbsp<button><a href='#' style='color:black;text-decoration:none'>Reserver</a></button>" . "</p>";
                    }
                }
                echo "<br><br>";
            }
        }
    }
    echo "</div>";
}
   // }

  

