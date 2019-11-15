<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$txt = $_POST['username'];
$filename="newfile.txt";
if (!is_file($filename)) {
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    file_put_contents($filename, $txt);
} else {
    file_put_contents($filename, $txt);
}

