<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Récupérez-le à partir des données précédentes 
// (les données proviennent de chaque événement d'ajout icone "+", nous stockons toutes les commandes qui ont été ajoutées
$arrayadd = $_POST["arrayAdded"];
// Séparez chaque commande par un caractère de nouvelle ligne
foreach ($arrayadd as $val) {
    $txt .= $val . "\n";
}
// Créer (si ce fichier n'existe pas, en créer un nouveau) et écrire les données qui viennent d'être passées dans le fichier)
$filename = "newfile.txt";
if (!is_file($filename)) {
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    file_put_contents($filename, $txt);
} else {
    file_put_contents($filename, $txt);
}
