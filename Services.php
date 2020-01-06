<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './Tableaus.php';
include_once './Fonctions.php';
header("Content-type:text/html;charset=utf-8");
static $tab_enr = []; //tableau d'enregistrement qui permet d'enregistrer les spectacles possibles
/* Services importants */
//les fonctions qui permettent de traiter les données saisi à partir de formulaires
$fs = new Fonctions();
$tab = Tableaus::createtable();
if (!empty($_POST['d_lieu']) && !empty($_POST['a_lieu']) && !empty($_POST['Date']) && !empty($_POST['heure'])) {
    $la1 = explode(" ", $_POST["a_lieu"]);
//    $ld=explode(" ",$_POST["d_lieu"]);
    $lieud = $_POST["d_lieu"];
    $lieua = $_POST["a_lieu"];
    $Dist_temps = $fs->getDistanceTempsdesLieus($lieud, $lieua); // Obtenez la distance entre deux villes
    $TempsBesoin = $fs->getTemps_DistanceEtTemps($Dist_temps); //Le temps nécessaire pour obtenir les deux places (à partir de la chaîne * place-time)
    $HeureArrive = $fs->CalculateTime($TempsBesoin, $_POST['heure']); // Calculez l'heure à laquelle le client arrive au théâtre
    $formal_date = $_POST['Date']; // obtenir la date
    $date_v = $fs->ReformerDate($formal_date); // Reformatez la date obtenue pour l'impression et le traitement ultérieurs
    $arr = $tab["$lieua"]; // La ville arrivée traite toutes les informations qui remplissent les conditions et les imprime en fonction de toutes les informations stockées dans le tableau

    /** Lire toutes les commandes (commandes) du stockage existant, c'est-à-dire lire toutes les commandes stockées dans newfile.txt */
    /** Ici pour optimatiser la facon de lire la contenu d'une fichier on fait la lecture ligne par ligne */
    $file_path = "./newfile.txt";
    $arr_details_Elem = []; //Un tableau multidimensionnel pour contenir chaque tableau d'informations divisé
    if (file_exists($file_path)) {
        $file_arr = file($file_path); //Obtention d'un tableau pour lire le contenu de chaque ligne
        if (!empty($file_arr)) {
            $first_details_Elem = explode("*", $file_arr[0]); //separer les infos par * et stocker dans un tableau
            $first_key_city = array_shift($first_details_Elem); //obtenir la ville(l'indice et 0)
            $arr_details_Elem[$first_key_city] = []; //initialiser ce tableau
            array_push($arr_details_Elem[$first_key_city], $first_details_Elem);
            for ($i = 1; $i < count($file_arr); $i++) {//Décomposer le contenu du fichier ligne par ligne
                $details_Elem = explode("*", $file_arr[$i]); //Stockez tous les tableaux détaillés de chaque ligne dans le tableau
                $curr_key_city = array_shift($details_Elem);
                //La clé existe ou n'existe pas dans le grand tableau, nous devons l'ajouter au sous-tableau correspondant à cette clé
                /* S'il n'existe pas, il crée la clé puis ajoute la valeur; s'il existe, il est ajouté directement */
                if (array_key_exists("$curr_key_city", $arr_details_Elem)) {
                    array_push($arr_details_Elem[$curr_key_city], $details_Elem);
                } else {
                    $arr_details_Elem[$curr_key_city] = [];
                    array_push($arr_details_Elem[$curr_key_city], $details_Elem);
                }
            }
        }
    }
    //Ici, cela indique que les informations de commande ont été stockées dans le tableau dans l'état actuel. Ensuite, il commence à déterminer si les villes sont les mêmes.
    if (array_key_exists("$lieua", $arr_details_Elem)) {//Cette clé existe déjà, indiquant la même ville, le spectacle restant de l'emplacement est affiché
        $arr_infos_spect_parcity = $arr_details_Elem["$lieua"]; //Obtenez un tableau d'informations sur tous les jeux à cet endroit
        $arr_name_spectacles = [];
        $arr_JH_spectacles = [];
        foreach ($arr_infos_spect_parcity as $value) {
            array_push($arr_name_spectacles, $value[2]);
            array_push($arr_JH_spectacles, $value[1]);
        }
        foreach ($arr as $key => $value) {
            echo "<div class=SpectsPart><h3><Lieu>" . $key . "</Lieu>";
            foreach ($value as $cle => $val) {
                if ($cle == $date_v) {
                    echo "&nbsp le &nbsp" . $cle . "</h3>";
                    foreach ($val as $p_cle => $val2) {
                        $res = $fs->comparerDeuxTemps($HeureArrive, $val2["Heure"]);
                        if ($res > 0) {//Indique que vous n'êtes pas en retard
                            $isin = in_array($val2['spectateur'], $arr_name_spectacles);
                            $isin2 = in_array($val2["Jour"] . " " . $val2["Heure"], $arr_JH_spectacles);
                            if (!$isin && !$isin2) {
                                echo "<p class='spect_dispo'>" . "<label class='Day_time'>" . $val2["Jour"] . " " . $val2["Heure"] . '</label>' . " " . '<label class="tit_spect">' .
                                $val2["title"] . '</label>' . " de " . '<label class="spec_acteur">' . $val2["spectateur"] . '</label>';
                                echo "&nbsp<img class='btn_reserv' src='./images/plus.png'/>" . "</p>";
                            }
                        }
                    }
                    echo "<br><br>";
                }
            }
            echo "</div>";
        }
    } else {//Si différent ou si la page n'existe pas, exécutez
        /** Ici, je commence à juger s'il existe la même ville que la ville actuellement sélectionnée en fonction du contenu stocké:
         * 1. Si les mêmes villes existent, considérez la question du temps hors service
         * 2. S'il n'y a pas la même ville que le billet déjà acheté, vous devez considérer la question du temps, puis éliminer les conflits d'heure.     
         */
        foreach ($arr as $key => $value) {
            echo "<div class=SpectsPart><h3><Lieu>" . $key . "</Lieu>";
            foreach ($value as $cle => $val) {
                if ($cle == $date_v) {
                    echo "&nbsp le &nbsp" . $cle . "</h3>";
                    foreach ($val as $p_cle => $val2) {
                        $res = $fs->comparerDeuxTemps($HeureArrive, $val2["Heure"]);
                        if ($res > 0) {//Indique que vous n'êtes pas en retard
                            array_push($tab_enr, $val2["title"]);
                            echo "<p class='spect_dispo'>" . "<label class='Day_time'>" . $val2["Jour"] . " " . $val2["Heure"] . '</label>' . " " . '<label class="tit_spect">' .
                            $val2["title"] . '</label>' . " de " . '<label class="spec_acteur">' . $val2["spectateur"] . '</label>';
                            echo "&nbsp<img class='btn_reserv' src='./images/plus.png'/>" . "</p>";
                        }
                    }
                    echo "<br><br>";
                }
            }
            echo "</div>";
        }
    }
}    