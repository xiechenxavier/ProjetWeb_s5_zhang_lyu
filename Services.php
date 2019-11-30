<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './Tableaus.php';
include_once './Fonctions.php';
static $tab_enr = []; //tableau d'enregistrement qui permet d'enregistrer les spectacles possibles
/* Services importants */
//les fonctions qui permettent de traiter les données saisi à partir de formulaires
$fs = new Fonctions();
$tab = Tableaus::$table1;
if (!empty($_POST['d_lieu']) && !empty($_POST['a_lieu']) && !empty($_POST['Date']) && !empty($_POST['heure'])) {
    $lieua = $_POST['a_lieu']; //lieu arrivé
    $lieud = $_POST['d_lieu']; //lieu depart
    $Dist_temps = $fs->getDistanceTempsdesLieus($lieud, $lieua); //获取两个地点相隔的距离
    $TempsBesoin = $fs->getTemps_DistanceEtTemps($Dist_temps); //获取两地所需要的时间（从字符串*地点-时间中获取）
    $HeureArrive = $fs->CalculateTime($TempsBesoin, $_POST['heure']); //计算Client到达看戏地点的时间
    $formal_date = $_POST['Date']; //获得日期
    $date_v = $fs->ReformerDate($formal_date); //重新格式化获得的日期，方便后序打印和处理
    $arr = $tab["$lieua"]; //到达的城市根据数组中储存的所有信息来处理之后的满足条件的信息并打印
    /*     * 读取现有储存的所有订单（commandes）部分，也就是读取在newfile.txt中储存的所有订单 */
    /** Ici pour optimatiser la facon de lire la contenu d'une fichier on fait la lecture ligne par ligne */
    $file_path = "./newfile.txt";
    $arr_details_Elem = []; //一个二维数组，用来盛装每一个拆分后的信息数组
    if (file_exists($file_path)) {
        $file_arr = file($file_path); //获得了数组，方便读取每一行的内容
        if (!empty($file_arr)) {
            $first_details_Elem = explode("*", $file_arr[0]); //分成完整的信息
            $first_key_city = array_shift($first_details_Elem); //这个获取的就是下标为0的信息（城市）
            $arr_details_Elem[$first_key_city] = []; //初始化为空
            array_push($arr_details_Elem[$first_key_city], $first_details_Elem);
            for ($i = 1; $i < count($file_arr); $i++) {//逐行分解文件内容
                $details_Elem = explode("*", $file_arr[$i]); //把每一行的所有详细内容数组都存入数组中
                $curr_key_city = array_shift($details_Elem);
                //存在与不存在这个键在大数组中，我们都需要把它加入到对应这个键的子数组中
                /* 不存在就是创造键然后加入值；存在的话直接加入 */
                if (array_key_exists("$curr_key_city", $arr_details_Elem)) {
                    array_push($arr_details_Elem[$curr_key_city], $details_Elem);
                } else {
                    $arr_details_Elem[$curr_key_city] = [];
                    array_push($arr_details_Elem[$curr_key_city], $details_Elem);
                }
            }
        }
    }
    //到这里表示当前状态下的数组已经储存了的订单信息，接下来开始判断城市是否相同
    if (array_key_exists("$lieua", $arr_details_Elem)) {//说明已经存在这个键,表示相同城市，该地点所剩下的戏显示
        $arr_infos_spect_parcity = $arr_details_Elem["$lieua"]; //获取这个地点的所有戏的信息数组
        $arr_name_spectacles = [];
        $arr_JH_spectacles = [];
        foreach ($arr_infos_spect_parcity as $value) {
            array_push($arr_name_spectacles, $value[2]);
            array_push($arr_JH_spectacles, $value[1]);
        }
        foreach ($arr as $key => $value) {
            echo "<h3>" . $key;
            foreach ($value as $cle => $val) {
                if ($cle == $date_v) {
                    echo "&nbsp le &nbsp" . $cle . "</h3>";
                    foreach ($val as $p_cle => $val2) {
                        $res = $fs->comparerDeuxTemps($HeureArrive, $val2["Heure"]);
                        if ($res > 0) {//表示没有迟到
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
        }
    } else {//如果不一样或者页面不存在，则执行
        /*         * 这里我开始根据所储存的内容来判断是否有跟当前选择的城市相同：
         * 1.如果是存在相同的城市，则无序考虑时间问题 
         * 2.如果不存在与已经购票的城市相同，则需要考虑时间问题，然后筛掉时间上发生冲突的     
         */
        foreach ($arr as $key => $value) {
            echo "<h3>" . $key;
            foreach ($value as $cle => $val) {
                if ($cle == $date_v) {
                    echo "&nbsp le &nbsp" . $cle . "</h3>";
                    foreach ($val as $p_cle => $val2) {
                        $res = $fs->comparerDeuxTemps($HeureArrive, $val2["Heure"]);
                        if ($res > 0) {//表示没有迟到
                            array_push($tab_enr, $val2["title"]);
                            echo "<p class='spect_dispo'>" . "<label class='Day_time'>" . $val2["Jour"] . " " . $val2["Heure"] . '</label>' . " " . '<label class="tit_spect">' .
                            $val2["title"] . '</label>' . " de " . '<label class="spec_acteur">' . $val2["spectateur"] . '</label>';
                            echo "&nbsp<img class='btn_reserv' src='./images/plus.png'/>" . "</p>";
                        }
                    }
                    echo "<br><br>";
                }
            }
        }
    }
}    