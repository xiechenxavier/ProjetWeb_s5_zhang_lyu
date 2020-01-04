<!DOCTYPE html>
<html>
    <head>
        <title>
            PageRéservation
        </title>
        <link rel="stylesheet" type="text/css" href="./CSS/style.css" />
        <link rel="stylesheet" type="text/css" href="./CSS/style2.css" />
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="./JS/tableExport.jquery.plugin-master/libs/FileSaver/FileSaver.min.js"></script>
        <script src="./JS/tableExport.jquery.plugin-master/tableExport.min.js"></script>
        <script type="text/javascript" src="./JS/Front.js"></script>

    </head>

    <body>
        <div class="bandeau">
            <h1> Votre Panier</h1>
        </div><!--bandeau-->
        <div id="Corps">
            <div class="divinput">
                <table>
                    <tr><td>Nom:</td>
                        <td><input type="text" id="nom" name="nom"></td>
                    </tr>
                    <tr><td>Adresse Mail:</td>
                        <td><input type="text" id="nom" name="nom"></td>
                    </tr>
                </table>
            </div>
            <div class="champ_spectacle">
                <label><h2>Listes des Spectacles:</h2></label>
                <button class="vider_liste">Vider Listes</button>
                <!--<select class="Spec_Options">-->
                <?php
                $select_cond = '<select id="nombre" name="nombre" >
                        <option value="0" disabled="disabled" selected="true">Nombre</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <select id="type" name="type" >
                        <option value="0" disabled="disabled" selected="true">Type</option>
                        <option value="1">Plein tarif</option>
                        <option value="2">Tarif réduit</option>
                        <option value="3">Enfant gratuit</option>
                    </select>
                    Prix:<lable class="Curr_price">X</lable>
                <button class="ajouter"><img id="add" src="./images/plus.png">Ajouter</button>';
                $filename = "newfile.txt";
                if (file_exists($filename)) {
                    //Obtenir le tableau pour lire les contenus lignes par linges
                    $tab_titles = file($filename);
                    if (!empty($tab_titles)) {
                        //Predefinir un tableau en 4 dimensions qui permet de contenir tous les informations des spectacles
                        $arr_details_elems = [];
                        //la premiere ligne de fichier de l'entregistrement de spectacles choisis
                        $first_Spectacle = $tab_titles[0];
                        //pour traiter les donnes de spectacles enregistres dans la fichier, on separe les infos d'une spectacle en quelques parties
                        $first_Spect_Arr = explode("*", $first_Spectacle);
                        //ca permet d'obtenir l'info de la premiere spectacle(indice 0), info: La ville 
                        $first_key_city = array_shift($first_Spect_Arr);
                        //initializer le tableau (la clé est la première ville)
                        $arr_details_elems[$first_key_city] = [];
                        $first_key_Date = array_shift($first_Spect_Arr);
                        //initializer le tableau en 2 dimensions (la clé est la première date)
                        $arr_details_elems[$first_key_city][$first_key_Date] = [];
                        array_push($arr_details_elems[$first_key_city][$first_key_Date], $first_Spect_Arr); //ajouter l'element dans le sous tableau

                        for ($i = 1; $i < count($tab_titles); $i++) {
                            $value = $tab_titles[$i];
                            if ($value != '') {
                                $cur_arr_elem_spect = explode("*", $value);
                                $curr_key_city = array_shift($cur_arr_elem_spect);
                                $curr_key_date = array_shift($cur_arr_elem_spect);
                                if (array_key_exists("$curr_key_city", $arr_details_elems)) {//cette ville est deja existant dans le tableau
                                    if (array_key_exists($curr_key_city, $arr_details_elems)) {
                                        array_push($arr_details_elems[$curr_key_city][$curr_key_date], $cur_arr_elem_spect); //ajouter l'element dans le sous tableau
                                    } else {
                                        $arr_details_elems[$curr_key_city][$curr_key_date] = [];
                                        array_push($arr_details_elems[$curr_key_city][$curr_key_date], $cur_arr_elem_spect); //ajouter l'element dans le sous tableau
                                    }
                                } else {
                                    $arr_details_elems[$curr_key_city] = []; //initializer le tableau (avec la clé de la ville courante)
                                    $arr_details_elems[$curr_key_city][$curr_key_date] = [];
                                    array_push($arr_details_elems[$curr_key_city][$curr_key_date], $cur_arr_elem_spect); //ajouter l'element dans le sous tableau
                                }
                            }
                        }
                        //  le tableau est bien rempli, on commence afficher tous les items enregistres         
                        $contenu = "";
                        foreach ($arr_details_elems as $city => $val) {
                            echo "<section class='item_spectacles'><h3 class='villes'>" . $city . "</h3>";
                            foreach ($val as $date => $val2) {
                                echo "<h4 class='date_spect'>" . $date . "</h4>";
                                foreach ($val2 as $val3) {
                                    echo "<p class='item_contenu'>";
                                    foreach ($val3 as $num => $val4) {
                                        if ($num === 1) {//la partie de spectacle
                                            echo "<label class='name_Spectacle'>" . $val4 . "</label>";
                                        } else
                                        if ($num === 2) {//la partie de spectateur
                                            echo "<label class='Spectateur'><br><br>" . $val4 . "</label>";
                                        } else if ($num === 3) {//la partie de village
                                            echo "<label class='Lieu_village'>" . $val4 . "</label>";
                                        } else {//la partie de l'heure
                                            echo "<label class='Spect_time'>" .$val4."</label>&nbsp;";
                                        }
                                    }
                                    echo "<br><br>" . $select_cond . "</p>";
                                }
                            }
                        }
                    }
                }
                echo "</section><hr class='diviser'>";
                ?>
            </div>
            <div class="divtableau">
                <table id="tables" bgcolor="black" cellpadding="5" border="0">
                    <tr>
                　<td bgcolor="red">Nom spectacle</td>
                　<td bgcolor="orange">Quantités des billes</td>
                　<td bgcolor="orange">Prix</td>
                        <td bgcolor="orange">Ville</td>
                        <td bgcolor="orange">Lieu</td>
                        <td bgcolor="orange">Date</td>
                        <td bgcolor="orange">Heure</td>
                        <td bgcolor="orange">Annulation</td>
                    </tr>
                </table>
                <label class="pt">plein tarif:<label class="nb1">0</label></label>
                <label class="tr">tarif reduit:<label class="nb2">0</label></label>
                <label class="eo">Enfant billet:<label class="nb3">0</label></label>
                <label class="billet_offert">billet_offert:<label class="nb4">0</label></label>
                <!--</div>-->
                <div class ="tp">total:<label class="total"></label></div>
                <div class="reduction">Selon votre reservation vous avez&nbsp;<label class="nb_reduit"></label>&nbsp;tarif reduit</div>
                <div class="final_total">total final:&nbsp;<label class="prix_final"></label></div>
                <div class="valide"><button class='payer'>Valider</button></div>
                <div><button class="annule_tous"><img src="./images/poubelle.png"/><label class="ann_label">Annuler tous</label></button></div>
            </div>
        </div>
        <footer>	
            formulaire de la reservation
            <!-- Signer et dater la page, c'est une question de politesse! -->
            <address>	Page conçue par Lyu Ruoxi 12 novembre 2019;
                icone des button et les fonctions par Zhang Xiechen.</address>
        </footer>

    </body>
</html>