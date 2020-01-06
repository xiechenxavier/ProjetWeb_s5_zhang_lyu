<!DOCTYPE html>
<html>

    <!-- Affichage Dans l'onglet et choix des caractères-->
    <head>
        <title> Lieux&#8239;; Théâtres de Bourbon </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="./CSS/style.css" />
        <link rel="stylesheet" type="text/css" href="./CSS/style2.css" />
    </head>
    <body>
        <form class="Welcome" action="getto.php" method="GET">
            <!--<p>    <input id="url" class="url" name="url" type="text" placeholder="tape un lien d'une page"/></p>-->
            <p class="par1">
                <select name="url" id="url">
                    <option value="selecte une page à visiter"></option>
                    <option value="notre Accueil">notre Accueil</option>
                    <option value="Programme par lieus">Programme par lieus</option>
                    <option value="Programme par jour">Programme par jour</option>
                    <option value="Programme par Troupe">Programme par Troupe</option>
                    <option value="reserver les billes">reserver les billes</option>
                </select>
            </p>
            <p class="par2">    <input type="submit" value="Allez-y" class="signup-btn" /></p>
           <!--  <input type="text" placeholder="Full Name" name="name" class="textb" required />
                <input type="text" placeholder="UserName" -->
        </form>

    </body>
</html>
