<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Tableaus{
public static $dist_time = array(
    "Moulins" => array(
        "Moulins" => "0km/0h0",
        "Monétay" => "25km/0h30",
        "Vichy" => "69km/1h10",
        "Monteignet" => "91km/1h05",
        "Veauce" => "91km/1h08",
        "Clermont-Ferrand" => "98km/1h37"
    ),
    "Monétay" => array(
        "Moulins" => "25km/0h30",
        "Monétay" => "0km/0h0",
        "Vichy" => "39km/0h45",
        "Monteignet" => "33km/0h36",
        "Veauce" => "45km/0h42",
        "Clermont-Ferrand" => "107km/1h20"
    ),
    "Vichy" => array(
        "Moulins" => "69km/0h30",
        "Monétay" => "39km/0h45",
        "Vichy" => "0km/0h0",
        "Monteignet" => "18km/0h26",
        "Veauce" => "54km/0h58",
        "Clermont-Ferrand" => "56km/1h05"
    ),
    "Monteignet" => array(
        "Moulins" => "91km/1h05",
        "Monétay" => "33km/0h36",
        "Vichy" => "18km/0h26",
        "Monteignet" => "0km/0h0",
        "Veauce" => "22km/0h26",
        "Clermont-Ferrand" => "50km/0h55"
    ),
    "Veauce" => array(
        "Moulins" => "91km/1h08",
        "Monétay" => "45km/0h42",
        "Vichy" => "54km/0h58",
        "Monteignet" => "22km/0h26",
        "Veauce" => "0km/0h0",
        "Clermont-Ferrand" => "54km/0h45"
    ),
    "Clermont-Ferrand" => array(
        "Moulins" => "95km/1h37",
        "Monétay" => "107km/1h20",
        "Vichy" => "56km/1h05",
        "Monteignet" => "50km/0h55",
        "Veauce" => "54km/0h45",
        "Clermont-Ferrand" => "0km/0h0"
    )
);

public static $table1 = array
    (
    "Veauce" => array
        (
        "Manoir des noix" => array(
            "02 août 2019" => array(
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "14h30",
                    "title" => "La Compagnie de l’Élan présente LE TARTUFFE OU L'IMPOSTEUR",
                    "spectateur" => "Molière"),
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "17h00",
                    "title" => "L'Ecume des ours présente MADEMOISELLE JULIE ",
                    "spectateur" => "August Strindberg"),
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "20h30",
                    "title" => "La Compagnie de l’Élan présente LE MARCHAND DE VENISE",
                    "spectateur" => "William Shakespeare")
            ),
            "03 août 2019" => array(
                array(
                    "Jour" => "Samedi",
                    "Heure" => "14h30",
                    "title" => "La Compagnie de l’Élan présente LE MARIAGE",
                    "spectateur" => "Jean Luc Jeener"),
                array(
                    "Jour" => "Samedi",
                    "Heure" => "17h00",
                    "title" => "Alterthéâtre présente TITRE PROVISOIRE",
                    "spectateur" => "Pauline Mornet"),
                array(
                    "Jour" => "Samedi",
                    "Heure" => "20h30",
                    "title" => "Le Théâtre du partage présente LE PROPHÈTE",
                    "spectateur" => "Khalil Gibran")
            ),
            "04 août 2019" => array(
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "14h30",
                    "title" => " L'Accompagnie présente LA GLOIRE DE MON PÈRE",
                    "spectateur" => "Marcel Pagnol"),
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "17h00",
                    "title" => "L'Accompagnie présente LE CHÂTEAU DE MA MÈRE",
                    "spectateur" => "Marcel Pagnol"),
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "20h30",
                    "title" => "labelles&cie présente LES SOLILOQUES DE MARIETTE",
                    "spectateur" => "Albert Cohen")
            ),
            "05 août 2019" => array(
                array(
                    "Jour" => "Lundi",
                    "Heure" => "14h30",
                    "title" => "labelles&cie présente PORT RACINES",
                    "spectateur" => "Pierre Bertand, Anne Danais, et Anaïs Renaudie"),
                array(
                    "Jour" => "Lundi",
                    "Heure" => "17h00",
                    "title" => "TIM La Parade présente HUGO ES TU LÀ?",
                    "spectateur" => "Victor Hugo"),
                array(
                    "Jour" => "Lundi",
                    "Heure" => "20h30",
                    "title" => "Des ils et des elles présente LA PROMESSE DE L'AUBE",
                    "spectateur" => "Romain Gary")
            ),
            "06 août 2019" => array(
                array(
                    "Jour" => "Mardi",
                    "Heure" => "17h00",
                    "title" => "Rêve général présente BARBARA, OÙ RÊVENT MES SAISONS",
                    "spectateur" => "Barbara"),
                array(
                    "Jour" => "Mardi",
                    "Heure" => "20h30",
                    "title" => "L'Ecume des ours présente LA DEMANDE EN MARIAGE ET L'OURS",
                    "spectateur" => "Anton Tchekhov")
            )
        ),
        "Eglise" => array(
            "02 août 2019" => array(
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "14h30",
                    "title" => "Le Théâtre du partage présente LES CONFESSIONS : LES ANNÉES DE JEUNESSE",
                    "spectateur" => "Saint Augustin")
            ),
            "03 août 2019" => array(
                array(
                    "Jour" => "Samedi",
                    "Heure" => "14h30",
                    "title" => "Le Théâtre du partage présente LES CONFESSIONS : LES ANNÉES DE MATURITÉ",
                    "spectateur" => "Saint Augustin")
            ),
            "04 août 2019" => array(
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "14h30",
                    "title" => "Le Théâtre du partage présente LES CONFESSIONS : LES ANNÉES DE SAGESSE",
                    "spectateur" => "Saint Augustin")
            )
        )
    ),
    "Monétay" => array
        (
        "Château de Lachaise" => array(
            "02 août 2019" => array(
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "17h00",
                    "title" => "L'Accompagnie présente LA GLOIRE DE MON PÈRE",
                    "spectateur" => "Marcel Pagnol"),
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "20h30",
                    "title" => "L'Accompagnie présente LE CHÂTEAU DE MA MÈRE",
                    "spectateur" => "Marcel Pagnol")
            ),
            "03 août 2019" => array(
                array(
                    "Jour" => "Samedi",
                    "Heure" => "14h30",
                    "title" => "labelles&cie présente LES SOLILOQUES DE MARIETTE",
                    "spectateur" => "Albert Cohen"),
                array(
                    "Jour" => "Samedi",
                    "Heure" => "17h00",
                    "title" => " labelles&cie présente LES SOLILOQUES DE MARIETTE",
                    "spectateur" => "Anton Tchekhov"),
                array(
                    "Jour" => "Samedi",
                    "Heure" => "20h30",
                    "title" => "labelles&cie présente FRICASSÉE DE BERNIQUES SUR LIT DE PRÉVERT",
                    "spectateur" => "Jacques Prévert")
            ),
            "04 août 2019" => array(
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "14h30",
                    "title" => "L'Ecume des ours présente MADEMOISELLE JULIE",
                    "spectateur" => "August Strindberg"),
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "17h00",
                    "title" => "Alterthéâtre présente TITRE PROVISOIRE",
                    "spectateur" => "Pauline Mornet"),
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "20h30",
                    "title" => "TIM La Parade présente HUGO ES TU LÀ?",
                    "spectateur" => "Victor Hugo")
            ),
            "05 août 2019" => array(
                array(
                    "Jour" => "Lundi",
                    "Heure" => "14h30",
                    "title" => "La Compagnie de l’Élan présente LE MARIAGE",
                    "spectateur" => "Jean Luc Jeener"),
                array(
                    "Jour" => "Lundi",
                    "Heure" => "17h00",
                    "title" => "Le Théâtre du partage présente LE PROPHÈTE",
                    "spectateur" => "Khalil Gibran"),
                array(
                    "Jour" => "Lundi",
                    "Heure" => "20h30",
                    "title" => "La Compagnie de l’Élan présente LE MARCHAND DE VENISE",
                    "spectateur" => "William Shakespeare")
            ),
            "06 août 2019" => array(
                array(
                    "Jour" => "Mardi",
                    "Heure" => "20h30",
                    "title" => "Des ils et des elles présente LA PROMESSE DE L'AUBE",
                    "spectateur" => "Romain Gary")
            )
        )
    ),
    "Monteignet" => array
        (
        "Château d'Idogne" => array(
            "02 août 2019" => array(
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "14h30",
                    "title" => "Rêve général présente BARBARA, OÙ RÊVENT MES SAISONS",
                    "spectateur" => "Barbara"),
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "17h00",
                    "title" => "labelles&cie présente LES SOLILOQUES DE MARIETTE",
                    "spectateur" => "Alebert Cohen")
            ),
            "03 août 2019" => array(
                array(
                    "Jour" => "Samedi",
                    "Heure" => "14h30",
                    "title" => "L'Accompagnie présente LA GLOIRE DE MON PÈRE",
                    "spectateur" => "Marcel Pagnol"),
                array(
                    "Jour" => "Samedi",
                    "Heure" => "17h00",
                    "title" => "L'Accompagnie présente LE CHÂTEAU DE MA MÈRE",
                    "spectateur" => "Marcel Pagnol")
            ),
            "04 août 2019" => array(
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "14h30",
                    "title" => "La Compagnie de l’Élan présente LE TARTUFFE OU L'IMPOSTEUR",
                    "spectateur" => "Molière"),
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "17h00",
                    "title" => "Des ils et des elles présente LA PROMESSE DE L'AUBE",
                    "spectateur" => "Romain Gary")
            ),
            "05 août 2019" => array(
                array(
                    "Jour" => "Lundi",
                    "Heure" => "14h30",
                    "title" => "L'Ecume des ours présente LA DEMANDE EN MARIAGE ET L'OURS",
                    "spectateur" => "Anton Tchekhov"),
                array(
                    "Jour" => "Lundi",
                    "Heure" => "17h00",
                    "title" => "Alterthéâtre présente TITRE PROVISOIRE",
                    "spectateur" => "Pauline Mornet")
            ),
            "06 août 2019" => array(
                array(
                    "Jour" => "Mardi",
                    "Heure" => "14h30",
                    "title" => "labelles&cie présente PORT RACINES",
                    "spectateur" => "Pierre Bertand, Anne Danais, et Anaïs Renaudie")
            )
        ),
        "Domaine de la Quérye" => array(
            "02 août 2019" => array(
                array(
                    "Jour" => "Vendredi",
                    "Heure" => "20h30",
                    "title" => "Le Théâtre du partage présente LE PROPHÈTE",
                    "spectateur" => "Khalil Gibran")
            ),
            "03 août 2019" => array(
                array(
                    "Jour" => "Samedi",
                    "Heure" => "20h30",
                    "title" => "La Compagnie de l’Élan présente LE MARIAGE",
                    "spectateur" => "Jean Luc Jeener")
            ),
            "04 août 2019" => array(
                array(
                    "Jour" => "Dimanche",
                    "Heure" => "20h30",
                    "title" => "La Compagnie de l’Élan présente LE MARCHAND DE VENISE",
                    "spectateur" => "William Shakespeare")
            ),
            "05 août 2019" => array(
                array(
                    "Jour" => "Lundi",
                    "Heure" => "20h30",
                    "title" => "L'Ecume des ours présente MADEMOISELLE JULIE",
                    "spectateur" => "August Strindberg")
            )
        )
    ),
    "Moulins" => array
        (
        "Centre National du Costume de Scène" => array(
            "06 août 2019" => array(
                array(
                    "Jour" => "Mardi",
                    "Heure" => "20h00",
                    "title" => "La Compagnie de l’Élan présente LE TARTUFFE OU L'IMPOSTEUR ",
                    "spectateur" => "Molière")
            )
        )
    )
);
}