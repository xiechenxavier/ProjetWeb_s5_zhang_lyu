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
        <link rel="stylesheet" type="text/css" href="./CSS/style2.css" />
        <link rel="stylesheet" href="Lieux%E2%80%AF;%20Th%C3%A9%C3%A2tres%20de%20Bourbon_fichiers/styleTheatresDeBourbonPourPHP.css">
        <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="./JS/Front.js"></script>
    </head>
    <body>
        <div id="Form_distance">
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
        </div>
        <div>
            <form action="Services.php" method="post">
                <label>Lieu_depart:</label> <input type="text" name="lieu">
                <label>Lieu_arrivé:</label> <input type="text" name="lieu">
                Date：<input type="text" id="datepicker">
                <input type="submit" value="提交">
            </form>
        </div>
    </body>
</html>
