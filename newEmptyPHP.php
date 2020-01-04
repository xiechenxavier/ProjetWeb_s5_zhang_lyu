<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getFileData($file) {
    if (!is_file($file)) {
        exit('没有文件');
    }

    $handle = fopen($file, 'r');
    if (!$handle) {
        exit('读取文件失败');
    }

    while (($data = fgetcsv($handle)) !== false) {
// 下面这行代码可以解决中文字符乱码问题
// $data[0] = iconv('gbk', 'utf-8', $data[0]);
// 跳过第一行标题
        if ($data[1] == 'Heure') {
            continue;
        }

// data 为每行的数据，这里转换为一维数组
        print_r($data); // Array ( [0] => tom [1] => 12 )
    }

    fclose($handle);
}

getFileData('./FirstPart/ResultatsFestival.csv');
