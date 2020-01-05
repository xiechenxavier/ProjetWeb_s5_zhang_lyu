<!DOCTYPE html>
<html>
<<<<<<< HEAD
<head lang="en">
    <meta charset="UTF-8">
    <title>Finances du festival</title>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.3/jquery.csv.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/style.css" />
    <link rel="stylesheet" type="text/css" href="CSS/style2.css" />    
    <link rel="stylesheet" type="text/css" href="css/grumble.min.css" />
    <script type="text/javascript" src="js/canvas.js"></script>
</head>
<body>


    <div class="bandeau">
        <h1> Finances du festival</h1>
    </div><!--bandeau-->

    
    <div class="canvas" id ="canvas" height="600" width="1000" style="margin:50px">
        <br>
        <form>
          <fieldset>
            <legend></legend>
            Speciaux Jeunes: <img src="images/3.png" height="20"  />
            Speciaux Adulte: <img src="images/2.png"  height="20" />
            Tarif Plein: <img src="images/4.png"  height="20" />
            Tarif Réduit: <img src="images/1.png"  height="20"/>
        </fieldset>
    </form>

    <canvas id="barChart"> Votre navigateur ne prend pas en charge Canvas </canvas>
</div>
<div class="select">
    <form id="select" action="" method="get" autocomplete="off">
        Choisir le type:
        <br>
        <label>
            <input type="radio" name="type" value="1" checked>Lieu</label>
            <label>
                <input type="radio" name="type" value="2">Compagnie</label>
                <label>
                    <input type="radio" name="type" value="3">Spectacle</label>
                </form>
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
                    <li><a href="./FirstPart/TroupeParTroupe.php">Jour par Jour</a></li>
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


                    <script type="text/javascript">


            //选择框单击后
            $('#select input:radio').click(function () {
                var txt=  $('<canvas id="barChart"> Votre navigateur ne prend pas en charge Canvas </canvas>');
                $(".canvas").append(txt);

                if ($(this).val() === '1') {
                    $("#barChart").remove();                        
                    data = arrLieu(csvData);
                    goBarChart(data, "Lieu");
                } else if ($(this).val() === '2') {
                    $("#barChart").remove();                        
                    data = arrCompagnie(csvData);
                    goBarChart(data, "Compagnie");
                } else {
                    $("#barChart").remove();                        
                    data = arrSpectacle(csvData);
                    goBarChart(data, "Spectacle");

    <head lang="en">
        <meta charset="UTF-8">
        <title>Finances du festival</title>
        <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.3/jquery.csv.min.js"></script>
        <link rel="stylesheet" type="text/css" href="CSS/style.css" />
        <link rel="stylesheet" type="text/css" href="CSS/style2.css" />    
        <link rel="stylesheet" type="text/css" href="css/grumble.min.css" />
        <script type="text/javascript" src="js/jquery.grumble.min.js"></script>
    </head>
    <body>


        <div class="bandeau">
            <h1> Finances du festival</h1>
        </div><!--bandeau-->

        <div class="canvas" id ="canvas" height="400" width="800" style="margin:50px">
            <canvas id="barChart"> Votre navigateur ne prend pas en charge Canvas </canvas>
        </div>
        <div class="select">
            <form id="select" action="" method="get" autocomplete="off">
                Choisir le type:
                <br>
                <label>
                    <input type="radio" name="type" value="1" checked>Lieu</label>
                <label>
                    <input type="radio" name="type" value="2">Compagnie</label>
                <label>
                    <input type="radio" name="type" value="3">Spectacle</label>
            </form>
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
                <li><a href="./FirstPart/TroupeParTroupe.php">Jour par Jour</a></li>
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


        <script type="text/javascript">

            //选择框单击后
            $('#select input:radio').click(function () {
                if ($(this).val() === '1') {
                    data = arrLieu(csvData);
                    goBarChart(data, "Lieu");
                } else if ($(this).val() === '2') {
                    data = arrCompagnie(csvData);
                    goBarChart(data, "Compagnie");
                } else {
                    data = arrSpectacle(csvData);
                    goBarChart(data, "Spectacle");
                }
            });

        </script>
    </body>
</html>

