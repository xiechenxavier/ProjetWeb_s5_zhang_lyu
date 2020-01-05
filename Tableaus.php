<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tableaus {

    public static $dist_time = array(
        "Moulins" => array(
            "Moulins" => "0km/0h0",
            "Monétay" => "25km/0h30",
            "Vichy" => "69km/1h10",
            "Monteignet" => "91km/1h05",
            "Veauce" => "91km/1h08",
            "Clermont-Ferrand" => "98km/1h37"
        ),
        "Monétay" => array(
            "Moulins" => "25km/0h30",
            "Monétay" => "0km/0h0",
            "Vichy" => "39km/0h45",
            "Monteignet" => "33km/0h36",
            "Veauce" => "45km/0h42",
            "Clermont-Ferrand" => "107km/1h20"
        ),
        "Vichy" => array(
            "Moulins" => "69km/0h30",
            "Monétay" => "39km/0h45",
            "Vichy" => "0km/0h0",
            "Monteignet" => "18km/0h26",
            "Veauce" => "54km/0h58",
            "Clermont-Ferrand" => "56km/1h05"
        ),
        "Monteignet" => array(
            "Moulins" => "91km/1h05",
            "Monétay" => "33km/0h36",
            "Vichy" => "18km/0h26",
            "Monteignet" => "0km/0h0",
            "Veauce" => "22km/0h26",
            "Clermont-Ferrand" => "50km/0h55"
        ),
        "Veauce" => array(
            "Moulins" => "91km/1h08",
            "Monétay" => "45km/0h42",
            "Vichy" => "54km/0h58",
            "Monteignet" => "22km/0h26",
            "Veauce" => "0km/0h0",
            "Clermont-Ferrand" => "54km/0h45"
        ),
        "Clermont-Ferrand" => array(
            "Moulins" => "95km/1h37",
            "Monétay" => "107km/1h20",
            "Vichy" => "56km/1h05",
            "Monteignet" => "50km/0h55",
            "Veauce" => "54km/0h45",
            "Clermont-Ferrand" => "0km/0h0"
        )
    );

    static function parse_csv($filePath) {
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

    static function getRealDate($Date) {
        $Str_Date = explode(" ", $Date);
        $real_date = "";
        for ($i = 1; $i < count($Str_Date) - 1; $i++) {
            $real_date .= $Str_Date[$i] . " ";
        }
        $real_date .= $Str_Date[count($Str_Date) - 1]; //真正日期的写法,这是第一个日期
        return $real_date;
    }

//get quel jour
    static function getRealJour($Date) {
        $Str_Date = explode(" ", $Date);
        return $Str_Date[0];
    }

    public static function createtable() {
        //获取了每一行的数据，然后开始分类
        $arr = self::parse_csv("./FirstPart/ResultatsFestival.csv");

        $sous_arr_start = $arr[1]; //以第一行的各个数据为基准点，进行创建多维数组

        $Date1 = $sous_arr_start[0];
        $res_date1 = self::getRealDate($Date1); //la vraie date 第一个日期
        $res_jour = self::getRealJour($Date1); //le vrai jour 星期几
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
            $curr_date = self::getRealDate($arr[$i][0]);
            $curr_jour = self::getRealJour($arr[$i][0]);
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
                    $tableau_mult[$curr_ville][$curr_lieu] = []; //创建这个地点
                    $ff = [];
                    $ff[$curr_date] = [];
                    array_push($ff, $mini_arr);
                    array_push($tableau_mult[$curr_ville][$curr_lieu], $ff);
                }
            } else {//城市不存在
                $tableau_mult[$curr_ville] = [];
                $tab2_lieu = [];
                $ff = [];
                array_push($ff, $mini_arr);
                array_push($tab2_lieu, $ff);
                array_push($tableau_mult[$curr_ville], $tab2_lieu);
            }
        }
        return $tableau_mult;
    }

}
