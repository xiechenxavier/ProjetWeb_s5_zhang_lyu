<?php

$product_json_arr = $_POST['Datascsv']; //获取数组  
$String = json_encode($product_json_arr, JSON_UNESCAPED_UNICODE);
$Str2 = substr($String, 0, strlen($str) - 1);
$Str = substr($Str2, 1);
$arr_json = explode("},", $Str);
//读取原有的csv文件

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
for ($i = 0; $i < count($arr_json); $i++) {//传过来的JSON数据数组
    $sous_Arr = json_decode($arr_json[$i], true); //每一个json字符串化为数组
    $x = 0;
    $flag = false; //判断有没有找到每次换一个JSON字符串时初始化一次
    while ($x < count($arr_csv) && $flag === false) {
        $Val = $arr_csv[i]; //这一行数据的数组
        for ($i = 0; $i < count($Val); $i++) {
            if ($Val[1] == "Heure") {//除了第一行之外
                continue;
            }
            //找到这一行数据之后
            if (strpos($Val[0], $sous_Arr["date"]) !== false && $Val[2] === $sous_Arr["name"] && $Val[3] === $sous_Arr["lieu"] && $Val[4] === $sous_Arr["ville"]) {
                $Plein_tarif = intval($Val[6]);
                $Tarif_reduit = intval($Val[7]);
                $Billet_offert = intval($Val[8]);
                $Enfant_gratuit = intval($Val[11]);
                $Val[6] = $Plein_tarif + intval($sous_Arr["Plein_tarif"]);
                $Val[7] = $Tarif_reduit + intval($sous_Arr["Tarif_reduit"]);
                $Val[8] = $Billet_offert + intval($sous_Arr["Billet_offert"]);
                $Val[11] = $Enfant_gratuit + intval($sous_Arr["Enfant_gratuit"]);
                $flag = true; //已经找到，根据这个值退出while循环
                break;
            }
        }
        $x++;
    }
    if ($flag) {
        continue; //如果找到了就continue这里代表去处理下一个JSON字符串数据
    } else {
        $arrayadd = [$sous_Arr["date"],
            $sous_Arr["heure"],
            $sous_Arr["name"],
            $sous_Arr["lieu"],
            $sous_Arr["ville"],
            "La Compagnie de l’Élan",
            $sous_Arr["Plein_tarif"],
            $sous_Arr["Tarif_reduit"],
            $sous_Arr["Billet_offert"],
            0,
            0,
            sous_data["Enfant_gratuit"]];
        array_push($arr_csv, $arrayadd);
    }
}
$fp = fopen($file, 'w');
foreach ($arr_csv as $Val) {
    fputcsv($fp, $Val);
    echo "ca marche";
}
fclose($fp);
?>  
