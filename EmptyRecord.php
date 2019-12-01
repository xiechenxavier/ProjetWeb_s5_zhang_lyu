<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//从之前传来的数据中获取（数据来源于每一个”+“icone的添加事件，我们储存的是所有已经添加进的commandes
$Vide_or_not=$_POST["ViderListe"];
//创建（如果不存在这个文件就新建成一个这样的文件）然后往文件中写入刚刚传过来的数据）
$filename="newfile.txt";
if (!is_file($filename)&&$Vide_or_not==="TRUE") {
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    file_put_contents($filename, "");
} else {
    file_put_contents($filename, "");
}
