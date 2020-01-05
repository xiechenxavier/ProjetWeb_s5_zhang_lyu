<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

function getRealDate($Date) {
    $Str_Date = explode(" ", $Date);
    $real_date = "";
    for ($i = 1; $i < count($Str_Date) - 1; $i++) {
        $real_date .= $Str_Date[$i] . " ";
    }
    $real_date .= $Str_Date[count($Str_Date) - 1]; //真正日期的写法,这是第一个日期
    return $real_date;
}

//get quel jour
function getRealJour($Date) {
    $Str_Date = explode(" ", $Date);
    return $Str_Date[0];
}

//获取了每一行的数据，然后开始分类
$arr = parse_csv("./FirstPart/ResultatsFestival.csv");

$sous_arr_start = $arr[1]; //以第一行的各个数据为基准点，进行创建多维数组

$Date1 = $sous_arr_start[0];
$res_date1 = getRealDate($Date1); //la vraie date 第一个日期
$res_jour = getRealJour($Date1); //le vrai jour 星期几
$ville = $sous_arr_start[4]; //第一个城市，所以所有城市的下标都是4
$Lieu = $sous_arr_start[3]; //第一个lieu，所以所有地点的下标都是3
$tableau_mult = []; //这个是一个四维的数组，计划以城市，地点以及日期进行分类
$mini_arr1 = []; //这是一个需要反复初始化的数组
$mini_arr1["Jour"] = $res_jour;
$mini_arr1["Heure"] = $sous_arr_start[1];
$mini_arr1["title"] = $sous_arr_start[2];
$mini_arr1["spectateur"] = $sous_arr_start[5];

$tableau_mult[$ville][$Lieu][$res_date1] = [];

array_push($tableau_mult[$ville][$Lieu][$res_date1], $mini_arr1);

for ($i = 2; $i < count($arr); $i++) {
    $curr_ville = $arr[$i][4];
    $curr_date = getRealDate($arr[$i][0]);
    $curr_jour = getRealJour($arr[$i][0]);
    $curr_lieu = $arr[$i][3];
    $curr_Heure = $arr[$i][1];
    $curr_title = $arr[$i][2];
    $curr_spectateur = $arr[$i][5];
    $mini_arr = []; //这是一个需要反复初始化的数组
    $mini_arr["Jour"] = $curr_jour;
    $mini_arr["Heure"] = $curr_Heure;
    $mini_arr["title"] = $curr_title;
    $mini_arr["spectateur"] = $curr_spectateur;
    if (array_key_exists($curr_ville, $tableau_mult)) {//如果这个城市已经存在于数组中
        if (array_key_exists($curr_lieu, $tableau_mult[$curr_ville])) {
            if (array_key_exists($curr_date, $tableau_mult[$curr_ville][$curr_lieu])) {
                array_push($tableau_mult[$curr_ville][$curr_lieu][$curr_date], $mini_arr);
            } else {
                $tableau_mult[$curr_ville][$curr_lieu][$curr_date] = []; //这个日期还不存在，现在存在了
                array_push($tableau_mult[$curr_ville][$curr_lieu][$curr_date], $mini_arr);
            }
        } else {//这个lieu还不存在
            $tableau_mult[$curr_ville][$curr_lieu] = []; //创建这个地点,这个地点是一个数组
            $tableau_mult[$curr_ville][$curr_lieu][$curr_date] = [];
            array_push($tableau_mult[$curr_ville][$curr_lieu][$curr_date], $mini_arr);
        }
    } else {//城市不存在
        $tableau_mult[$curr_ville] = [];
        $tableau_mult[$curr_ville][$curr_lieu] = [];
        $tableau_mult[$curr_ville][$curr_lieu][$curr_date] = [];
        array_push($tableau_mult[$curr_ville][$curr_lieu][$curr_date], $mini_arr);
    }
}
print_r($tableau_mult);
