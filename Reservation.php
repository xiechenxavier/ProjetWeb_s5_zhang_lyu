<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>login test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="./CSS/style.css" />
        <link rel="stylesheet" type="text/css" href="./CSS/style2.css" />
        <!--<link rel="stylesheet" href="Lieux%E2%80%AF;%20Th%C3%A9%C3%A2tres%20de%20Bourbon_fichiers/styleTheatresDeBourbonPourPHP.css">-->
        <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script type="text/javascript" src="./JS/Front.js"></script>
        <script type="text/javascript" src="./JS/CloseNavigateur.js"></script>
    </head>
    <body>
        <div class="bandeau">
            <h1> Reserver les billes</h1>
        </div><!--bandeau-->
        <div id="form_input">
            <div id="shopcar">
                <img src="./images/shopcar.png" class="icone"/>
                <span class='on'>0</span>
            </div>
            <div class="service">
                <!--<form action="./Services.php" method="post">-->
                <label>Lieu_depart:</label>  
                <select name='d_lieu' id="d_lieu">
                    <option disabled="disabled"  selected="true"> choisir la ville de départ </option>
                    <option value ='Moulins'>Moulins</option>
                    <option value ='Veauce'>Veauce</option>
                    <option value='Vichy'>Vichy</option>
                    <option value='Monétay'>Monétay</option>
                    <option value='Monteignet'>	Monteignet</option>
                    <option value='Clermont-Ferrand'>Clermont-Ferrand</option></select>
                <label>Lieu_arrivé:</label> 
                <select name='a_lieu' id="a_lieu">
                    <option disabled="disabled"  selected="true"> choisir une ville d'arrivée</option>
                    <option value ='Moulins'>Moulins</option>
                    <option value ='Veauce'>Veauce</option>
                    <option value='Vichy'>Vichy</option>
                    <option value='Monétay'>Monétay</option>
                    <option value='Monteignet'>Monteignet</option>
                    <option value='Clermont-Ferrand'>Clermont-Ferrand</option>
                </select>
                Date:<input type="datetime" id="datepicker" name="Date">
                Heure:<input type="time" name="heure" id="Heure">
                <button id="submit">submit</button>
                <!--</form>-->        

                <div id="mode_options">
                    <ul class="list_modes">
                        <li class="reserv_soi_meme">Reserver vous-même</li>
                        <li class="aide_qqn">aider les amis</li>
                    </ul>
                </div>
            </div>

            <div class="Form_distance">
                <form>
                    <table id="tableau" border="1px solid black" cellpadding="5" cellspacing="3" >
                        <tr class="depart">
                            <td></td>
                            <td>Moulins</td>
                            <td>Monétay</td>
                            <td>Vichy</td>
                            <td>Monteignet</td>
                            <td>Veauce</td>
                            <td>Clermont-Ferrand</td>
                        </tr>
                        <tr class="depart">
                            <td>Moulins</td>
                            <td>0</td>
                            <td>25km/30mins</td>
                            <td>69km/1h10</td>
                            <td>91km/1h05</td>
                            <td>91km/1h08</td>
                            <td>98km/1h37</td>
                        </tr>
                        <tr class="depart">
                            <td>Monétay</td>
                            <td>25km/30mins</td>
                            <td>0</td>
                            <td>39km/45min</td>
                            <td>33km/36min</td>
                            <td>45km/42min</td>
                            <td>107/km/1h20</td>
                        </tr>
                        <tr class="depart">
                            <td>Vichy</td>
                            <td>69km/30mins</td>
                            <td>39km/45min</td>
                            <td>0</td>
                            <td>18km/26min</td>
                            <td>54km/58min</td>
                            <td>56km/1h05</td>
                        </tr>
                        <tr class="depart">
                            <td>Monteignet</td>
                            <td>91km/1h05</td>
                            <td>33km/36min</td>
                            <td>18km/26min</td>
                            <td>0</td>
                            <td>22km/26min</td>
                            <td>50km/55min</td>
                        </tr>
                        <tr class="depart">
                            <td>Veauce</td>
                            <td>91km/1h08</td>
                            <td>45km/42min</td>
                            <td>54km/58min</td>
                            <td>22km/26min</td>
                            <td>0</td>
                            <td>54km/45min</td>
                        </tr>
                        <tr class="depart">
                            <td>Clemont-Ferrand</td>
                            <td>95km/1h37</td>
                            <td>107km/1h20</td>
                            <td>56km/1h05</td>
                            <td>50km/55min</td>
                            <td>54km/45min</td>
                            <td>0</td>
                        </tr>
                    </table>
                </form>
                <div class='btn_part'>
                    <button class='but_hide_tab'>Cacher le tableau</button>
                    <button class='but_show_tab'>Montrer le tableau</button></div>
            </div>
            <p id="info"></p>
        </div>
    </div>
    <div class="menu">
        <ul class="navbar">
            Le site&#8239;:
            <div id="vignette">                     
                <a href="index.php">
                    <img class="vignette"
                         src="./images/logo.jpg"
                         alt="[logo de l'association vers l'accueil du site]"
                         width=30%
                         height=30%
                         decoding=low
                         >
                </a>
            </div>  <!-- div vignette-->
            <li><a href="./Accueil.php">Accueil</a></li>
            <li><a href="./FirstPart/LieuParLieu.php">Lieu par Lieu</a></li>
            <li><a href="./FirstPart/JourParJour.php">Jour par Jour</a></li>
            <li><a href="./FirstPart/TroupeParTroupe.php">Troupe par Troupe</a></li>
            <li><a href="./Reservation.php">Reserver les billes</li>
            <li><a href="./Canvas.php">Finances du festival</li>
            <!--<li><a href="Festival2018ProgrammationVueGlobale.php">Planning</a> </li>-->       
        </ul>
        <div id="vignette">
            <a href="./FirstPart/LieuParLieu.php#Manoir_de_noix">      
                <img    class="vignette"
                        src="./images/manoir_des_noix_a_veauce.jpeg "
                        alt="[ Pigeonnier du manoir des noix et de l'église de Veauce vue du ciel           ]"      
                        width=30%
                        height=30%

                        >
            </a>
            <a href="./FirstPart/LieuParLieu.php#a_Eglise_z">
                <img    class="vignette"
                        src="./images/Eglise_Sainte_Croix_de_Veauce.jpg"
                        alt="[ Eglise de Veauce      ]"
                        width=30%
                        height=30%>
            </a>
            <a href="./FirstPart/LieuParLieu.php#a_Château_de_Lachaise_z">
                <img    class="vignette"
                        src="./images/monetay_la_chaise.jpg"
                        alt="[ Photo du château de Lachaise      ]"
                        width=30%
                        height=30%>
            </a>
            <a href="./FirstPart/LieuParLieu.php#a_Château_d'Idogne_z">      
                <img    class="vignette"
                        src="./images/Château_d'Idogne.jpg"
                        alt="[ Photo du château d'Idogne     ]"
                        width=30%
                        height=30%

                        >
            </a>
            <a href="./FirstPart/LieuParLieu.php#Domaine_de_la_Querye">      
                <img    class="vignette"
                        src="./images/Domaine_de_la_Quérye.png"
                        alt="[ Photo du domaine de la Querye     ]"
                        width=30%
                        height=30%

                        >
            </a>                    
        </div><!--Vignette-->

    </div><!-- class="menu"-->
    <!--                <button class="btn_hide">
                        cacher navigateur
                    </button>-->
    <div class="btn_hide">
        <img  src="./images/flaish2.png">
    </div>

    <div class="btn_show">
        <img  src="./images/flaish_r2_c2.png">
    </div>
    <div class='theatre'>

    </div>
    <div class="spect_Ajoute" style="display: none">

    </div>

</body>
</html>
