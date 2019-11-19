/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $("#datepicker").datepicker();
    $(document).on('click', '.btn_hide', function () {
        $(".menu").toggle("slow");
        $(".btn_show").toggle("slow");
        //$(".btn_show").css("display","fixed");
        $(this).toggle("slow");
    });
    $(document).on('click', '.btn_show', function () {
        $(".menu").toggle("slow");
        $(".btn_hide").toggle("slow");
        $(this).toggle("slow");
    });
    $(document).on('click', '.but_hide_tab', function () {
        $("#tableau").toggle("slow");
        $(".but_show_tab").toggle(1000);
        $(this).toggle();
    });
    $(document).on('click', '.but_show_tab', function () {
        $("#tableau").toggle("slow");
        $(".but_hide_tab").toggle("slow");
        $(this).toggle();
    });
    /*pour obtenir le tableau qui contient tous les titles de spectacles possible à participer*/
    var tab_titles = $(".tit_spect");
    var tab_titles = new Array();
    $(".tit_spect").each(function () {
        let item_tit = $(this);
        tab_titles.push(item_tit.html());
    });
    /* utilise Ajax d'envoyer les donnes a*/
    $(".spect_dispo").each(function () {
        var parag = $(this);
        var title = parag.children(".tit_spect");
        var btn_reserv = parag.children(".btn_reserv");
        btn_reserv.click(function () {
            var tit_contenu = title.html(); //obtient le contenu de titre du spectacle en clique
            let count = 0;
            let temp = "";
            for (let i = 0; i < tab_titles.length; i++) {//循环查找到点击所对应的下标记为count
                if (tit_contenu === tab_titles[i]) {
                    count = i;
                }
            }
            temp = tab_titles[0];
            tab_titles[0] = tab_titles[count];
            tab_titles[count] = temp; //将第一个title认定为用户点击的那一个以便之后进行调用
            //接下来要做的是将数组中的所有元素拼接为一个长字符串以便更容易传递
            //如果用Ajax传递数组的话之后在php后台对数组同样需要处理，因此我尝试两种方式来做
            let String_buff = "";
            for (let j = 0; j < tab_titles.length - 1; j++) {
                String_buff += tab_titles[j] + "/";
            }
            String_buff += tab_titles[tab_titles.length - 1];
            $.ajax({
                url: "./Temporaire.php",
                async: false,
                type: 'POST',
                data: {username: String_buff},
                success: function (data) {
                    window.location.href = "./PageReservation.php";
                },
                error: function () {
                    alert("#");
                }
            });
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

