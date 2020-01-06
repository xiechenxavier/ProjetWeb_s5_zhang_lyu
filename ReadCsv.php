<?php

$product_json_arr = $_POST['Datascsv']; //get tableau
$String = json_encode($product_json_arr, JSON_UNESCAPED_UNICODE);
$Str2 = substr($String, 0, strlen($String) - 1);
$Str = substr($Str2, 1);
$arr_json = explode("},", $Str);
//lire le fichier csv

$file = "./FirstPart/ResultatsFestival.csv";

function parse_csv($filePath) {
    $handle = fopen($filePath, 'r');
    $out = array();

    $n = 0;
    while ($data = fgetcsv($handle, 10000)) {
        $num = count($data);
        for ($i = 0; $i < $num; $i++) {
            $out[$n][$i] = $data[$i];
        }
        $n++;
    }
    fclose($handle);

    return $out;
}

$arr_csv = parse_csv($file);
for ($i = 0; $i < count($arr_json); $i++) {//le tableau Json envoye par Ajax
    $sous_Arr = json_decode($arr_json[$i], true); //enregistre la chaine JSON dans un tableau
    $x = 0;
    $flag = FALSE; // Juger s'il est trouvé qu'il est initialisé à chaque fois qu'il remplace une chaîne JSON
//    $z = 0;
    while ($x < count($arr_csv) && $flag === FALSE) {
        $Val = $arr_csv[$x]; // Tableau de cette ligne de données
        for ($i = 0; $i < count($Val); $i++) {
            if ($Val[1] == "Heure") {//sauf que la tete de toutes les colones
                continue;
            }
            //Après avoir trouvé cette ligne de données
            if ($Val[0] === $sous_Arr["date"] && $Val[2] === $sous_Arr["name"] && $Val[3] === $sous_Arr["lieu"] && $Val[4] === $sous_Arr["ville"]) {
                $flag = TRUE;
                break;
            }
        }
        $x++;
    }
    if ($flag) {
        $Plein_tarif = $arr_csv[$x - 1][6] + $sous_Arr["Plein_tarif"]; //
        $Tarif_reduit = $arr_csv[$x - 1][7] + $sous_Arr["Tarif_reduit"];
        $Billet_offert = $arr_csv[$x - 1][8] + $sous_Arr["Billet_offert"];
        $Enfant_gratuit = $arr_csv[$x - 1][11] + $sous_Arr["Enfant_gratuit"];
        $arr_csv[$x - 1][6] = $Plein_tarif;
        $arr_csv[$x - 1][7] = $Tarif_reduit;
        $arr_csv[$x - 1][8] = $Billet_offert;
        $arr_csv[$x - 1][11] = $Enfant_gratuit;
        continue; //S'il est trouvé, continuez. Cela signifie traiter les prochaines données de chaîne JSON.
    } else {
        $arrayadd = [$sous_Arr["date"],
            $sous_Arr["heure"],
            $sous_Arr["name"],
            $sous_Arr["lieu"],
            $sous_Arr["ville"],
            $sous_Arr["Compagnie"],
            $sous_Arr["Plein_tarif"],
            $sous_Arr["Tarif_reduit"],
            $sous_Arr["Billet_offert"],
            0,
            0,
            $sous_data["Enfant_gratuit"]];
        array_push($arr_csv, $arrayadd);
    }
}
$fp = fopen($file, 'w');
foreach ($arr_csv as $Val) {
    fputcsv($fp, $Val);
}
fclose($fp);
?>  
