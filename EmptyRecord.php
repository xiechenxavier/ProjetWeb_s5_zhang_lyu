<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* Obtenez-le à partir des données précédentes 
 * (les données proviennent de chaque événement d'ajout d'icône "+", nous stockons toutes les commandes qui ont été ajoutées*/
$Vide_or_not=$_POST["ViderListe"];
//Créez (si ce fichier n'existe pas, créez-en un nouveau) et écrivez les données qui viennent d'être transmises au fichier)
$filename="newfile.txt";
if (!is_file($filename)&&$Vide_or_not==="TRUE") {
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    file_put_contents($filename, "");
} else {
    file_put_contents($filename, "");
}
