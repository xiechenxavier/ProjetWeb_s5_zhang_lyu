/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    //get 请求，请求加载数据
    $.get("./ResultatsFestival.csv", function (theData) {
        var data = $.csv.toObjects(theData);
        /*La partie de Jour Par Jour**/
        var Arr = AlgoGetJourArray(data);
        var theHtml = "";
        for (let i = 0; i < Arr.length; i++) {
            theHtml += ChercheParJour(data, Arr[i]) + "<br>";
            var Id = Arr[i].replace(new RegExp(/( )/g), "_");
            $("#dates").append("<option value=#" + Id + ">" + Arr[i] + "</option>");
        }
        $("#theResult").html(theHtml);
        /*la partie de Troupe par Troupe**/
        var Arr2 = AlgoGetCompagnieArray(data);
        var theHtml2 = "";
        for (let i = 0; i < Arr2.length; i++) {
            theHtml2 += ChercheParTroupe(data, Arr2[i]) + "<br>";
            var Id = Arr2[i].replace(new RegExp(/( )/g), "_");
            $("#Troupes").append("<option value=#" + Id + ">" + Arr2[i] + "</option>");
        }
        $("#Programme_Troupes").html(theHtml2);
        /*la partie de Lieu par Lieu*/
        $(".Lieu").each(function(){
            let titre=$(this).children("#title").html();
            $(this).append(ChercheParLieu(data, titre));
        });

    });
    //get all dates 
    function ChercheParJour(data, jour) {
        var html = '';
        //下面的执行的是传说中的replaceAll,但是在JQ中，这个函数并不存在
        var Id = jour.replace(new RegExp(/( )/g), "_");
        html = '<h3 id=' + Id + '>' + jour + '</h3><br>';
        for (let row in data) {
            html += '<p>';
            if (data[row]["jour"] !== jour) {
                continue;
            } else {
                //for (var item in data[row]) {
                html += "<Horaire>" + data[row]["Heure"] + "<Troupe>&nbsp" + data[row]["Compagnie"] + "&nbsp</Troupe>" +
                        "présente<TitreSpectacle>&nbsp" + data[row]["TitreSpectacle"] + "&nbsp</TitreSpectacle>" +
                        "à" + "<Lieu>&nbsp" + data[row]["Lieu"] + "</Lieu>" + "&nbsp dans <Ville>&nbsp" + data[row]["Village"] + "</Ville>";
            }
        }
        html += "</p>";
        return html;
    }
    //getter le tableau de tous les dates des spectacles
    function AlgoGetJourArray(data) {
        var Jours = new Array();
        for (let row in data) {
            Jours.push(data[row]["jour"]);
        }
        return  unique(Jours);
    }
    /*this function is used to eliminate all repeated elements*/
    /*In order for this code to work in all browsers 
     *(including ie7 that doesn't support some array features - such as indexOf or filter), 
     *here's a rewrite using jquery functionalities :
     use $.grep instead of Array.filter
     use $.inArray instead of Array.indexOf*/
    function unique(array) {
        //利用函数式编程的思想，我们需要的是去重的array所以把多余的元素筛出去
        return $.grep(array, function (el, index) {
            //如果是下标是该元素第一次出现的下标我们则留下，不然就筛出去，所以最终得到的结果就是出现了一次的结果
            return index === $.inArray(el, array);
        });
    }
    //getter le tableau de tous les Troupes
    function AlgoGetCompagnieArray(data) {
        var Troupes = new Array();
        for (let row in data) {
            Troupes.push(data[row]["Compagnie"]);
        }
        return   unique(Troupes);
    }
    function ChercheParTroupe(data, Troupe) {
        var html = '';
        //下面的执行的是传说中的replaceAll,但是在JQ中，这个函数并不存在
        var Id = Troupe.replace(new RegExp(/( )/g), "_");
        html = '<h3 id=' + Id + '>' + Troupe + '</h3><br>';
        for (let row in data) {
            html += '<p>';
            if (data[row]["Compagnie"] !== Troupe) {
                continue;
            } else {
                for (var item in data[row]) {
                    switch (item) {
                        case "Jour":
                            html += "<Horaire>" + data[row][item] + "&nbsp";
                            break;
                        case "Heure":
                            html += data[row][item] + " &nbsp </Horaire>";
                            break;
                        case "TitreSpectacle":
                            html += "  <TitreSpectacle>" + data[row][item] + "</TitreSpectacle>&nbsp est présenté à ";
                            break;
                        case "Lieu":
                            html += "<Lieu>" + data[row][item] + "</Lieu>&nbsp&nbsp";
                            break;
                        case "Village":
                            html += "dans <Ville>" + data[row][item] + "</Ville>";
                            break;
                            /*  case "Compagnie":
                             html += "&nbsp par <Troupe>" + data[row][item] + "</Troupe>";
                             break;*/
                        default:
                            continue;
                            break;
                    }
                }
            }
        }
        html += "</p>";
        return html;
    }
    function ChercheParLieu(data, lieu) {
        var html = '';
        for (let row in data) {
            html += '<p>';
            if (data[row]["Lieu"] !== lieu) {
                continue;
            } else {
                //for (var item in data[row]) {
                html += "<Horaire>" +data[row]['jour']+ " à "+data[row]["Heure"] + "<Troupe>&nbsp" + data[row]["Compagnie"] + "&nbsp</Troupe>" +
                        "présente<TitreSpectacle>&nbsp" + data[row]["TitreSpectacle"] + "&nbsp</TitreSpectacle>";
            }
        }
        html += "</p>";
        return html;
    }

    //Top Button
    //返回顶部===>出现与消失
    //当屏幕滚动，触生 scroll 事件
    $(window).scroll(function () {

        var top1 = $(this).scrollTop();     //获取相对滚动条顶部的偏移

        if (top1 > 200) {      //当偏移大于200px时让图标淡入（css设置为隐藏）
            $(".top").fadeIn("slow");
        } else {
            //当偏移小于200px时让图标淡出
            $(".top").fadeOut("slow");
        }
    });
    //去往顶部
    $(".top").click(function () {
        $("body , html").animate({scrollTop: 0}, 300);   //300是所用时间
    });
});
