<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Spectacles Lieu par Lieu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/style.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/style2.css" />
        <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script src="../JS/jquery-csv-master/src/jquery.csv.js"></script>
        <script type="text/javascript" src="../JS/Front.js"></script>
    </head>
    <body>
        <div class="bandeau">
            <h1> Théâtres de Bourbon&#8239;: Dans chaque lieu</h1>
        </div>
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
                <li><a href="#">Lieu par Lieu</a></li>
                <li><a href="./JourParJour.php">Jour par Jour</a></li>
                <li><a href="./TroupeParTroupe.php">Troupe par Troupe</a></li>
                <li><a href="../Reservation.php">Reserver les billes</li>
                <li><a href="../Canvas.php">Finances du festival</li>
                <!--<li><a href="Festival2018ProgrammationVueGlobale.php">Planning</a> </li>-->		  
            </ul>

            <ul class="navbar">

                La page&#8239;:	
            </ul>			
            <div id="vignette">
                <a href="#Manoir_de_noix">		
                    <img  	class="vignette"
                           src="../images/manoir_des_noix_a_veauce.jpeg"
                           alt="[ Pigeonnier du manoir des noix et de l'église de Veauce vue du ciel           ]"		
                           width=30%
                           height=30%

                           >
                </a>
                <a href="#a_Eglise_z">
                    <img  	class="vignette"
                           src="../images/Eglise_Sainte_Croix_de_Veauce.jpg"
                           alt="[ Eglise de Veauce      ]"
                           width=30%
                           height=30%

                           >
                </a>
                <a href="#a_Château_de_Lachaise_z">
                    <img  	class="vignette"
                           src="../images/monetay_la_chaise.jpg"
                           alt="[ Photo du château de Lachaise      ]"
                           width=30%
                           height=30%

                           >
                </a>

                <a href="#a_Château_d'Idogne_z">		
                    <img  	class="vignette"
                           src="../images/Château_d'Idogne.jpg"
                           alt="[ Photo du château d'Idogne     ]"
                           width=30%
                           height=30%

                           >
                </a>
                <a href="#Domaine_de_la_Querye">		
                    <img  	class="vignette"
                           src="../images/Domaine_de_la_Quérye.png"
                           alt="[ Photo du domaine de la Querye     ]"
                           width=30%
                           height=30%

                           >
                </a>			

                <a href="#Costume_de_Scène_Moulins">		
                    <img  	class="vignette"
                           src="../images/Moulins.jpg"
                           alt="[ Photo du Moulins     ]"
                           width=30%
                           height=30%

                           >
                </a>	
            </div>
        </div ><!--pachtwork-->
        <div class="btn_hide">
            <img  src="../images/flaish2.png">
        </div>

        <div class="btn_show">
            <img  src="../images/flaish_r2_c2.png">
        </div>
        <main>
            <section>
                <div class= "decalage">

                    <h2> Quatres demeures de l'Allier, un musée et une église vous ouvrent leurs grilles pour assister aux représentations théâtrales. </h2>


                    <p> Choissisez un lieu en cliquant sur son bouton (dans le menu de la page) pour voir la programmation qu'il accueille puis selectionnez les spectacles qui s'y jouent et vous intéresse. </p>

                    <figure>
                        <img  	src="../images/kje.jpg"                                                                                                                   
                               alt=" Infographie Pour Situer les châteaux sur la carte du département "
                               width=100%
                               height=100%
                               id="localisation"
                               >
                        <figcaption>Photocomposition&#8239;:Edmée Deusy</figcaption>
                    </figure>
                    <div class="Lieu">       <h2 id="Manoir_de_noix">

                            Veauce

                        </h2>

                        <p>

                            45 minutes de Clermont-Ferrand, 10 minutes d'Ebreuil

                        </p>


                        <h2 id="title">Manoir des noix</h2>

                        <div>

                            <figure class="lieu">

                                <img  src="../images/manoir_des_noix_a_veauce.jpeg                                    "


                                      alt="[ Photo du pigeonnier du manoir des noix et de l'église de Veauce vue du ciel                        ]"

                                      width=100%
                                      height=100%

                                      ><figcaption>Photographe&#8239;:


                                    Sébastien Tixeuil                                                                           </figcaption></figure>

                            <p>

                                Veauce est le plus petit village de l’Allier (40 habitants). Collé à la forêt des Colettes, il est perché sur la ligne de séparation entre langue d'oc et
                                langue d'oïl. Son château, royal jusqu'en 1700, servait de verrou aux 3 anciennes provinces de Bourbonnais, d’Auvergne et de Berry. Autant dire que,
                                malgré sa toute petite taille, Veauce est le cœur politique et symbolique de la France. Le village possède aussi une superbe église romane, fille de
                                l'abbaye carolingienne d'Ebreuil. Le festival se tient dans cette église et dans la propriété classée qu'elle surplombe, articulée autour du logis du Xve
                                siècle (le manoir des noix) qui en était autrefois le prieuré et d’un superbe pigeonnier.
                                Les représentations prennent place dans les dépendances du château au pied du pigeonnier.
                                Veauce

                            </p>

                        </div>      <div><h2>


                                Manoir des noix à Veauce


                                ,</h2>
                            <h2>
                                Le Programme :
                            </h2>
                        </div>
                        <?php
                        include_once '../Tableaus.php';
                        $filePath = "../FirstPart/ResultatsFestival.csv";
                        $tab = Tableaus::parse_csv($filePath);

                        function AfficherProgramParLieu($tab, $Lieu) {

                            $html = "";
                            for ($i = 0; $i < count($tab); $i++) {
                                $curr_arr = $tab[$i];
                                if ($curr_arr[1] == "Heure" || $curr_arr[3] != $Lieu) {
                                    continue;
                                }
                                $html .= "<p><Horaire>" . $curr_arr[0] . " à " . $curr_arr[1] . "<Troupe>&nbsp" . $curr_arr[5] . "&nbsp</Troupe>" .
                                        "présente<TitreSpectacle>&nbsp" . $curr_arr[2] . "&nbsp</TitreSpectacle>";

                                $html .= "</p>";
                            }
                            return $html;
                        }

                        echo AfficherProgramParLieu($tab, "Manoir des noix");
                        ?>
                    </div>
                    <div class="Lieu">       <h2 id="a_Eglise_z">

                            Veauce

                        </h2>

                        <p>

                            45 minutes de Clermont-Ferrand, 10 minutes d'Ebreuil



                        </p>


                        <h2 id='title'>Eglise</h2>

                        <div>

                            <figure class="lieu">

                                <img  src="../images/Eglise_Sainte_Croix_de_Veauce.jpg "


                                      alt="[Photo du pigeonnier du manoir des noix et de l'église de Veauce vue du ciel                        ]"

                                      width=100%
                                      height=100%

                                      ><figcaption>Photographe&#8239;:


                                    Pierre Deusy                                                                                </figcaption></figure>

                            <p>

                                Village de 40 habitants, perché sur la ligne de séparation entre l'oc et oil, Veauce, dont le chateau, royal jusqu'en 1700, servait de verrou aux 3
                                anciennes provinces de Bourbonnais, Auvergne et Berry (autant dire le coeur politique et symbolique de la France). Le village possède une superbe
                                église romane, fille de l'abbaye carolingienne d'Ebreuil, dont le prieuré était le logis du XVe siècle de la propriété qui accueille le festival.
                                Le village possède aussi une superbe église romane, fille de l'abbaye carolingienne d'Ebreuil. Le festival se tient dans cette église et dans la
                                propriété classée qu'elle surplombe, articulée autour du logis du Xve siècle (le manoir des noix) qui en était autrefois le prieuré et d’un superbe
                                pigeonnier.
                                . Les représentations prennent place dans l'église.

                                Veauce
                            </p>

                        </div>      <div><h2>


                                Eglise                   à                                                                   Veauce


                                ,</h2><h2>

                                le programme  :

                            </h2></div>
                        <?php
                        echo AfficherProgramParLieu($tab, "Eglise");
                        ?>
                    </div>

                    <div class="Lieu">       <h2 id="a_Château_de_Lachaise_z">

                            Monétay sur Allier

                        </h2>

                        <p>

                            20 minutes de Moulins, 10 minutes de Saint Pourçain

                        </p>


                        <h2 id="title">Château de Lachaise</h2>

                        <div>

                            <figure class="lieu">

                                <img  src="../images/monetay_la_chaise.jpg                                              "


                                      alt="[ Photo du château de Lachaise                                                                       ]"

                                      width=100%
                                      height=100%

                                      ><figcaption>Photographe&#8239;:


                                    inconnu                                                                                     </figcaption></figure>

                            <p>

                                Dominant le Val d'Allier, le château de Lachaise est intimement lié à l'histoire du vignoble de Saint-Pourcain: dés 1569, Nicolas de Nicolay,
                                géographe du roi Charles IX écrivait: " Au terroir de Lachaise croissent les meilleurs vins blancs du Bourbonnais" et c'est du port de Lachaise que
                                ceux-ci étaient expédiés dans tout le royaume;
                                En 1665, la propriété passe aux ancêtres de la famille des propriétaires actuels et, depuis 350 ans, chaque génération y apporte sa touche, faisant
                                de cette demeure un lieu à la fois familial et patrimonial où il fait bon vivre.



                                Monétay sur Allier


                            </p>

                        </div> <div><h2>


                                Château de Lachaise à Monétay sur Allier
                                , </h2><h2>

                                le programme :

                            </h2>
                            <?php
                            echo AfficherProgramParLieu($tab, "Château de Lachaise");
                            ?>
                        </div>
                    </div>

                    <div class = "Lieu"> <h2 id = "a_Château_d'Idogne_z">

                            Monteignet sur l'Andelot

                        </h2>

                        <p>

                            20 minutes de Vichy, 10 minutes de Gannat



                        </p>


                        <h2 id="title">Château d'Idogne</h2>

                        <div>

                            <figure class = "lieu">

                                <img src = "../images/Château_d'Idogne.jpg                                             "


                                     alt = "[ Photo du château d'Idogne                                                                          ]"

                                     width = 100%
                                     height = 100%

                                     ><figcaption>Photographe&#8239;:


                                    inconnu </figcaption></figure>

                            <p>

                                La première mention du château d’Idogne figure dans un terrier du 15ème siècle. Il avait à l'époque une fonction défensive dont ne subsistent que
                                quelques traces, en particulier la tour Sud. Il passe entre plusieurs mains avant de se fixer en 1628 et jusqu'en 1781 dans celles de la famille de Goy,
                                qui entreprend de profondes transformations et lui donne l'aspect qu'il a aujourd'hui : Le manoir bourbonnais est doublé dans la largeur par un
                                bâtiment de pur style auvergnat; les petites fenêtres sont bouchées et remplacées par de grandes baies .

                                En 1892, il est racheté par Henry Kemlin, dont l'épouse est issue d’une famille qui comptait quatre académiciens français ou membres de l’institut, et
                                devient chaque été le lieu de joutes littéraires tenues sous la présidence du Cardinal Baudrillard, recteur de l’Institut Catholique. Avec ce festival, ses
                                descendants perpétuent cette tradition littéraire.

                                Idogne est depuis 1993 inscrit dans son intégralité (y compris les décors intérieurs, le parc et les portails), à l’inventaire supplémentaire des
                                monuments historiques et a bénéficié d'une restauration en profondeur  qui se poursuit encore.

                                Monteignet sur l'Andelot

                            </p>

                        </div> <div><h2>


                                Château d'Idogne         à                                                 Monteignet sur l'Andelot
                                , </h2><h2>

                                le programme :

                            </h2>
                        </div>
                        <?php
                        echo AfficherProgramParLieu($tab, "Château d'Idogne");
                        ?>
                    </div>

                    <div class = "Lieu"> <h2 id = "Domaine_de_la_Querye">

                            Monteignet sur l'Andelot

                        </h2>

                        <p>

                            20 minutes de Vichy, 10 minutes de Gannat



                        </p>


                        <h2 id="title">Domaine de la Quérye</h2>

                        <div>

                            <figure class="lieu">

                                <img  src="../images/Domaine_de_la_Quérye.png                                               "


                                      alt="[ Photo du domaine de la Querye                                                                      ]"

                                      width=100%
                                      height=100%

                                      ><figcaption>Photographe&#8239;:


                                    inconnu                                                                                     </figcaption></figure>

                            <p>

                                Le domaine de la Quérye est au XVème siècle une des Seigneuries qui défendent la châtellenie de Gannat, contrôlée par les seigneurs de Bourbon.
                                Si la Quérye a conservé des éléments architecturaux caractéristiques de sa fonction défensive originelle, elle a été remaniée au XVIIème, et plus
                                encore au XIXème siècle.
                                Vers 1850 notamment, Jean Francisque Jusseraud, médecin, agronome idéaliste et philanthrope, Député de la Constituante, et fortement influencé
                                par son ami Abel Transon, disciple de Saint-Simon et de Fourier, décide d'y transformer ses rêves en réalité. Il entreprend d’y développer un vaste
                                domaine, dont le grand parc sert d’écrin à un ensemble agricole modèle complet et parfaitement cohérent (fermes, pigeonnier, étables, moulin,
                                lavoir, source, fontaine, fours à pain...). Un complexe et très original réseau hydraulique (Source, lavoir, fontaines, bassins, moulin île, pièce d’eau,
                                ouvrages d’irrigation cascade) illustre la capacité des St Simoniens à mettre la technique au service du progrès tout en recherchant à rendre le
                                monde plus beau.
                                En faisant partager à Théâtres de Bourbon son cadre et ses arbres centenaires, le domaine de la Quérye s'inscrit donc pleinement dans cette
                                ancienne volonté de mettre l'homme au cœur de toute chose et de changer quotidiennement et spirituellement le monde!
                                Monteignet sur l'Andelot

                            </p>

                        </div>      <div><h2>


                                Domaine de la Quérye     à                                                 Monteignet sur l'Andelot
                                , </h2><h2>

                                le programme :

                            </h2>
                        </div>
                        <?php
                        echo AfficherProgramParLieu($tab, "Domaine de la Quérye");
                        ?>
                    </div>

                    <div class = "Lieu"> <h2 id = "Costume_de_Scène_Moulins">
                            Costume de Scène
                            Moulins

                        </h2>

                        <p>

                        </p>


                        <h2 id = "title">Centre National du Costume de Scène</h2>

                        <div>

                            <figure class = "lieu">

                                <img src = "../images/Moulins.jpg                                                  "


                                     alt = "[ Photo du Centre national du costume de scène                                                       ]"

                                     width = 100%
                                     height = 100%

                                     ><figcaption>Photographe&#8239;:


                                    inconnu </figcaption></figure>

                            <p>

                                Moulins
                            </p>

                        </div> <div><h2>


                                Centre National du à Moulins
                                Costume de Scène
                                , </h2><h2>

                                le programme :

                            </h2></div>

                       <?php
                       echo AfficherProgramParLieu($tab, "Centre National du Costume de Scène");
                       ?>

                    </div> <!--Lieu-->
                    <date>   programmation telle que définie au              dimanche 28 juillet 2019                                       </date>
                </div><!--decalage-->
            </section>
        </main>
        <div id="top_btn">
            <a href="javaScript:;" class="top">TOP</a>
        </div>
    </body>
</html>


