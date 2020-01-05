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

        this.get = function (key) {
            if (this.containsKey(key))
                return this.items[key];
            else
                return null;
        }

        this.remove = function (key) {
            if (this.containsKey(key)) {
                delete this.items[key];
                this.itemsCount--;
            } else
                throw "key '" + key + "' does not exists."

        }

        this.containsKey = function (key) {
            return typeof (this.items[key]) != "undefined";
        }

        this.containsValue = function containsValue(value) {
            for (var item in this.items) {
                if (this.items[item] == value)
                    return true;
            }

            return false;
        }

        this.contains = function (keyOrValue) {
            return this.containsKey(keyOrValue) || this.containsValue(keyOrValue);
        }

        this.clear = function () {
            this.items = new Array();
            itemsCount = 0;
        }

        this.size = function () {
            return this.itemsCount;
        }

        this.isEmpty = function () {
            return this.size() == 0;
        }
    };
    var prix_t = 0;
    var hashtable = new jQuery.Hashtable(); //用来存每个加入表单的spectacle的信息
    $(".total").append(prix_t);
    $(".item_spectacles").each(function () {
        var curr_item = $(this).children(".item_contenu");
        var Ville_a = $(this).children(".villes").html(); //戏在哪个城市
        var Date_spect1 = $(this).children(".date_spect").html(); //看戏的日期
        curr_item.each(function () {
            var nombre = $(this).children("#nombre");
            var type = $(this).children("#type");
            var spectacle_name = $(this).children(".name_Spectacle").html();
            var Spect_time = $(this).children(".Spect_time").html();
            var arr = Spect_time.split(" ");
            var Date_spect = arr[0] + " " + Date_spect1;
            var Heures = arr[1];
            var Village = $(this).children(".Lieu_village").html(); //看戏的地点在哪个
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
                var nb_pl = 0; //统计有多少plein tarif
                var nb_rd = 0; //多少个tarif reduit
                var nb_Ef = 0; //多少个billet offert
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
                    var flag = false; /*判断新建的订单是否已经加入*/
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
                                flag = true; /*将flag设为真表示这条订单已被添加*/
                                break;
                            }
                        }

                        if (!flag) {  /*如果购物篮内没有重复的,flag仍为false,此处则新加入一个*/
                            let str = "<tr class='commande'><td class = 'name'>" + spectacle_name + "</td>" + "<td class = 'quantite'>" + quantite_billes + "</td>" + "<td class = 'prix'>" + prix + "</td>"
                                    + "<td class='ville'>" + Ville_a + "</td>" + "<td class='Village'>" + Village + "</td>"
                                    + "<td class = 'date'>" + Date_spect + "</td>" + "<td class = 'heure_e'>" + Heures + "</td>" +
                                    "<td align='center'><img id='btn_delete' src='./images/delete.png'/></td></tr>";
                            $(".divtableau>table").append(str);
                            $("#type").find("option[value='1']").attr("selected", true);
                            flag = false;
                            hashtable.add(Date_spect + spectacle_name + Ville_a, {"Plein_tarif": nb_pl, "Tarif_reduit": nb_rd, "Enfant_gratuit": nb_Ef, "Billet_offert": nb_off});
                        } else {/*如果现在的表单里面已经有了，则flag为true并且在对哈希表记录进行更新*/
                            let cur_nb_pl = hashtable.get(Date_spect + spectacle_name + Ville_a).Plein_tarif + nb_pl;
                            let cur_nb_rd = hashtable.get(Date_spect + spectacle_name + Ville_a).Tarif_reduit + nb_rd;
                            let cur_nb_Ef = hashtable.get(Date_spect + spectacle_name + Ville_a).Enfant_gratuit + nb_Ef;
                            let cur_nb_off = hashtable.get(Date_spect + spectacle_name + Ville_a).Billet_offert + nb_off;
                            hashtable.remove(Date_spect + spectacle_name + Ville_a);
                            hashtable.add(Date_spect + spectacle_name + Ville_a, {"Plein_tarif": cur_nb_pl, "Tarif_reduit": cur_nb_rd, "Enfant_gratuit": cur_nb_Ef, "Billet_offert": cur_nb_off});
                        }
                    } else {
                        let str = "<tr class='commande'><td class = 'name'>" + spectacle_name + "</td>" + "<td class = 'quantite'>" + quantite_billes + "</td>" + "<td class = 'prix'>" + prix + "</td>"
                                + "<td class='ville'>" + Ville_a + "</td>" + "<td class='Village'>" + Village + "</td>"
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
            let nbrd = parseInt(sum / 6);//用来计算打折的次数
            let cpt = 0;//一共有多少张减免的票（nombre de la billet offert）
            while (nbrd > 0) {
                if (nb2 > 0) {
                    reduit += 10;//有tarif reduit的时候
                    cpt++;
                } else {
                    reduit += 5;//全部plein tarif
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
        //如果当前.commande篮子里面没有订单
        if ($(".commande").length === 0) {
            hashtable.clear();
            $(".nb1").html(0);
            $(".nb2").html(0);
            $(".nb3").html(0);
            $(".nb4").html(0);
        } else {
            // var size=hashtable.size();
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
        //如果当前.commande篮子里面没有订单
        if ($(".commande").length === 0) {
            prix_t = 0;
            $(".total").html(prix_t);
        } else {
            //有订单的时候
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
        let nb4 = parseInt($(".nb4").html());//目前有多少张要送的票？有要送的票说明肯定有reduit的票存在
        let nb1 = parseInt($(".nb1").html());//一共有多少张满票
        if (nb4 > 0) {//如果已经有了免费的票
            let nb2 = 0;
            let key = "";
            while (nb4 > 0) {
                for (let i = 0; i < $(".commande").length; i++) {
                    key = $(".date").get(i).innerText + $(".name").get(i).innerText + $(".ville").get(i).innerText;
                    if (hashtable.containsKey(key)) {
                        nb2 = hashtable.get(key).Tarif_reduit;
                        if (nb2 > 0) {//这个戏有reduit的票，我们找到后要重新记录这个票
                            break;
                        }
                    }
                }
                //找到一个key
                let nb1_p = hashtable.get(key).Plein_tarif;
                let nb2_r = hashtable.get(key).Tarif_reduit - 1;
                let nb3_e = hashtable.get(key).Enfant_gratuit;
                let nb4_O = parseInt(hashtable.get(key).Billet_offert) + 1;

                hashtable.remove(key);//删除后再重新加入
                hashtable.add(key, {"Plein_tarif": nb1_p, "Tarif_reduit": nb2_r, "Enfant_gratuit": nb3_e, "Billet_offert": nb4_O});
                nb4--;
            }
        } else {//没有免费的票
            var nb1_xp = 0;
            if (nb1 >= 6) {//但是有满票超过六张，这意味着在记录上要把满票的价格变成半票
                let res = parseInt(nb1 / 6);//变几张
                while (res > 0) {
                    //找到一个key
                    for (let i = $(".commande").length - 1; i >= 0; i--) {
                        key = $(".date").get(i).innerText + $(".name").get(i).innerText + $(".ville").get(i).innerText;
                        if (hashtable.containsKey(key)) {
                            nb1_xp = hashtable.get(key).Plein_tarif;
                            if (nb1_xp > 0) {//这个戏有reduit的票，我们找到后要重新记录这个票
                                break;
                            }
                        }
                    }
                    let nb1_p = hashtable.get(key).Plein_tarif - 1;
                    let nb2_r = hashtable.get(key).Tarif_reduit + 1;
                    let nb3_e = hashtable.get(key).Enfant_gratuit;
                    let nb4_O = parseInt(hashtable.get(key).Billet_offert);

                    hashtable.remove(key);//删除后再重新加入
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

    $(".payer").on("click", function () {
        //步骤：1.首先新建一个json数组（装每一行记录，这里的以json方式来盛装）
        //2.遍历每一行的记录：然后获取其在hashtable当中的数据信息：即有几张满票，几张reduit，几张儿童票，是否送了票，倒贴了钱的两种
        //哈希表中只负责记录一下信息：几张满票，几张reduit，几张儿童票，送的票的数量
        if ($(".commande").length > 0) {//表示如果整个表格中里面有元素时
            $.confirm({
                title: 'confirmation!',
                content: 'Etes vous sûr de valiser vos commandes?',
                buttons: {
                    confirm: function () {//确认订单防止用户因为手误按错而造成的问题
                        checkQuelleBilletOffert();//调用函数找出哪些戏会有免费票方便记录
                        console.log(hashtable);
                        var Data = [];
                        for (let i = 0; i < $(".commande").length; i++) {
                            let sous_data = {};
                            let date = ($(".date").get(i).innerText).toLowerCase();
                            let spectacle = $(".name").get(i).innerText;
                            let ville = $(".ville").get(i).innerText;
                            let lieu = $(".Village").get(i).innerText;
                            let heures = $(".heure_e").get(i).innerText;
                            let key = date + spectacle + ville;
                            sous_data["date"] = ReformerDate(date);
                            sous_data["name"] = spectacle;
                            sous_data["ville"] = ville;//在csv里面是village  Veauce是village
                            sous_data["lieu"] = lieu;//csv中指的是lieu
                            sous_data["heure"] = heures;
                            sous_data["Plein_tarif"] = hashtable.get(key).Plein_tarif;
                            sous_data["Tarif_reduit"] = hashtable.get(key).Tarif_reduit;
                            sous_data["Enfant_gratuit"] = hashtable.get(key).Enfant_gratuit;
                            sous_data["Billet_offert"] = hashtable.get(key).Billet_offert;
                            Data.push(sous_data);
                        }
                        //   var jsonString = JSON.stringify(Data); //把一个JSON类型数组转化成一个字符串
                        $.ajax({
                            url: "./ReadCsv.php",
                            type: 'POST',
                            async: false,
                            data: {
                                Datascsv: Data
                            },
                            success: function (data) {
                                console.log(data);
                                window.location.href = "./CommandeValider.html";
                            },
                            error: function () {
                                alert("#");
                            }
                        });
                        //完成上述的操作之后就重新刷新之前页面，以及进入下一个成功通知页面
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