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
                //$str = fread($myfile, filesize("$filename"));
                if (file_exists($filename)) {
                    $tab_titles = file($filename); //获得了数组，方便读取每一行的内容
                    if (!empty($tab_titles)) {
                        $arr_details_elems = []; //四维大数组方便按照城市和日期装入所有的戏剧信息
                        $first_Spectacle = $tab_titles[0]; //The first ligne（first spectacle）
                        $first_Spect_Arr = explode("*", $first_Spectacle); //分割成数组的形式，方便操作
                        $first_key_city = array_shift($first_Spect_Arr); //这个获取的就是下标为0的信息（城市）
                        $arr_details_elems[$first_key_city] = []; //初始化以第一个城市名为键的数组
                        $first_key_Date = array_shift($first_Spect_Arr);
                        $arr_details_elems[$first_key_city][$first_key_Date] = []; //初始化以第一个日期为键的二维数组
                        array_push($arr_details_elems[$first_key_city][$first_key_Date], $first_Spect_Arr); //加入子数组

                        for ($i = 1; $i < count($tab_titles); $i++) {
                            $value = $tab_titles[$i];
                            if ($value != '') {
//                        $value2=str_replace("*", " ", "$value");
                                $cur_arr_elem_spect = explode("*", $value);
                                $curr_key_city = array_shift($cur_arr_elem_spect);
                                $curr_key_date = array_shift($cur_arr_elem_spect);
                                if (array_key_exists("$curr_key_city", $arr_details_elems)) {//有这个城市
                                    if (array_key_exists($curr_key_city, $arr_details_elems)) {
                                        array_push($arr_details_elems[$curr_key_city][$curr_key_date], $cur_arr_elem_spect); //加入子数组
                                    } else {
                                        $arr_details_elems[$curr_key_city][$curr_key_date] = [];
                                        array_push($arr_details_elems[$curr_key_city][$curr_key_date], $cur_arr_elem_spect); //加入子数组
                                    }
                                } else {
                                    $arr_details_elems[$curr_key_city] = []; //初始化以当前城市名为键的数组
                                    $arr_details_elems[$curr_key_city][$curr_key_date] = [];
                                    array_push($arr_details_elems[$curr_key_city][$curr_key_date], $cur_arr_elem_spect); //加入子数组
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
                                        if ($num === 1) {
                                            echo "<label class='name_Spectacle'>" . $val4 . "</label>";
                                        } else
                                        if ($num === 2) {//如果是表演者那一项
                                            echo "<label class='Spectateur'><br><br>" . $val4 . "</label>";
                                        } else {
                                            echo "<label class='Spect_time'>" . $val4 ." "."</label>";
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
                <table bgcolor="black" cellpadding="5" border="0">
                    <tr>
                　<td bgcolor="red">Nom spectacle</td>
                　<td bgcolor="orange">Quantités des billes</td>
                　<td bgcolor="orange">Prix</td>
                        <td bgcolor="orange">Ville</td>
                        <td bgcolor="orange">Date</td>
                        <td bgcolor="orange">Annulation</td>
                    </tr>
                </table>
                <div class ="tp">

                    total:<label class="total"></label>

                    <button class='payer'>Payer</button>
                </div>
                <div>
                    <button class="annule_tous"><img src="./images/poubelle.png"/><label class="ann_label">Annuler tous</label></button></div>
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