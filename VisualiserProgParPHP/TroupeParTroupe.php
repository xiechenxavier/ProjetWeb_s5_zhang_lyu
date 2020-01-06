<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Spectacles Troupe par Troupe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/style.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/style2.css" />
        <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script src="../JS/jquery-csv-master/src/jquery.csv.js"></script>
    </head>
    <body>
        <div class="bandeau">
            <h1> Théâtres de Bourbon&#8239;: De différentes TroupeParTroupe </h1>
        </div><!--bandeau-->

        <div class="petitPanier"><table>Billets en vente exclusivement sur les lieux du festival: Monétay, Monteignet, Veauce  du 2 au 6 août dès 11h00 et le 6 août à Moulins de 19h00 à 20h00.
                Attention! à Moulins le début du spectacle à 20h00. </table></div><!-- class="petitPanier"-->	

        <div class="menu">
            <ul class="navbar">
                Le site&#8239;:
                <div id="vignette">						
                    <a href="index.php">
                        <img class="vignette"
                             src="../images/logo.jpg"
                             alt="[logo de l'association vers l'accueil du site]"
                             width=30%
                             height=30%
                             decoding=low
                             >
                    </a>
                </div><!-- div vignette-->
                <li><a href="../Accueil.php">Accueil</a></li>
                <li><a href="./LieuParLieu.php">Lieu par Lieu</a></li>
                <li><a href="./JourParJour.php">Jour par Jour</a></li>
                <li><a href="#">Troupe par Troupe</a></li>
                <li><a href="../Reservation.php">Reserver les billes</li>
                <li><a href="../Canvas.php">Finances du festival</li>
                <!--<li><a href="Festival2018ProgrammationVueGlobale.php">Planning</a> </li>-->		  
            </ul>

            <ul class="navbar">

                La page&#8239;:	
            </ul>			

            <div id="vignette">
                <a href="./LieuParLieu.php#Manoir_de_noix">		
                    <img  	class="vignette"
                           src="../images/manoir_des_noix_a_veauce.jpeg"
                           alt="[ Pigeonnier du manoir des noix et de l'église de Veauce vue du ciel           ]"		
                           width=30%
                           height=30%

                           >
                </a>
                <a href="./LieuParLieu.php#a_Eglise_z">
                    <img  	class="vignette"
                           src="../images/Eglise_Sainte_Croix_de_Veauce.jpg"
                           alt="[ Eglise de Veauce      ]"
                           width=30%
                           height=30%

                           >
                </a>
                <a href="./LieuParLieu.php#a_Château_de_Lachaise_z">
                    <img  	class="vignette"
                           src="../images/monetay_la_chaise.jpg"
                           alt="[ Photo du château de Lachaise      ]"
                           width=30%
                           height=30%

                           >
                </a>

                <a href="./LieuParLieu.php#a_Château_d'Idogne_z">		
                    <img  	class="vignette"
                           src="../images/Château_d'Idogne.jpg"
                           alt="[ Photo du château d'Idogne     ]"
                           width=30%
                           height=30%

                           >
                </a>
                <a href="./LieuParLieu.php#Domaine_de_la_Querye">		
                    <img  	class="vignette"
                           src="../images/Domaine_de_la_Quérye.png"
                           alt="[ Photo du domaine de la Querye     ]"
                           width=30%
                           height=30%

                           >
                </a>			

                <a href="./LieuParLieu.php#Costume_de_Scène_Moulins ">		
                    <img  	class="vignette"
                           src="../images/Moulins.jpg"
                           alt="[ Photo du Moulins     ]"
                           width=30%
                           height=30%

                           >
                </a>	
            </div>


        </div ><!--pachtwork-->       

        <h2 class="programme">Le Programme</h2>
        <div id="fix">
            <span>Troupe</span> 
            <select id="Troupes" onchange="window.location = this.value">
                <?php
                include_once '../Tableaus.php';
                $filePath = "../FirstPart/ResultatsFestival.csv";
                $tab = Tableaus::parse_csv($filePath);
                $Troupes = algoGetArrayTroupe($tab);
                foreach ($Troupes as $troupe) {
                    $Id = str_replace(" ", "_", $troupe);
                    echo "<option value=#" . $Id . ">" . $troupe . "</option>";
                }
                ?>
            </select>
        </div>
        <div id="Programme_Troupes">
            <?php
            //obtenir tous les troupe/compagnie des spectacles et l'inserer dans un tableau apres eliminer tous les elements repetes
            function algoGetArrayTroupe($tab) {
                $arr_Troupe = [];
                foreach ($tab as $value) {
                    if ($value[1] == "Heure") {
                        continue;
                    }
                    array_push($arr_Troupe, $value[5]);
                }
                return array_unique($arr_Troupe);
            }
            //affichr les spectacles dans ce programme ligne par linge trier par la troupe
            function AfficherProgramParTroupe($tab) {
                $Troupe_arr = algoGetArrayTroupe($tab);
                $html = "";
                foreach ($Troupe_arr as $Troupe) {//chaque date
                    $Id = str_replace(" ", "_", $Troupe);
                    $html .= '<h3 id=' . $Id . '>' . $Troupe . '</h3><br>';
                    for ($i = 0; $i < count($tab); $i++) {
                        $curr_arr = $tab[$i];
                        if ($curr_arr[1] == "Heure" || $curr_arr[5] != $Troupe) {
                            continue;
                        }

                        $html .= "<p><Horaire>" . $curr_arr[1] . "<Troupe>&nbsp" . $curr_arr[5] . "&nbsp</Troupe>" .
                                "présente<TitreSpectacle>&nbsp" . $curr_arr[2] . "&nbsp</TitreSpectacle>" .
                                "à" . "<Lieu>&nbsp" . $curr_arr[3] . "</Lieu>" . "&nbsp dans <Ville>&nbsp" . $curr_arr[4] . "</Ville>";

                        $html .= "</p>";
                    }
                }
                return $html;
            }

            echo AfficherProgramParTroupe($tab);
            ?>

        </div>
        <div id="top_btn">
            <a href="javaScript:;" class="top">TOP</a>
        </div>

    </body>
</html>
