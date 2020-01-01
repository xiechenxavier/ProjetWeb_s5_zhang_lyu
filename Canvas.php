
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Finances du festival</title>
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.3/jquery.csv.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/style.css" />
    <link rel="stylesheet" type="text/css" href="CSS/style2.css" />

    <style>

    </style>
</head>
<body>


    <div class="bandeau">
        <h1> Finances du festival</h1>
    </div><!--bandeau-->



    <div class="canvas">


        <canvas id="barChart" height="600" width="1200" style="margin:50px"> Votre navigateur ne prend pas en charge Canvas </canvas>

    </div>

    <div class="select">
        <form id="select" action="" method="get" autocomplete="off">
            Choisir le type:
            <br>
            <label>
                <input type="radio" name="type" value="1" checked>Lieu</label>
                <label>
                    <input type="radio" name="type" value="2">Compagnie</label>
                    <label>
                        <input type="radio" name="type" value="3">Spectacle</label>

                    </form>
                </div>

                <div class="menu">
                    <ul class="navbar">
                        Le site&#8239;:
                        <div id="vignette">                     
                            <a href="index.php">
                                <img class="vignette"
                                src="./images/logo.jpg"
                                alt="[logo de l'association vers l'accueil du site]"
                                width=30%
                                height=30%
                                decoding=low
                                >
                            </a>
                        </div>  <!-- div vignette-->
                        <li><a href="./Accueil.php">Accueil</a></li>
                        <li><a href="./FirstPart/LieuParLieu.php">Lieu par Lieu</a></li>
                        <li><a href="./FirstPart/JourParJour.php">Jour par Jour</a></li>
                        <li><a href="./FirstPart/TroupeParTroupe.php">Jour par Jour</a></li>
                        <li><a href="./Reservation.php">Reserver les billes</li>
                            <!--<li><a href="Festival2018ProgrammationVueGlobale.php">Planning</a> </li>-->       
                        </ul>
                        <div id="vignette">
                            <a href="./FirstPart/LieuParLieu.php#Manoir_de_noix">      
                                <img    class="vignette"
                                src="./images/manoir_des_noix_a_veauce.jpeg "
                                alt="[ Pigeonnier du manoir des noix et de l'église de Veauce vue du ciel           ]"      
                                width=30%
                                height=30%

                                >
                            </a>
                            <a href="./FirstPart/LieuParLieu.php#a_Eglise_z">
                                <img    class="vignette"
                                src="./images/Eglise_Sainte_Croix_de_Veauce.jpg"
                                alt="[ Eglise de Veauce      ]"
                                width=30%
                                height=30%>
                            </a>
                            <a href="./FirstPart/LieuParLieu.php#a_Château_de_Lachaise_z">
                                <img    class="vignette"
                                src="./images/monetay_la_chaise.jpg"
                                alt="[ Photo du château de Lachaise      ]"
                                width=30%
                                height=30%>
                            </a>
                            <a href="./FirstPart/LieuParLieu.php#a_Château_d'Idogne_z">      
                                <img    class="vignette"
                                src="./images/Château_d'Idogne.jpg"
                                alt="[ Photo du château d'Idogne     ]"
                                width=30%
                                height=30%

                                >
                            </a>
                            <a href="./FirstPart/LieuParLieu.php#Domaine_de_la_Querye">      
                                <img    class="vignette"
                                src="./images/Domaine_de_la_Quérye.png"
                                alt="[ Photo du domaine de la Querye     ]"
                                width=30%
                                height=30%

                                >
                            </a>                    
                        </div><!--Vignette-->

                    </div><!-- class="menu"-->
    <!--                <button class="btn_hide">
                        cacher navigateur
                    </button>-->
                    <div class="btn_hide">
                        <img  src="./images/flaish2.png">
                    </div>

                    <div class="btn_show">
                        <img  src="./images/flaish_r2_c2.png">
                    </div>
                    <div class='theatre'>

                    </div>
                    <div class="spect_Ajoute" style="display: none">

                    </div>


                    <script>



                        var csvData;


        //Obtenir Fichier Csv
        $.ajax({
            url: "ResultatsFestival.csv",
            dataType: "text",
            contentType: "application/json; charset=UTF-8",
            async:false,
            success: function (data) {
                //csvData = csvJSON(data);  
                csvData = $.csv.toObjects(data);

            }

        });

        var data = arrLieu(csvData);
        console.log(csvData);
        console.log(data);

        //创建数组Lieu
        function arrLieu(csvData){
            var flag = 0;
            var data = [];
            
            for (var i = 0; i < csvData.length; i++) {

                for (var j = 0; j < data.length; j++) {

                    IdentifierNaN(csvData,i);

                    if (data[j].Lieu === csvData[i].Lieu) {

                        flag = 1;
                        data[j].O = parseInt(data[j].O) + parseInt(csvData[i].O);
                        data[j].P = parseInt(data[j].P) + parseInt(csvData[i].P);
                        data[j].R = parseInt(data[j].R) + parseInt(csvData[i].R) ;
                        data[j].SA = parseInt(data[j].SA) + parseInt(csvData[i].SA) ;
                        data[j].SJ = parseInt(data[j].SJ) + parseInt(csvData[i].SJ) ;
                        break;
                    }
                }
                
                if (flag == 0) {

                    var json = {Lieu:csvData[i].Lieu,O:parseInt(csvData[i].O), P:parseInt(csvData[i].P),R:parseInt(csvData[i].R),SA:parseInt(csvData[i].SA),SJ:parseInt(csvData[i].SJ)};
                    
                    data.push(json);

                }else{
                    flag = 0;
                }
            }
            return data;
        }


        //创建数组Spectacle
        function arrSpectacle(csvData){
            var flag = 0;
            var data = [];
            
            for (var i = 0; i < csvData.length; i++) {

                for (var j = 0; j < data.length; j++) {

                    IdentifierNaN(csvData,i);

                    if (data[j].Spectacle === csvData[i].TitreSpectacle) {

                        flag = 1;
                        data[j].O = parseInt(data[j].O) + parseInt(csvData[i].O);
                        data[j].P = parseInt(data[j].P) + parseInt(csvData[i].P);
                        data[j].R = parseInt(data[j].R) + parseInt(csvData[i].R) ;
                        data[j].SA = parseInt(data[j].SA) + parseInt(csvData[i].SA) ;
                        data[j].SJ = parseInt(data[j].SJ) + parseInt(csvData[i].SJ) ;
                        break;
                    }
                }
                
                if (flag == 0) {

                    var json = {Spectacle:csvData[i].TitreSpectacle,O:parseInt(csvData[i].O), P:parseInt(csvData[i].P),R:parseInt(csvData[i].R),SA:parseInt(csvData[i].SA),SJ:parseInt(csvData[i].SJ)};
                    
                    data.push(json);

                }else{
                    flag = 0;
                }
            }
            return data;
        }


        //创建数组Compagnie
        function arrCompagnie(csvData){
            var flag = 0;
            var data = [];
            
            for (var i = 0; i < csvData.length; i++) {

                for (var j = 0; j < data.length; j++) {

                    IdentifierNaN(csvData,i);

                    if (data[j].Compagnie === csvData[i].Compagnie) {

                        flag = 1;
                        data[j].O = parseInt(data[j].O) + parseInt(csvData[i].O);
                        data[j].P = parseInt(data[j].P) + parseInt(csvData[i].P);
                        data[j].R = parseInt(data[j].R) + parseInt(csvData[i].R) ;
                        data[j].SA = parseInt(data[j].SA) + parseInt(csvData[i].SA) ;
                        data[j].SJ = parseInt(data[j].SJ) + parseInt(csvData[i].SJ) ;
                        break;
                    }
                }
                
                if (flag == 0) {

                    var json = {Compagnie:csvData[i].Compagnie,O:parseInt(csvData[i].O), P:parseInt(csvData[i].P),R:parseInt(csvData[i].R),SA:parseInt(csvData[i].SA),SJ:parseInt(csvData[i].SJ)};
                    
                    data.push(json);

                }else{
                    flag = 0;
                }
            }
            return data;
        }


        function IdentifierNaN(dataArr,i) {
            if (dataArr[i].E =="") {
                csvData[i].E = 0;
            }
            if (dataArr[i].O =="") {
                csvData[i].O = 0;
            }
            if (dataArr[i].P =="") {
                csvData[i].P = 0;
            }
            if (dataArr[i].R =="") {
                csvData[i].R = 0;
            }
            if (dataArr[i].SA =="") {
                csvData[i].SA = 0;
            }
            if (dataArr[i].SJ =="") {
                csvData[i].SJ = 0;
            }
        }
        




        function goBarChart(dataArr,mode){
            // 声明所需变量
            var canvas,ctx;
            // 图表属性
            var cWidth, cHeight, cMargin, cSpace;
            var originX, originY;
            // 柱状图属性
            var bMargin, tobalBars, bWidth, maxValue;
            var totalYNomber;
            var gradient;

            // 运动相关变量
            var ctr, numctr, speed;
            //鼠标移动
            var mousePosition = {};

            

            // 获得canvas上下文
            canvas = document.getElementById("barChart");
            if(canvas && canvas.getContext){
                ctx = canvas.getContext("2d");
            }

            initChart(); // 图表初始化
            drawLineLabelMarkers(); // 绘制图表轴、标签和标记
            drawBarAnimate(); // 绘制柱状图的动画


            
            //点击刷新图表
            /*
            canvas.onclick = function(){
                initChart(); // 图表初始化
                drawLineLabelMarkers(); // 绘制图表轴、标签和标记
                drawBarAnimate(); // 绘制折线图的动画
            };
            */

            // 图表初始化
            function initChart(){
                // 图表信息
                cMargin = 30;
                cSpace = 60;
                cHeight = canvas.height - cMargin*2 - cSpace;
                cWidth = canvas.width - cMargin*2 - cSpace;
                originX = cMargin + cSpace;
                originY = cMargin + cHeight;

                // 柱状图信息
                bMargin = 15;
                tobalBars = dataArr.length;
                bWidth = parseInt( cWidth/tobalBars - bMargin );
                maxValue = 0;

                for(var i=0; i<dataArr.length; i++){

                    var barVal = getMaxVal(dataArr,i);
                    if( barVal > maxValue ){
                        maxValue = barVal;
                    }

                }
                
                maxValue += 200;

                totalYNomber = 30;
                // 运动相关
                ctr = 1;
                numctr = 100;
                speed = 10;

                //柱状图渐变色
                gradient1 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient1.addColorStop(0, 'green');
                gradient1.addColorStop(1, 'rgba(67,203,36,1)');

                gradient2 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient2.addColorStop(0, 'yellow');

                gradient3 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient3.addColorStop(0, 'orange');

                gradient4 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient4.addColorStop(0, 'red');

                gradient5 = ctx.createLinearGradient(0, 0, 0, 300);
                gradient5.addColorStop(0, 'purple');


                

            }

            // 绘制图表轴、标签和标记
            function drawLineLabelMarkers(){
                ctx.translate(0.5,0.5);  // 当只绘制1像素的线的时候，坐标点需要偏移，这样才能画出1像素实线
                ctx.font = "12px Arial";
                ctx.lineWidth = 1;
                ctx.fillStyle = "#000";
                ctx.strokeStyle = "#000";
                // y轴
                drawLine(originX, originY, originX, cMargin);
                // x轴
                drawLine(originX, originY, originX+cWidth, originY);

                // 绘制标记
                drawMarkers();
                ctx.translate(-0.5,-0.5);  // 还原位置
            }

            // 画线的方法
            function drawLine(x, y, X, Y){
                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.lineTo(X, Y);
                ctx.stroke();
                ctx.closePath();
            }

            // 绘制标记
            function drawMarkers(){
                ctx.strokeStyle = "#E0E0E0";
                // 绘制 y
                var oneVal = parseInt(maxValue/totalYNomber);
                ctx.textAlign = "right";
                for(var i=0; i<=totalYNomber; i++){
                    var markerVal =  i*oneVal;
                    var xMarker = originX-5;
                    var yMarker = parseInt( cHeight*(1-markerVal/maxValue) ) + cMargin;
                    ctx.fillText(markerVal, xMarker, yMarker+3, cSpace); // 文字
                    if(i>0){
                        drawLine(originX, yMarker, originX+cWidth, yMarker);
                    }
                }
                // 绘制 x
                ctx.textAlign = "center";

                for(var i=0; i<tobalBars; i++){
                    if (mode == "Lieu"){
                        var markerVal = dataArr[i].Lieu;
                    }else if(mode == "Compagnie"){
                        var markerVal = dataArr[i].Compagnie;
                    }else{
                        var markerVal = dataArr[i].Spectacle;
                    }
                    var xMarker = parseInt( originX+cWidth*(i/tobalBars)+bMargin+bWidth/2 );
                    var yMarker = originY+15;
                    if (mode == "Spectacle") {
                    ctx.fillText(LimitNumber(markerVal), xMarker, yMarker, cSpace+200); 
                }else{
                    ctx.fillText(markerVal, xMarker, yMarker, cSpace+200);// 文字 +200以防止文字过于紧凑
                }
                }
                // 绘制标题 y
                ctx.save();
                ctx.rotate(-Math.PI/2);
                ctx.fillText("Q u a n t i t é", - canvas.height/2, cSpace-10);
                ctx.restore();

                // 绘制标题 x 判断类型以显示不同标题
                if (mode == "Lieu") {

                    ctx.fillText("Lieu", originX+cWidth/2, originY+cSpace/2+10);
                }else if(mode == "Spectacle"){

                    ctx.fillText("Spectacle", originX+cWidth/2, originY+cSpace/2+10);
                }else{

                    ctx.fillText("Compagnie", originX+cWidth/2, originY+cSpace/2+10);
                }
                
            };

            function LimitNumber(txt,length) {
            var str = txt;
            str = str.substr(0,8) + '...' ;
            return str;
            }


            //一个获取最大值的方法
            function getMaxVal(dataArr,i){

                var barValR = parseInt(dataArr[i].R);
                var barValO = parseInt(dataArr[i].O);
                var barValP = parseInt(dataArr[i].P);
                var barValSA = parseInt(dataArr[i].SA);
                var barValSJ = parseInt(dataArr[i].SJ);

                return barValSA+barValSJ+barValO+barValP+barValR;
            }





            //绘制柱形图
            function drawBarAnimate(){

                for(var i = 0; i < tobalBars; i++){

                    var oneVal = parseInt(maxValue/totalYNomber);

                    //定义每种票的值
                    var barValR = dataArr[i].R;
                    var barValO = dataArr[i].O;
                    var barValP = dataArr[i].P;
                    var barValSA = dataArr[i].SA;
                    var barValSJ = dataArr[i].SJ;


                    //定义每种票的Y值
                    var barHR = parseInt( cHeight*barValR/maxValue * ctr/numctr );
                    var barHO = parseInt( cHeight*barValO/maxValue * ctr/numctr );
                    var barHP = parseInt( cHeight*barValP/maxValue * ctr/numctr );
                    var barHSA = parseInt( cHeight*barValSA/maxValue * ctr/numctr );
                    var barHSJ = parseInt( cHeight*barValSJ/maxValue * ctr/numctr );
                    
                    var y = originY - barHR;
                    var x = originX + (bWidth+bMargin)*i + bMargin;
                    
                    
                        drawRect( x, y, bWidth, barHR, gradient1 );  //高度减一避免盖住x轴
                        y =  y - barHO;
                        drawRect( x, y , bWidth, barHO, gradient2 );
                        y =  y - barHSA;
                        drawRect( x, y , bWidth, barHSA,gradient3 );
                        y =  y - barHSJ;
                        drawRect( x, y , bWidth, barHSJ,gradient4 );
                        y =  y - barHP;
                        drawRect( x, y , bWidth, barHP,gradient5 );


                    //ctx.fillText(barValSA+barValSJ+barValO+barValP+barValR, x + 15, y - 8); // 轴上显示文字 有BUG

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

            //绘制方块
            function drawRect( x, y, X, Y,color){
                ctx.beginPath();
                ctx.rect( x, y, X, Y );
                ctx.fillStyle = color;
                ctx.strokeStyle = color;                   
                ctx.fill();
                ctx.closePath();
            }



            
        }


        


        function loadChart(){
　　 　　 goBarChart(data,"Lieu");
　　  } 　　　　
        window.onload = loadChart;//不要括号

        //选择框单击后
        $('#select input:radio').click(function() {
            if ($(this).val() === '1') {
                data = arrLieu(csvData);
                goBarChart(data,"Lieu");
            } else if ($(this).val() === '2') {
               data = arrCompagnie(csvData);
               goBarChart(data,"Compagnie");
           } else{
            data = arrSpectacle(csvData);
            goBarChart(data,"Spectacle");
        }
    });
        

</script>





</body>
</html>