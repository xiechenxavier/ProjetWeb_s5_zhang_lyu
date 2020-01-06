var csvData;


//Obtenir Fichier Csv
$.ajax({
    url: "./FirstPart/ResultatsFestival.csv",
    dataType: "text",
    contentType: "application/json; charset=UTF-8",
    async: false,
    success: function (data) {
                    //csvData = csvJSON(data);  
                    csvData = $.csv.toObjects(data);
                }

            });

var data = arrLieu(csvData);
console.log(csvData);
console.log(data);

//Créer tableau Lieu
function arrLieu(csvData) {
    var flag = 0;
    var data = [];

    for (var i = 0; i < csvData.length; i++) {

        for (var j = 0; j < data.length; j++) {

            IdentifierNaN(csvData, i);

            if (data[j].Lieu === csvData[i].Lieu) {

                flag = 1;
                data[j].P = parseInt(data[j].P) + parseInt(csvData[i].P);
                data[j].R = parseInt(data[j].R) + parseInt(csvData[i].R);
                data[j].SA = parseInt(data[j].SA) + parseInt(csvData[i].SA);
                data[j].SJ = parseInt(data[j].SJ) + parseInt(csvData[i].SJ);
                break;
            }
        }

        if (flag == 0) {

            var json = {Lieu: csvData[i].Lieu, O: parseInt(csvData[i].O), P: parseInt(csvData[i].P), R: parseInt(csvData[i].R), SA: parseInt(csvData[i].SA), SJ: parseInt(csvData[i].SJ)};

            data.push(json);

        } else {
            flag = 0;
        }
    }
    return data;
}


//Créer tableau Spectacle
function arrSpectacle(csvData) {
    var flag = 0;
    var data = [];

    for (var i = 0; i < csvData.length; i++) {

        for (var j = 0; j < data.length; j++) {

            IdentifierNaN(csvData, i);

            if (data[j].Spectacle === csvData[i].TitreSpectacle) {

                flag = 1;
                data[j].P = parseInt(data[j].P) + parseInt(csvData[i].P);
                data[j].R = parseInt(data[j].R) + parseInt(csvData[i].R);
                data[j].SA = parseInt(data[j].SA) + parseInt(csvData[i].SA);
                data[j].SJ = parseInt(data[j].SJ) + parseInt(csvData[i].SJ);
                break;
            }
        }

        if (flag == 0) {

            var json = {Spectacle: csvData[i].TitreSpectacle, O: parseInt(csvData[i].O), P: parseInt(csvData[i].P), R: parseInt(csvData[i].R), SA: parseInt(csvData[i].SA), SJ: parseInt(csvData[i].SJ)};

            data.push(json);

        } else {
            flag = 0;
        }
    }
    return data;
}


//Créer tableau Compagnie
function arrCompagnie(csvData) {
    var flag = 0;
    var data = [];

    for (var i = 0; i < csvData.length; i++) {

        for (var j = 0; j < data.length; j++) {

            IdentifierNaN(csvData, i);

            if (data[j].Compagnie === csvData[i].Compagnie) {

                flag = 1;
                data[j].P = parseInt(data[j].P) + parseInt(csvData[i].P);
                data[j].R = parseInt(data[j].R) + parseInt(csvData[i].R);
                data[j].SA = parseInt(data[j].SA) + parseInt(csvData[i].SA);
                data[j].SJ = parseInt(data[j].SJ) + parseInt(csvData[i].SJ);
                break;
            }
        }

        if (flag == 0) {

            var json = {Compagnie: csvData[i].Compagnie, O: parseInt(csvData[i].O), P: parseInt(csvData[i].P), R: parseInt(csvData[i].R), SA: parseInt(csvData[i].SA), SJ: parseInt(csvData[i].SJ)};

            data.push(json);

        } else {
            flag = 0;
        }
    }
    return data;
}


function IdentifierNaN(dataArr, i) {
    if (dataArr[i].E == "") {
        csvData[i].E = 0;
    }
    if (dataArr[i].O == "") {
        csvData[i].O = 0;
    }
    if (dataArr[i].P == "") {
        csvData[i].P = 0;
    }
    if (dataArr[i].R == "") {
        csvData[i].R = 0;
    }
    if (dataArr[i].SA == "") {
        csvData[i].SA = 0;
    }
    if (dataArr[i].SJ == "") {
        csvData[i].SJ = 0;
    }
}



function goBarChart(dataArr,mode){
            // déclarer les valeur
            var canvas,ctx;
            // information de chart
            var cWidth, cHeight, cMargin, cSpace;
            var originX, originY;
            // information de rect
            var bMargin, tobalBars, bWidth, maxValue;
            var totalYNomber;
            var gradient;
            // information d'animation
            var ctr, numctr, speed;
            //information de souris
            var mousePosition = {};
            // get canvas
            canvas = document.getElementById("barChart");
            if(canvas && canvas.getContext){
                ctx = canvas.getContext("2d");
            }

            initChart(); // initialisation
            drawLineLabelMarkers(); // draw
            drawBarAnimate(); // animation

            

            //Identifier la mouvement
            var mouseTimer = null;
            canvas.addEventListener("mousemove",function(e){
                e = e || window.event;
                if( e.offsetX || e.offsetX==0 ){
                    mousePosition.x = e.offsetX;
                    mousePosition.y = e.offsetY;
                }else if( e.layerX || e.layerX==0 ){
                    mousePosition.x = e.layerX;
                    mousePosition.y = e.layerY;
                }
                
                clearTimeout(mouseTimer);
                mouseTimer = setTimeout(function(){
                    ctx.clearRect(0,0,canvas.width, canvas.height);
                    drawLineLabelMarkers();
                    drawBarAnimate(true);
                },10);
            });

            //mise a jour
            canvas.onclick = function(){

                var mode1 = dataArr[0].Lieu;
                var mode2 = dataArr[0].Compagnie;
                var mode3 = dataArr[0].Spectacle;

                $.ajax({
                url: "./FirstPart/ResultatsFestival.csv",
                dataType: "text",
                contentType: "application/json; charset=UTF-8",
                async: false,
                success: function (data) {
                    //csvData = csvJSON(data);  
                    csvData = $.csv.toObjects(data);
                }

            });


                //console.log(dataArr[0].Lieu);


                $("#barChart").remove();  
                var txt=  $('<canvas id="barChart"> Votre navigateur ne prend pas en charge Canvas </canvas>');
                $(".canvas").append(txt);

                if (mode1) {
                                          
                    data = arrLieu(csvData);
                    goBarChart(data, "Lieu");
                } else if (mode2) {
                                         
                    data = arrCompagnie(csvData);
                    goBarChart(data, "Compagnie");
                } else {
                                         
                    data = arrSpectacle(csvData);
                    goBarChart(data, "Spectacle");
            }

                
            };

            // initialisation
            function initChart(){
                // information de chart
                cMargin = 60;
                cSpace = 80;
               
                    canvas.width = canvas.parentNode.getAttribute("width")* 2 ;
                    canvas.height = canvas.parentNode.getAttribute("height")* 2;
                    canvas.style.height = canvas.height/2 + "px";
                    canvas.style.width = canvas.width/2 + "px";
                    cHeight = canvas.height - cMargin - cSpace;
                    cWidth = canvas.width - cMargin - cSpace;
                    originX = cMargin + cSpace;
                    originY = cMargin + cHeight;
                // information de rect
                bMargin = canvas.width/40;
                tobalBars = dataArr.length;
                bWidth = parseInt( cWidth/tobalBars - bMargin );

                maxValue = 0;

                for (var i = 0; i < dataArr.length; i++) {

                    var barVal = getMaxVal(dataArr, i);
                    if (barVal > maxValue) {
                        maxValue = barVal;
                    }

                }
                
                maxValue += 200;
                totalYNomber = 20;
                // 运动相关
                ctr = 1;
                numctr = 100;
                speed = 10;
                //柱状图渐变色
                //柱状图渐变色
                gradient1 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient1.addColorStop(0, '#7BC0F7');

                gradient2 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient2.addColorStop(0, '#3B8AD9');

                gradient3 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient3.addColorStop(0, '#F18226');

                gradient4 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient4.addColorStop(0, '#FEDA68');

                gradient5 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient5.addColorStop(0, '#61737B');
            }

            //obtenir une valeur maximum à définir la hauteur de Y
            function getMaxVal(dataArr, i) {

                var barValR = parseInt(dataArr[i].R);
                //var barValO = parseInt(dataArr[i].O);
                var barValP = parseInt(dataArr[i].P);
                var barValSA = parseInt(dataArr[i].SA);
                var barValSJ = parseInt(dataArr[i].SJ);

                return (barValSA*12.5)+ (barValSJ*9 )+ (barValP*15*0.1) + (barValR*10*0.1);
            }
            // Draw ligne
            function drawLineLabelMarkers(){

                ctx.font = "24px Arial";
                ctx.lineWidth = 2;
                ctx.fillStyle = "#000";
                ctx.strokeStyle = "#000";
                // y
                drawLine(originX, originY, originX, cMargin);
                // x
                drawLine(originX, originY, originX+cWidth, originY);
                // Maruque
                drawMarkers();
                //ctx.translate(-0.5,-0.5);  // 还原位置
            }
            // Ligne
            function drawLine(x, y, X, Y){
                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.lineTo(X, Y);
                ctx.stroke();
                ctx.closePath();
            }
            // Marque
            function drawMarkers(){
                ctx.strokeStyle = "#E0E0E0";
                //  y
                var oneVal = parseInt(maxValue/totalYNomber);
                ctx.textAlign = "right";
                for(var i=0; i<=totalYNomber; i++){
                    var markerVal =  i*oneVal;
                    var xMarker = originX-10;
                    var yMarker = parseInt( cHeight*(1-markerVal/maxValue) ) + cMargin;
                    
                    ctx.fillText(markerVal, xMarker, yMarker+3, cSpace); // 文字
                    if(i>0){
                        drawLine(originX+2, yMarker, originX+cWidth, yMarker);
                    }
                }
                // x
                ctx.textAlign = "center";
                for(var i=0; i<tobalBars; i++){
                    if (mode == "Lieu") {
                        var markerVal = dataArr[i].Lieu;
                    } else if (mode == "Compagnie") {
                        var markerVal = dataArr[i].Compagnie;
                    } else {
                        var markerVal = dataArr[i].Spectacle;
                    }
                    var xMarker = parseInt( originX+cWidth*(i/tobalBars)+bMargin+bWidth/2 );
                    var yMarker = originY+30;
                    
                    if (mode == "Spectacle") {
                            ctx.fillText(LimitNumber(markerVal), xMarker, yMarker, cSpace +100);
                        } else {
                            ctx.fillText(markerVal, xMarker, yMarker, cSpace +100);
                        } 

                    

                }
                // Titre y
                ctx.save();
                ctx.rotate(-Math.PI/2);
                ctx.fillText("T o t a l", -canvas.height / 2, cSpace - 10);
                ctx.restore();
                
                // Titre x avec différence type
                if (mode == "Lieu") {

                    ctx.fillText("Lieu", originX + cWidth / 2, originY + cSpace / 2 + 10);
                } else if (mode == "Spectacle") {

                    ctx.fillText("Spectacle", originX + cWidth / 2, originY + cSpace / 2 + 10);
                } else {

                    ctx.fillText("Compagnie", originX + cWidth / 2, originY + cSpace / 2 + 10);
                }
            };


            function LimitNumber(txt, length) {
                    var str = txt;
                    str = str.substr(0, 8) + '...';
                    return str;
                }




            //绘制柱形图
            function drawBarAnimate(mouseMove){


                for(var i=0; i<tobalBars; i++){
                     //Définir la valeur
                     var barValR = dataArr[i].R;
                     var coefR = 10*0.1;
                     //var barValO = dataArr[i].O;
                     var barValP = dataArr[i].P;
                     var coefP = 15*0.1;
                     var barValSA = dataArr[i].SA;
                     var coefSA = 12.5;
                     var barValSJ = dataArr[i].SJ;
                     var coefSJ = 9;
                    
                     var finalR = barValR *coefR;
                     var finalP = barValP *coefP;
                     var finalSA = barValSA *coefSA;
                     var finalSJ = barValSJ *coefSJ;

                        //Hauteur de Y
                        var barHR = parseInt(cHeight * finalR / maxValue * ctr / numctr);
                        var barHP = parseInt(cHeight * finalP / maxValue * ctr / numctr);
                        var barHSA = parseInt(cHeight * finalSA / maxValue * ctr / numctr);
                        var barHSJ = parseInt(cHeight * finalSJ / maxValue * ctr / numctr);

                        var y = originY - barHR;
                        var x = originX + (bWidth + bMargin) * i + bMargin;


                        drawRect(x, y, bWidth, barHR - 1, mouseMove,gradient1,barValR,10,"Tarif réduit");  
                        y = y - barHSA;
                        drawRect(x, y, bWidth, barHSA, mouseMove,gradient2,barValSA,12.5,"Speciaux Adulte");
                        y = y - barHSJ;
                        drawRect(x, y, bWidth, barHSJ , mouseMove,gradient3,barValSJ,9,"Speciaux Jeunes");
                        y = y - barHP;
                        drawRect(x, y, bWidth, barHP , mouseMove,gradient4,barValP,15,"Tarif Plein");

                    }
                    if(ctr<numctr){
                        ctr++;
                        setTimeout(function(){
                            ctx.clearRect(0,0,canvas.width, canvas.height);
                            drawLineLabelMarkers();
                            drawBarAnimate();
                        }, speed);
                    }
                }


            var Tooltip = {};

            Tooltip.show = function(msg,obj,mousePosition){
                $('#'+obj).after('<div class="tooltip" id="tooltip">'
                +'<div class="tooltip_top" id="top"></div>'
                +'<div class="tooltip_main" id="main">'+msg+'</div>'
                +'<div class="tooltip_bottom" id="bottom"></div>'
                +'</div>');
               
                var objOffset = $('#'+obj).offset();
                objOffset.left = 600;
                objOffset.top  = 700;
                $('#tooltip').offset(objOffset);
                //setTimeout(function(){$("#tooltip").remove()}, 1300);
                $('#tooltip').click(function(){
                $(this).remove();
                
            });

                    
            }

            //Draw Rect
            function drawRect( x, y, X, Y, mouseMove,color ,quantite,prix,type){
                ctx.beginPath();
                ctx.rect( x, y, X, Y );
                
                if(ctx.isPointInPath(mousePosition.x*2, mousePosition.y*2)){ //Si le souris est au dessus de rect
                    
                    if($("#tooltip")[0]){
                        $("#tooltip").remove();
                        Tooltip.show("Type:"+type+" Quantite:"+quantite+" Prix:"+prix+" Total:"+quantite*prix,'select',mousePosition);
                    } else {
                        Tooltip.show("Type:"+type+" Quantite:"+quantite+" Prix:"+prix+" Total:"+quantite*prix,'select',mousePosition);
                    }                
                    
                   // console.log(quantite);
                }else{   
                    
                }
                
                ctx.fillStyle = color;
                ctx.strokeStyle = color;
                ctx.fill();
                ctx.closePath();
            }
        }



        function loadChart() {

            goBarChart(data, "Lieu");
        }

        window.onload = loadChart;

                