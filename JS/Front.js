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
    $("#submit").click(function () {
        $("#mode_options").show(300);
    });
    $(".aide_qqn").click(function () {
        $("#mode_options").hide(300);
    });
    $(".reserv_soi_meme").click(function () {
        $("#mode_options").hide(300);
        //$("#mode_options").toggle(800);
        if (parseInt($(".on").html()) > 0) {//表示如果整个表格中里面有元素时
            $.confirm({
                title: 'Notification!',
                content: 'Parceque vous avez deja choisi des spectacles dans au moins une ville, \n\
                          Veuillez utiliser vos reservation d\'histoire pour modifier \n\
                          l\'heure à laquelle vous prévoyez de réserver un spectacle dans la prochaine ville',
                buttons: {
                    confirm: function () {

                        $("#Heure").attr("value", "");
                    },
                    cancel: function () {
                    }
                }
            });
        }
    });
    $(document).ready(function () {
//do something
        var res = parseInt($('.on').html());
        if (res > 0) {
            $(".on").show();
        } else {
            $(".on").hide();
        }
    });
    /*utilise Ajax de traiter les donnees de tableaux de reservation*/
    $(".reserv_soi_meme,.aide_qqn").click(function () {
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
                            $(".on").css("top", y - 120);
                            $('.on').animate({left: 18});
                            $('.on').animate({top: 3});
                        } else {
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
                        let village = parag.parents(".SpectsPart").children("h3").children("Lieu").html();
                        let str = "<p class='added'>" + Ville_a + "*" + Date + "*" + Day_time + "*" + tit_contenu + "*" + nom_acteur + "*" + village + "</p>";
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
    //creer la classe de Hashtable pour l'implementer apres
    jQuery.Hashtable = function () {
        this.items = new Array();
        this.itemsCount = 0;
        this.add = function (key, value) {
            if (!this.containsKey(key)) {
                this.items[key] = value;
                this.itemsCount++;
            } else {
                //throw "key '" + key + "' allready exists."
                this.items[key] = value;
            }
        }

        //obtenir une value dans la hashtable
        this.get = function (key) {
            if (this.containsKey(key))
                return this.items[key];
            else
                return null;
        }

        //suprimer une cle dans la table
        this.remove = function (key) {
            if (this.containsKey(key)) {
                delete this.items[key];
                this.itemsCount--;
            } else
                throw "key '" + key + "' does not exists."

        }
        //verifier si cette Hashtable contient une cle
        this.containsKey = function (key) {
            return typeof (this.items[key]) != "undefined";
        }

        //verifier si cette Hashtable contient une value
        this.containsValue = function containsValue(value) {
            for (var item in this.items) {
                if (this.items[item] == value)
                    return true;
            }

            return false;
        }

        //verifier si cette Hashtable contient une cle ou une value
        this.contains = function (keyOrValue) {
            return this.containsKey(keyOrValue) || this.containsValue(keyOrValue);
        }

        //vider la hashTable
        this.clear = function () {
            this.items = new Array();
            itemsCount = 0;
        }

        //obtenir la taille de la hashtable
        this.size = function () {
            return this.itemsCount;
        }

        //verifier si hashtable est vide
        this.isEmpty = function () {
            return this.size() == 0;
        }
    };
    var prix_t = 0;
    var hashtable = new jQuery.Hashtable(); //ca permet d'enregistrer toutes les infos d'une ligne de commande
    $(".total").append(prix_t);
    $(".item_spectacles").each(function () {
        var curr_item = $(this).children(".item_contenu");
        var Ville_a = $(this).children(".villes").html(); //spectacle de qulle ville
        var Date_spect1 = $(this).children(".date_spect").html(); //la date de la spectacle
        curr_item.each(function () {
            var nombre = $(this).children("#nombre");
            var type = $(this).children("#type");
            var spectacle_name = $(this).children(".name_Spectacle").html();
            var Spect_time = $(this).children(".Spect_time").html();
            var arr = Spect_time.split(" ");
            var Date_spect = arr[0] + " " + Date_spect1;
            var Heures = arr[1];//L'heure 
            var Compagnie = $(this).children(".Spectateur").html();//le troupe
            var Village = $(this).children(".Lieu_village").html(); //le lieu
            var btn_ajoute = $(this).children(".ajouter"); //bouton "ajouter" permet d'ajouter une commande de theatre
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
                let quantite_billes = nombre.find("option:selected").text();
                let prix = parseInt(Curr_prix.html());
                bille_type = type.find("option:selected").text();
                var nb_pl = 0; //compter le nombre de plein tarif
                var nb_rd = 0; //compter le nombre de tarif reduit
                var nb_Ef = 0; //compter le nombre de billet offert
                var nb_off = 0;
                //pour get the number of this type of tickets 
                switch (bille_type) {
                    case "Plein tarif":
                        nb_pl += parseInt(quantite_billes);
                        break;
                    case "Tarif réduit":
                        nb_rd += parseInt(quantite_billes);
                        break;
                    case "Enfant gratuit":
                        nb_Ef += parseInt(quantite_billes);
                        break;
                }

                if (!(isNaN(prix))) {
                    var flag = false; /*verifier si la nouovelle commande a bien ete ajoute */
                    if ($(".commande").length !== 0) {
                        for (var i = 0; i < $(".commande").length; i++) {
                            let s_name = $(".name").get(i).innerText;
                            let v = $(".ville").get(i).innerText;
                            let p = parseInt($(".prix").get(i).innerText);
                            let q = parseInt($(".quantite").get(i).innerText);
                            let d = $(".date").get(i).innerText;
                            let h = $(".heure_e").get(i).innerText;
                            if (s_name === spectacle_name && Ville_a === v && d === Date_spect && Heures === h) {
                                $(".prix").get(i).innerText = p + prix;
                                $(".quantite").get(i).innerText = q + parseInt(quantite_billes);
                                flag = true; /*vrai ssi cette commande existe deja, false sinon*/
                                break;
                            }
                        }

                        if (!flag) {  /*si dans la table, il n'y a pas cette commande avant*/
                            let str = "<tr class='commande'><td class = 'name'>" + spectacle_name + "</td>" + "<td class = 'quantite'>" + quantite_billes + "</td>" + "<td class = 'prix'>" + prix + "</td>"
                                    + "<td class='ville'>" + Ville_a + "</td>" + "<td class='Village'>" + Village + "</td>" + "<td class='Compagnie'>" + Compagnie + "</td>"
                                    + "<td class = 'date'>" + Date_spect + "</td>" + "<td class = 'heure_e'>" + Heures + "</td>" +
                                    "<td align='center'><img id='btn_delete' src='./images/delete.png'/></td></tr>";
                            $(".divtableau>table").append(str);
                            $("#type").find("option[value='1']").attr("selected", true);
                            flag = false;
                            hashtable.add(Date_spect + spectacle_name + Ville_a, {"Plein_tarif": nb_pl, "Tarif_reduit": nb_rd, "Enfant_gratuit": nb_Ef, "Billet_offert": nb_off});
                        } else {/*Si le formulaire existant existe déjà, l'indicateur est vrai et l'enregistrement de table de hachage est mis à jour*/
                            let cur_nb_pl = hashtable.get(Date_spect + spectacle_name + Ville_a).Plein_tarif + nb_pl;
                            let cur_nb_rd = hashtable.get(Date_spect + spectacle_name + Ville_a).Tarif_reduit + nb_rd;
                            let cur_nb_Ef = hashtable.get(Date_spect + spectacle_name + Ville_a).Enfant_gratuit + nb_Ef;
                            let cur_nb_off = hashtable.get(Date_spect + spectacle_name + Ville_a).Billet_offert + nb_off;
                            hashtable.remove(Date_spect + spectacle_name + Ville_a);
                            hashtable.add(Date_spect + spectacle_name + Ville_a, {"Plein_tarif": cur_nb_pl, "Tarif_reduit": cur_nb_rd, "Enfant_gratuit": cur_nb_Ef, "Billet_offert": cur_nb_off});
                        }
                    } else {
                        let str = "<tr class='commande'><td class = 'name'>" + spectacle_name + "</td>" + "<td class = 'quantite'>" + quantite_billes + "</td>" + "<td class = 'prix'>" + prix + "</td>"
                                + "<td class='ville'>" + Ville_a + "</td>" + "<td class='Village'>" + Village + "</td>" + "<td class='Compagnie'>" + Compagnie + "</td>"
                                + "<td class = 'date'>" + Date_spect + "</td>" + "<td class = 'heure_e'>" + Heures + "</td>" +
                                "<td align='center'><img id='btn_delete' src='./images/delete.png'/></td></tr>";
                        $(".divtableau>table").append(str);
                        $("#type").find("option[value='1']").attr("selected", true);
                        hashtable.add(Date_spect + spectacle_name + Ville_a, {"Plein_tarif": nb_pl, "Tarif_reduit": nb_rd, "Enfant_gratuit": nb_Ef, "Billet_offert": nb_off});
                    }
                    prix_t = prix_t + prix;
                    $(".total").html(prix_t);
                    $(".nb1").html(parseInt($(".nb1").html()) + nb_pl);
                    $(".nb2").html(parseInt($(".nb2").html()) + nb_rd);
                    $(".nb3").html(parseInt($(".nb3").html()) + nb_Ef);
                    var reduit = checkReduction();
                    ShowOrHide(reduit);
                }
                /*Annuler une ligne de la commande*/
                $(".commande").each(function () {
                    let curr_com = $(this);
                    let obj = curr_com.children('td').children("#btn_delete");
                    let date = curr_com.children('td').children(".date").html();
                    let name = curr_com.children("td").children(".name").html();
                    let ville = curr_com.children("td").children(".ville").html();
                    obj.click(function () {
                        curr_com.remove();
                        checkTotal();
                        if (hashtable.containsKey(date + name + ville)) {
                            hashtable.remove(date + name + ville);
                        }
                        checkBilleParType();
                        var reduit = checkReduction();
                        ShowOrHide(reduit);
                    });
                });
            });
        });
    });


    function checkReduction() {
        let nb1 = parseInt($(".nb1").html());
        let nb2 = parseInt($(".nb2").html());
        var reduit = 0;
        var sum = nb1 + nb2;
        if (sum >= 6) {
            let nbrd = parseInt(sum / 6);//Il est utilisé pour compter le nombre de remises
            let cpt = 0;//compte le nombre de la billet offert
            while (nbrd > 0) {
                if (nb2 > 0) {
                    reduit += 10;//commande contient la billet tarif reduit 
                    cpt++;
                } else {
                    reduit += 5;//commande ne contient que les billet en plein tarif
                }
                nbrd--;
            }
            $(".nb4").html(cpt);
        }
        return reduit;
    }


    function ShowOrHide(x) {
        if (x > 0) {
            $(".nb_reduit").html(x);
            $(".reduction").show(300);
            $(".final_total").show(300);
            $(".prix_final").html(prix_t - x);
        } else {
            $(".reduction").hide(300);
            $(".final_total").hide(300);
        }
    }


    function checkBilleParType() {
        //S'il n'y a pas de commandes dans le panier .commande actuel
        if ($(".commande").length === 0) {
            hashtable.clear();
            $(".nb1").html(0);
            $(".nb2").html(0);
            $(".nb3").html(0);
            $(".nb4").html(0);
        } else {
            var nb1 = 0;
            var nb2 = 0;
            var nb3 = 0;
            var nb4 = 0;
            for (let i = 0; i < $(".commande").length; i++) {
                let key = $(".date").get(i).innerText + $(".name").get(i).innerText + $(".ville").get(i).innerText;
                if (hashtable.containsKey(key)) {
                    nb1 += hashtable.get(key).Plein_tarif;
                    nb2 += hashtable.get(key).Tarif_reduit;
                    nb3 += hashtable.get(key).Enfant_gratuit;
                    nb4 += hashtable.get(key).Billet_offert;
                }
                console.log(nb1 + "," + nb2 + "," + nb3 + "," + nb4);
            }
            $(".nb1").html(nb1);
            $(".nb2").html(nb2);
            $(".nb3").html(nb3);
            $(".nb4").html(nb4);
        }
    }


    function checkTotal() {
        //S'il n'y a pas de commandes dans le panier .commande actuel
        if ($(".commande").length === 0) {
            prix_t = 0;
            $(".total").html(prix_t);
        } else {
            //sinon
            var somme = 0;
            for (var i = 0; i < $(".commande").length; i++) {
                let x = $(".prix").get(i).innerText;
                somme = somme + parseInt(x);
            }
            if (somme != prix_t) {
                prix_t = somme;
                $(".total").html(prix_t);
            }

        }
    }

    function checkQuelleBilletOffert() {
        let nb4 = parseInt($(".nb4").html());//Combien de billets faut-il envoyer? Il y a des billets à envoyer, il doit y avoir des billets reduit
        let nb1 = parseInt($(".nb1").html());//Combien de billets complets existe-t-il
        if (nb4 > 0) {//Si vous avez déjà la billet gratuite
            let nb2 = 0;
            let key = "";
            while (nb4 > 0) {
                for (let i = 0; i < $(".commande").length; i++) {
                    key = $(".date").get(i).innerText + $(".name").get(i).innerText + $(".ville").get(i).innerText;
                    if (hashtable.containsKey(key)) {
                        nb2 = hashtable.get(key).Tarif_reduit;
                        if (nb2 > 0) {//Il y a un ticket reduit pour cette pièce, et nous devons réenregistrer ce ticket quand nous le trouvons
                            break;
                        }
                    }
                }
                //trouve une cle
                let nb1_p = hashtable.get(key).Plein_tarif;
                let nb2_r = hashtable.get(key).Tarif_reduit - 1;
                let nb3_e = hashtable.get(key).Enfant_gratuit;
                let nb4_O = parseInt(hashtable.get(key).Billet_offert) + 1;

                hashtable.remove(key);//ajouter apres supprimer element original
                hashtable.add(key, {"Plein_tarif": nb1_p, "Tarif_reduit": nb2_r, "Enfant_gratuit": nb3_e, "Billet_offert": nb4_O});
                nb4--;
            }
        } else {/*Pas de billet gratuit*/
            var nb1_xp = 0;
            if (nb1 >= 6) {// Mais il y a plus de six billets complets, ce qui signifie que le prix des billets complets doit être transformé en demi-billets
                let res = parseInt(nb1 / 6);//le nombre de reduit
                while (res > 0) {
                    //trouve une cle satisfait
                    for (let i = $(".commande").length - 1; i >= 0; i--) {
                        key = $(".date").get(i).innerText + $(".name").get(i).innerText + $(".ville").get(i).innerText;
                        if (hashtable.containsKey(key)) {
                            nb1_xp = hashtable.get(key).Plein_tarif;
                            if (nb1_xp > 0) {//Il y a un ticket reduit pour cette pièce, nous devons réenregistrer ce ticket quand nous le trouvons
                                break;
                            }
                        }
                    }
                    let nb1_p = hashtable.get(key).Plein_tarif - 1;
                    let nb2_r = hashtable.get(key).Tarif_reduit + 1;
                    let nb3_e = hashtable.get(key).Enfant_gratuit;
                    let nb4_O = parseInt(hashtable.get(key).Billet_offert);

                    hashtable.remove(key);//ajoute apres supprime l'element original
                    hashtable.add(key, {"Plein_tarif": nb1_p, "Tarif_reduit": nb2_r, "Enfant_gratuit": nb3_e, "Billet_offert": nb4_O});
                    res--;
                }
            }
        }
    }

    //vider la liste des spectacles
    $('.vider_liste').click(function () {
        if ($(".item_spectacles").length !== 0) {
            $.confirm({
                title: 'confirmation!',
                content: 'Vous êtes sur à Vider la contenu de la liste?',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            url: "./EmptyRecord.php",
                            type: 'POST',
                            async: false,
                            data: {
                                ViderListe: "TRUE"
                            },
                            success: function (data) {

                                if (window.opener !== null) {
                                    //window.opener 
                                    window.opener.location.reload();
                                }
                                window.location.reload(); //page courant
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
        if ($(".commande").length > 0) {//si la table ou le panier n'est pas vide
            $.confirm({
                title: 'confirmation!',
                content: 'Etes vous sur pour annuler toutes les commandes?',
                buttons: {
                    confirm: function () {
                        $(".commande").remove();
                        prix_t = 0;
                        $(".total").html(prix_t);
                        hashtable.clear();
                        checkBilleParType();
                        var reduit = checkReduction();
                        ShowOrHide(reduit);
                        $(".nb4").html(0);
                    },
                    cancel: function () {
                        $.alert("operation annulée");
                    }
                }
            });
        }
    });

    function ReformerDate(date) {
        var res = "";
        var arr_date = [];
        arr_date['01'] = "janvier";
        arr_date['02'] = "feverier";
        arr_date['03'] = "mars";
        arr_date['04'] = "avril";
        arr_date['05'] = "mai";
        arr_date['06'] = "juin";
        arr_date['07'] = "juille";
        arr_date['08'] = "août";
        arr_date['09'] = "septembre";
        arr_date['10'] = "octobre";
        arr_date['11'] = "novembre";
        arr_date['12'] = "décembre";
        let arr = date.split("/");
        let mois = arr[0]; //
        var mois_fr = arr_date[mois];
        res = arr[1] + " " + mois_fr + " " + arr[2];
        return res;
    }

    /* Étapes: 1. Créez d'abord un tableau json (remplissez chaque ligne d'enregistrements, ici en mode json)
     2. Parcourez les enregistrements de chaque ligne: puis récupérez ses informations dans la table de hachage: 
     c'est-à-dire qu'il y a quelques tickets complets, quelques reduits, quelques tickets enfants, 
     si les tickets ont été envoyés et les deux types d'argent sont affichés.
     La table de hachage est uniquement responsable de l'enregistrement des informations: quelques tickets complets, 
     quelques reduit, quelques tickets enfants et le nombre de tickets envoyés*/
    $(".payer").on("click", function () {

        if ($(".commande").length > 0) {//si le panier ou la table n'est pas vide
            $.confirm({
                title: 'confirmation!',
                content: 'Etes vous sûr de valiser vos commandes?',
                buttons: {
                    confirm: function () {//确认订单防止用户因为手误按错而造成的问题
                        checkQuelleBilletOffert();//调用函数找出哪些戏会有免费票方便记录
                        var Data = [];
                        for (let i = 0; i < $(".commande").length; i++) {
                            let sous_data = {};
                            let date = ($(".date").get(i).innerText).toLowerCase();
                            let datearr = date.split(" ");
                            let real_jour = datearr[0];
                            let real_date = "";
                            for (let i = 1; i < datearr.length - 1; i++) {
                                real_date += datearr[i] + " ";
                            }
                            real_date += datearr[datearr.length - 1];
                            let spectacle = $(".name").get(i).innerText;
                            let ville = $(".ville").get(i).innerText;
                            let lieu = $(".Village").get(i).innerText;
                            let heures = $(".heure_e").get(i).innerText;
                            let Troupe = $(".Compagnie").get(i).innerText;
                            let key = date + spectacle + ville;
                            sous_data["date"] = real_jour + " " + ReformerDate(real_date);
                            sous_data["name"] = spectacle;
                            sous_data["ville"] = ville;
                            sous_data["lieu"] = lieu;
                            sous_data["heure"] = heures;
                            sous_data["Compagnie"] = Troupe;
                            sous_data["Plein_tarif"] = hashtable.get(key).Plein_tarif;
                            sous_data["Tarif_reduit"] = hashtable.get(key).Tarif_reduit;
                            sous_data["Enfant_gratuit"] = hashtable.get(key).Enfant_gratuit;
                            sous_data["Billet_offert"] = hashtable.get(key).Billet_offert;
                            Data.push(sous_data);
                        }
                        $.ajax({
                            url: "./ReadCsv.php",
                            type: 'POST',
                            async: false,
                            data: {
                                Datascsv: Data
                            },
                            success: function (data) {
                                console.log(data);
                                if (window.opener !== null) {
                                    //window.opener
                                    window.opener.location.reload();
                                }
                                window.location.href = "./CommandeValider.html";
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
});

/*test*/