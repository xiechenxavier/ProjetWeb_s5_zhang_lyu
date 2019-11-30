<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
        print_r($arr_details_Elem);
    }
}
