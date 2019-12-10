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
                        /*ajouter les enregistrements dans la fichier*/
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
                            },
                            error: function () {
                                alert("#");
                            }
                        });
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
        window.open("./PageReservation.php", "_blank");
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


    var prix_t = 0;
    $(".total").append(prix_t);
    $(".item_spectacles").each(function () {
        var curr_item = $(this).children(".item_contenu");
        var Ville_a = $(this).children(".villes").html(); //戏在哪个城市
        var Date_spect = $(this).children(".date_spect").html(); //看戏的日期
        curr_item.each(function () {
            var nombre = $(this).children("#nombre");
            var type = $(this).children("#type");
            var spectacle_name = $(this).children(".name_Spectacle").html();
            var btn_ajoute = $(this).children(".ajouter");
            var Curr_prix = $(this).children(".Curr_price");
            nombre.change(function () {
                nb = parseInt($(this).find("option:selected").text());
                bille_type = type.find("option:selected").text();
                if (isNaN(nb) || bille_type === "Select Type" || nb === 0) {
                    Curr_prix.html("X");
                } else {
                    judgeBillePrice();
                    let prix_total = price_bille * nb;
                    Curr_prix.html("" + prix_total);
                }
            });
            type.change(function () {
                nb = parseInt(nombre.find("option:selected").text());
                bille_type = $(this).find("option:selected").text();
                if (isNaN(nb) || nb === 0 || bille_type === "Select Type") {
                    Curr_prix.html("X");
                } else {
                    judgeBillePrice();
                    let prix_total = price_bille * nb;
                    Curr_prix.html("" + prix_total);
                }
            });
            btn_ajoute.click(function () {
                //                let nom_spectacle = $(".Spec_Options").find("option:selected").text();
                let quantite_billes = nombre.find("option:selected").text();
                let prix = parseInt(Curr_prix.html());
                var Date = $("#datepicker").val();
                // let Ville_a = $("#a_lieu option:selected").text();
                if (!(isNaN(prix))) {

                    var flag = false; /*判断新建的订单是否已经加入*/
                    if ($(".commande").length !== 0) {


                        for (var i = 0; i < $(".commande").length; i++) {
                            let s_name = $(".name").get(i).innerText;
                            let v = $(".ville").get(i).innerText;
                            let p = parseInt($(".prix").get(i).innerText);
                            let q = parseInt($(".quantite").get(i).innerText);
                            let d = $(".date").get(i).innerText;
                            if (s_name === spectacle_name && Ville_a === v && d === Date_spect) {
                                $(".prix").get(i).innerText = p + prix;
                                $(".quantite").get(i).innerText = q + parseInt(quantite_billes);
                                flag = true; /*将flag设为真表示这条订单已被添加*/
                                break;
                            }
                        }

                        if (!flag) {  /*如果购物篮内没有重复的,flag仍为false,此处则新建一个*/
                            let str = "<tr class='commande'><td class = 'name'>" + spectacle_name + "</td>" + "<td class = 'quantite'>" + quantite_billes + "</td>" + "<td class = 'prix'>" + prix + "</td>"
                                    + "<td class='ville'>" + Ville_a + "</td>" + "<td class = 'date'>" + Date_spect + "</td>" + "<td align='center'><img id='btn_delete' src='./images/delete.png'/></td></tr>";
                            $(".divtableau>table").append(str);
                            $("#type").find("option[value='1']").attr("selected", true);
                            flag = false;
                        }


                    } else {
                        let str = "<tr class='commande'><td class = 'name'>" + spectacle_name + "</td>" + "<td class = 'quantite'>" + quantite_billes + "</td>" + "<td class = 'prix'>" + prix + "</td>"
                                + "<td class='ville'>" + Ville_a + "</td>" + "<td class = 'date'>" + Date_spect + "</td>" + "<td align='center'><img id='btn_delete' src='./images/delete.png'/></td></tr>";
                        $(".divtableau>table").append(str);
                        $("#type").find("option[value='1']").attr("selected", true);
                    }

                    prix_t = prix_t + prix;
                    $(".total").html(prix_t);
                }
                /*Annuler une ligne de la commande*/
                $(".commande").each(function () {
                    let curr_com = $(this);
                    let obj = curr_com.children('td').children("#btn_delete");
                    obj.click(function () {
                        let x = parseInt(curr_com.children(".prix").html());
                        if (prix_t - x >= 0) {
                            prix_t -= x;
                        }
                        $(".total").html(prix_t);
                        curr_com.remove();
                        prix_t -= x;
                    });
                });
                //有可能是在这里添加
            });
        });
    });
    //vider la liste des spectacles
    $('.vider_liste').click(function () {
        if ($(".item_spectacles").length !== 0) {
            $.confirm({
                title: 'confirmation!',
                content: 'Vous êtes sur à Vider la contenu de la liste?',
                buttons: {
                    confirm: function () {
                        //$(".commande").remove();
                        $.ajax({
                            url: "./EmptyRecord.php",
                            type: 'POST',
                            async: false,
                            data: {
                                ViderListe: "TRUE"
                            },
                            success: function (data) {

                                if (window.opener!==null) {
                                    //window.opener 就是当前页面内的打开者，我们要对该页面进行刷新
                                    window.opener.location.reload();
                                }
                                window.location.reload(); //刷新当前页面
                                //window.parent.location.reload();
                            },
                            error: function () {
                                alert("#");
                            }
                        });
                    },
                    cancel: function () {
                        $.alert("operation annulée");
                    }
                }
            });
        }
    });
    $(".annule_tous").click(function () {
        if ($(".commande").length > 0) {//表示如果整个表格中里面有元素时
            $.confirm({
                title: 'confirmation!',
                content: 'Vous êtes sur pour annuler toutes les commandes?',
                buttons: {
                    confirm: function () {
                        $(".commande").remove();
                        prix_t = 0;
                        $(".total").html(prix_t);
                    },
                    cancel: function () {
                        $.alert("operation annulée");
                    }
                }
            });
        }
    });
    $(".payer").on("click", function () {
        if ($(".commande").length > 0) {//表示如果整个表格中里面有元素时
            $('#tables').tableExport({
                filename: 'form',
                format: 'csv'
            });
        }
    });
});







/*test*/