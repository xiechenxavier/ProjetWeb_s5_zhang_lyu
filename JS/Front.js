/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    //show a calendar to promote user to choose date 
    $("#datepicker").datepicker();
    $(document).on('click', '.btn_hide', function () {
        $(".menu").toggle("slow");
        $(".btn_show").toggle("slow");
        //$(".btn_show").css("display","fixed");
        $(this).toggle("slow");
    });
    //A button which is used to show or hide the navigator left 
    $(document).on('click', '.btn_show', function () {
        $(".menu").toggle("slow");
        $(".btn_hide").toggle("slow");
        $(this).toggle("slow");
    });
    //A button which is used to show the complete form Time and distance
    $(document).on('click', '.but_hide_tab', function () {
        $("#tableau").toggle("slow");
        $(".but_show_tab").toggle(1000);
        $(this).toggle();
    });
    //A button which is used to hide the complete form Time and distance
    $(document).on('click', '.but_show_tab', function () {
        $("#tableau").toggle("slow");
        $(".but_hide_tab").toggle("slow");
        $(this).toggle();
    });
    /*utilise Ajax de traiter les donnees de tableaux de reservation*/
    $("#submit").click(function () {
        var lieu_d = $("#d_lieu option:selected").text();
        var lieu_a = $("#a_lieu option:selected").text();
        var Date = $("#datepicker").val();
        var heure = $("#Heure").val();
        $.ajax({
            url: "./Services.php",
            type: 'POST',
            datatype: "HTML",
            async: false,
            data: {d_lieu: lieu_d,
                a_lieu: lieu_a,
                Date: Date,
                heure: heure},
            success: function (data) {
                $('.theatre').html(data);
                /* ajouter les commandes des options de spectacle dans le panier:
                 * clique le bouton pour ajouter un spectacle dans le panier*/
                $(".spect_dispo").each(function () {
                    var parag = $(this);
                    var title = parag.children(".tit_spect");
                    var Daytime = parag.children(".Day_time");
                    var spectateur = parag.children(".spec_acteur");
                    var btn_reserv = parag.children(".btn_reserv");
                    btn_reserv.click(function () {
                        //Obtenir l'ordonnee de la position du bouton en cliquant
                        var y = $(this).offset().top;
                        var res = parseInt($('.on').html());
                        /*l'Animation d'ajouter le spectacle*/
                        if (isNaN(res) || res === 0) {
                            $('.on').html(res + 1 + "");
                            $('.on').show("slow");
//                            $(".on").css("left", -7);
                            $(".on").css("top", y - 120);
                            $('.on').animate({left: 18});
                            $('.on').animate({top: 3});
                        } else {
//                            $(".on").css("left", -7);
                            $(".on").css("top", y - 120);
                            $('.on').animate({left: 18});
                            $('.on').animate({top: 3});
                            $('.on').html(res + 1 + "");
                        }
                        parag.hide("slow");
                        var tit_contenu = title.html();
                        var Day_time = Daytime.html();
                        var nom_acteur = spectateur.html();
                        var Date = $("#datepicker").val();
                        let Ville_a = $("#a_lieu option:selected").text();
                        let str = "<p class='added'>" + Ville_a + "*" + Date + "*" + Day_time + "*" + tit_contenu + "*" + nom_acteur + "</p>";
                        $(".spect_Ajoute").append(str);
                    });
                });
            },
            error: function () {
                alert("#");
            }
        });
    });
    /**Cliquer l'icone de panier pour transmettre les enregistrement des commandes:
     *  */
    $(document).on("click", ".icone", function () {
        var array_added = new Array();
        $(".added").each(function () {
            var add_ele = $(this).html();
            array_added.push(add_ele);
        });
        $.ajax({
            url: "./Temporaire.php",
            type: 'POST',
            async: false,
            data: {
                arrayAdded: array_added
            },
            success: function (data) {
                // window.location.href = "./PageReservation.php";
                // alert("marcher bien");
                //window.location.href = "";
                window.open("./PageReservation.php","_blank");

            },
            error: function () {
                alert("#");
            }
        });
    });

    /**Cette partie parmet de calculer le prix des billes  */
    var nb = 0;
    var price_bille = 0;
    var bille_type = "";
    function judgeBillePrice() {
        switch (bille_type) {
            case "Plein tarif":
                price_bille = 15;
                break;
            case "Tarif réduit":
                price_bille = 10;
                break;
            case "Enfant gratuit":
                price_bille = 0;
                break;
            default:
                price_bille = 0;
        }
    }
    $("#nombre").change(function () {
        nb = parseInt($(this).find("option:selected").text());
        bille_type = $("#type").find("option:selected").text();
        if (isNaN(nb) || bille_type === "Select Type" || nb === 0) {
            $(".Curr_price").html("X");
        } else {
            judgeBillePrice();
            let prix_total = price_bille * nb;
            $(".Curr_price").html("" + prix_total);
        }
    });
    $("#type").change(function () {
        nb = parseInt($("#nombre").find("option:selected").text());
        bille_type = $(this).find("option:selected").text();
        if (isNaN(nb) || nb === 0 || bille_type === "Select Type") {
            $(".Curr_price").html("X");
        } else {
            judgeBillePrice();
            let prix_total = price_bille * nb;
            $(".Curr_price").html("" + prix_total);
        }
    });
    /** apres terminer de choisir le nombre des billes et le type des billes, ensuite l'ajoute dans le panier*/
    $(document).on("click", ".ajouter", function () {
        let nom_spectacle = $(".Spec_Options").find("option:selected").text();
        let quantite_billes = $("#nombre").find("option:selected").text();
        let prix = parseInt($(".Curr_price").html());
        if (!(isNaN(prix))) {
            let str = "<tr class='commande'><td>" + nom_spectacle + "</td>" + "<td>" + quantite_billes + "</td>" + "<td>" + prix + "</td>"
                    + "<td align='center'><img id='btn_delete' src='./images/delete.png'/></td>";
            $(".divtableau>table").append(str);
            $("#type").find("option[value='1']").attr("selected", true);
        }
        /*Annuler une ligne de la commande*/
        $(".commande").each(function () {
            let curr_com = $(this);
            let obj = curr_com.children('td').children("img");
            obj.click(function () {
                curr_com.remove();
            });
        });
        //有可能是在这里添加
    });
    $(".annule_tous").click(function () {
        if ($(".commande").length !== 0) {
            $.confirm({
                title: 'confirmation!',
                content: 'Vous êtes sur pour annuler toutes les commandes?',
                buttons: {
                    confirm: function () {
                        $(".commande").remove();
                    },
                    cancel: function () {
                        $.alert("operation annulée");
                    }
                }
            });
        }
    });
});