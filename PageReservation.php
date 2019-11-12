<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!DOCTYPE html>
<html>
<head>
	<title>
		PageRéservation
	</title>
	<!-- 
	<script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> 
-->

<link rel="stylesheet" type="text/css" href="./CSS/PageReservation.css" />
</head>

<body>

	<div id="divinput">
            <table>
                <tr><td>Nom:</td>
                    <td><input type="text" id="nom" name="nom" style="width:200px;"></td>
                </tr>
                <tr><td>Adresse Mail:</td>
                    <td><input type="text" id="nom" name="nom" style="width:200px;"></td>
                </tr>
            </table>
	</div>

	<div id="divselect">
		
		<label class="dselect">Nombre:<select id="nombre" name="nombre" >
			<option value="0" disabled="disabled" selected="true">Select Nombre</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select></label>

		<label class="dselect">Type:<select id="type" name="type" >
			<option value="0" disabled="disabled" selected="true">Select Type</option>
			<option value="1">Plein tarif</option>
			<option value="2">Tarif réduit</option>
			<option value="3">Enfent graduit</option>
		</select></label>

		<label class="dselect">Prix:X</label>

		<script type="text/javascript">
			var  obj=document.getElementById( 'nombre' );
			var  index=obj.selectedIndex; 
			var  val = obj.options[index].value;
			console.log(val);


		</script>

		<button class='ajouter'>Ajouter</button>

	</div>

	<div id="divtableau">

		<table bgcolor="black" cellpadding="5" border="0">
			<tr>
				　<td bgcolor="red">紅色的表格欄位背景顏色</td>
				　<td bgcolor="yellow">黃色的表格欄位背景顏色</td>
				　<td bgcolor="blue">藍色的表格欄位背景顏色</td>
			</tr>
		</table>

		<div id ="tp">

			<label class="total">total:X</label>

			<button class='payer'>Payer</button>
		</div>

	</div>



</body>
</html>