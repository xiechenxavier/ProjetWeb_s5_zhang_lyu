<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './Tableaus.php';
include_once './Reservation.php';
include_once './Fonctions.php';


static $tab_enr= [];//tableau d'enregistrement qui permet d'enregistrer les spectacles possibles
/*Services importants*/
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
        echo "<h3>".$key;
        foreach ($value as $cle => $val) {
            if ($cle == $date_v) {
                echo "&nbsp le &nbsp" . $cle."</h3>";
                foreach ($val as $p_cle => $val2) {
                    $res = $fs->comparerDeuxTemps($HeureArrive, $val2["Heure"]);
                    if ($res > 0) {//表示没有迟到
                        array_push($tab_enr, $val2["title"]);
                        echo "<p class='spect_dispo'>" .'<b>'. $val2["Jour"]. " " . $val2["Heure"] .'</b>'. " " .'<label class="tit_spect">'.
                                $val2["title"] .'</label>'. " de " .'<b><label>'. $val2["spectateur"].'</label></b>';
                        echo "&nbsp<button class='btn_reserv'>Reserver</button>" . "</p>";
                    }
                }
                echo "<br><br>";
            }
        }
    }
    echo "</div>";
}
   // }

  

