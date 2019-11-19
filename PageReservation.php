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
            <div id="champ_spectacle">
                <label>Nom de Spectacle:</label>
                <!--<select class="Spec_Options">-->
                <?php
                $filename = "newfile.txt";
                $myfile = fopen("$filename", "r") or die("Unable to open file!");
                $str = fread($myfile, filesize("$filename"));
                $tab_titles = explode("/", $str);
                fclose($myfile);
                echo "<select class='Spec_Options'>";
                foreach ($tab_titles as $value) {
                    echo "<option>" . "$value" . "</option>";
                }
                echo "</select>";
                ?>
                <!--</select>-->
            </div>
            <div class="divselect">

                <label class="dselect">Nombre:<select id="nombre" name="nombre" >
                        <option value="0" disabled="disabled" selected="true">Select Nombre</option>
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
                    </select></label>

                <label class="dselect">Type:<select id="type" name="type" >
                        <option value="0" disabled="disabled" selected="true">Select Type</option>
                        <option value="1">Plein tarif</option>
                        <option value="2">Tarif réduit</option>
                        <option value="3">Enfant gratuit</option>
                    </select></label>

                <b>Prix:<lable class="Curr_price">X</lable></b>

                <button class='ajouter'><img id="add" src="./images/plus.png">Ajouter</button>

            </div>

            <div class="divtableau">
                <table bgcolor="black" cellpadding="5" border="0">
                    <tr>
				　<td bgcolor="red">Nom spectacle</td>
				　<td bgcolor="orange">Quantités des billes</td>
				　<td bgcolor="orange">Prix</td>
                        <td bgcolor="orange">Annulation</td>
                    </tr>
                </table>
                <div class ="tp">

                    total:<label class="total">X</label>

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