<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once "./Tableaus.php";

class Fonctions {
    function ReformerDate($date) {
        $res = "";
        $arr_date = array(
            '01' => "janvier",
            '02' => "feverier",
            '03' => "mars",
            '04' => "avril",
            '05' => "mai",
            '06' => "juin",
            '07' => "juille",
            '08' => "août",
            '09' => "septembre",
            '10' => "octobre",
            '11' => "novembre",
            '12' => "décembre"
        );
//if($this->CheckDate($date)){
        $arr = explode("/", $date); //12-02-2019=>12 02 2019
        $mois = $arr[0]; //
        $mois_fr = $arr_date[$mois];
        $res = $arr[1] . " " . $mois_fr . " " . $arr[2];
//}
        return $res;
    }

    /** @param $date c'est un date sous une forme qu'on definit
     *  @return boolean,si vrai cette date est sous la forme defini, false sinon.
     */
    /* function CheckDate($date) {
      if (date('d/m/Y', strtotime($date)) == $date) {
      return true;
      } else {
      return false;
      }
      } */

    /** @param String $d_lieu c'est le lieu de depart
     *  @param String $a_lieu c'est la lieu d'arrive
     *  @return String le distance et le temps à la voiture entre deux villes
     */
    function getDistanceTempsdesLieus($d_lieu, $a_lieu) {
        $tab = Tableaus::$dist_time;
        $res = "";
        if (isset($tab[$d_lieu][$a_lieu])) {
            $res = $tab[$d_lieu][$a_lieu];
        } else {
            throw new Exception("Erreur, le lieu existe pas");
        }
        return $res;
    }

    function getTemps_DistanceEtTemps($dist_time) {
        try {
            $dt_arr = explode("/", $dist_time);
            if (!isset($dt_arr)) {
                $res = NULL;
            } else {
                $res = $dt_arr[1];
            }
        } catch (Exception $ex) {
            echo "Erreur, $dist_time est pas sous le format correct <br>";
            echo 'Message' . $ex->getMessage();
        }
        return $res;
    }

    /** Comparer deux temps qui est plus avant ou tard
     * 
     */
    function comparerDeuxTemps($HeureArrive, $Heure) {
        try {
            $int_Ha = $this->TransformFormal($HeureArrive);
            $int_arrA = $this->TransformFormal($Heure);
            $res = 0;
//il existe deux conditions d'une situation:1.Arrive_H> H 2.Arrive_H=H && Arrive_M>M
            if ($int_Ha[0] > $int_arrA[0]) {
                $res = -1;
            } else if (($int_Ha[0] == $int_arrA[0]) && ($int_Ha[1] > $int_arrA[1])) {
                $res = -1;
            } else {
                $res = 1;
            }
        } catch (Exception $ex) {
            echo "Message" . $ex->getMessage();
        }
        return $res;
    }

    function TransformFormal($HeureArrive) {
        $int_arr = array();
        try {
            $ha_arr = explode("h", $HeureArrive);
            for ($i = 0; $i < 2; $i++) {
                $int = intval($ha_arr[$i]);
                array_push($int_arr, $int);
            }
        } catch (Exception $ex) {
            echo "Message" . $ex->getMessage();
        }
        return $int_arr;
    }

    /*     * afin de calculer le temp et retourne l'heure arrive */

    function CalculateTime($dist_time,$current_time) {
//        $current_time = date("H:i"); //get the current time by H:i
        $ct_arr = explode(":", $current_time); //traite the formal of time
        $int_arr = array(); //it's used to hold the hour and minute of current time
        $res = array(); //it's used to get the result after calculate
        for ($i = 0; $i < 2; $i++) {
            $int = intval($ct_arr[$i]);
            array_push($int_arr, $int);
        }
        try {
            $int_arr2 = $this->TransformFormal($dist_time); //it's used to hold teh hour and minute of spent time
            if ($int_arr[0] >= 17 && $int_arr[0] <= 19) {
                $int_arr2[1] *= 1.1;
                if ($int_arr2[1] >= 60) {
                    $int_arr2[0] += 1;
                    $int_arr2[1] -= 60;
                }
            }

            for ($i = 0; $i < 2; $i++) {
                $res[$i] = $int_arr[$i] + $int_arr2[$i];
            }
            if ($res[1] >= 60) {
                $res[0] += 1;
                $res[1] -= 60;
            }
        } catch (Exception $ex) {//if the formal is not correct, treat the Exception
            echo "Error,the formal is not correct<br>" . "Message: " . $ex->getMessage();
        }
        return $res[0] . "h" . $res[1];
    }

}
