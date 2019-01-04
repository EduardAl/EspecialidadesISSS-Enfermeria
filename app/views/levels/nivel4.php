<?php require RUTA_APP.'\views\inc\header.php'; ?>
<div>
	<div class="col-xs-12" style="background: #050D42;">
		<div class="container">
			<div class="col-xs-10">
				<h1 style="color: white;">Cuarto Nivel</h1>
			</div>
			<div class="col-xs-2" >
				<br><?php
				if((isset($_SESSION['acceso']))&&
					($_SESSION['acceso']==1||$_SESSION['acceso']==2||$_SESSION['acceso']==3))
					echo '
	  			<button class="btn btn-primary btn-block" onclick="window.location=\''. RUTA_URL.'/Mantenimiento/Nivel/4\'">Ingresar Datos</button>';?>

	  		</div>
		</div>
	</div>
	<div id="navbar" class="navbar-collapse collapse" style="background: #18299A;">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a id="ep" class="mouseHover" onclick="Mostrar_Ocultar(1)">Especialidades del Nivel</a></li>
				<li><a id="es" class="mouseHover" onclick="Mostrar_Ocultar(2)">Estadísticas del Nivel</a></li>
			</ul>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row">
		<div id="especialidades" style="min-height: 350px;">
			<div class="col-xs-12">
				<h3>Especialidades del Nivel</h3>
			</div>
			<br> <br> <br>
			<div class="col-xs-4">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h3>Urología</h3>
						<p> </p>
						<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/4/Urologia"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/cardiologia.jpg">
					<div class="caption">
						<h3>Cardiología</h3>
						<p> </p>
						<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/4/Cardiologia"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/otorrinolaringologia.jpg">
					<div class="caption">
						<h3>Otorrinolaringología</h3>
						<p> </p>
						<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/4/Otorrinolaringologia"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>
		</div>
		<div id="graficos" style="min-height: 350px;">
			<div class="col-xs-8">
				<h2><?php if(isset($datos['fechaT']))echo$datos['fechaT'];else echo"Mes Actual";?></h2>
			</div>
			<div class="col-xs-4">
				<ul class="nav navbar-nav navbar-right">
					<li><a class="mouseHover" onclick="find('#datosNivel');">Datos de Nivel</a></li>
					<li><a class="mouseHover" onclick="find('#ausentismo');">Ausentismo</a></li>
					<li><a class="mouseHover" onclick="find('#admin');">Administración</a></li>
				</ul>
			</div>
			<div class="col-xs-12" style="display: inline-block; align-items: center">
				<hr>
			</div>
			<div id="filtro" class="col-xs-12" align="right">
				<form method="post" action="<?php echo RUTA_URL?>/Nivel/level/4">
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Ver por:</label>
					</div>
					<div class="col-xs-2">
						<select name="cbOrdenar" class="form-control" id="dates" >
							<option value="Month">Mes</option>
							<option value="Year">Año</option>
							<option value="Per">Personalizado</option>
						</select>
					</div>
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Desde:</label>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker1'>
						        <input type='text' class="form-control" name="fecha1" id="fecha1" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Hasta:</label>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker2'>
						        <input type='text' class="form-control" name="fecha2" id="fecha2" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-2">
						<button class="btn btn-primary btn-block" type="submit">Actualizar</button>
					</div>
				</form>
			</div>
			<div id="datosNivel" class="col-xs-12" style="align-items: center">
				<hr>
			</div>

			<div id="datosNivel" class="col-xs-12">
				<div>
					<h3>Datos de Nivel</h3>
				</div>
				<div class="col-xs-12" style="overflow: auto; max-height: 800px;">
					<?php $data=$datos; $datos=$data['datos1']; $id=1;
					include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
				<div class="col-xs-12">
					<div class=thumbnail style="align-items: center; overflow: auto; overflow-y: hidden; ">
						<?php include RUTA_APP.'\views\reportes\pieChart.php'; ?>
					</div>
				</div>
			</div>
			<div id="ausentismo" class="col-xs-12" style="display: inline-block; align-items: center">
				<hr>
			</div>
			<div id="ausentismo" class="col-xs-12">
				<div>
					<h3>Ausentismo</h3>
				</div>
				<div class="col-xs-12" style="overflow: auto; max-height: 800px;">
					<?php $datos=$data['datos2']; $id++;
					include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
				<div class="col-xs-12">
					<div class=thumbnail style="align-items: center; overflow: auto; overflow-y: hidden; ">
						<?php include RUTA_APP.'\views\reportes\pieChart.php'; ?>
					</div>
				</div>
			</div>
			<div id="admin" class="col-xs-12" style="display: inline-block; align-items: center">
				<hr>
			</div>
			<div id="admin" class="col-xs-12">
				<div>
					<h3>Administración</h3>
				</div>
				<div class="col-xs-12" style="overflow: auto; max-height: 800px;">
					<?php $datos=$data['datos3']; $id++;
					include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function (){
<?php
		if(isset($data['tiempo']))
		{
			$tempo =$data['tiempo'];
?>
		Mostrar_Ocultar(2,1);
		$("#dates").val("<?php echo $tempo['tipo']?>");
		$("#fecha1").val("<?php echo $tempo['fecha1']?>");
		$("#fecha2").val("<?php echo $tempo['fecha2']?>");
<?php
		}
		else{
?>
		Mostrar_Ocultar(1,1);
		$("#fecha1").val("<?php echo date('Y/m/d')?>");
		$("#fecha2").val("<?php echo date('Y/m/d')?>");
<?php
		}
?>
		if($("#dates").val()!="Per"){
	    	$('#datetimepicker1').children().prop('disabled',true);
	    	$('#datetimepicker2').children().prop('disabled',true);
    	}
	}
	function Mostrar_Ocultar(num,ex=0){
		if(num==1){
			$("#ep").css("background-color","#E8E8EC");
			$("#ep").css("color","black");
			$("#es").css("background-color","transparent");
			$("#es").css("color","white");
			$('#especialidades').show('slow');
			if(ex!=0)
				$('#graficos').hide();
			else
				$('#graficos').hide('slow');
		}
		else{
			$("#es").css("background-color","#E8E8EC");
			$("#es").css("color","black");
			$("#ep").css("background-color","transparent");
			$("#ep").css("color","white");
			if(ex!=0)
				$('#especialidades').hide();
			else
				$('#especialidades').hide('slow');
			$('#graficos').show('slow');
		}
	}

	$("#dates").change(function(){
	    if($(this).val()=="Per"){
	    	$('#datetimepicker1').children().attr('disabled',false);
	    	$('#datetimepicker2').children().attr('disabled',false);
	    }
	    else{
	    	$('#datetimepicker1').children().attr('disabled','disabled');
	    	$('#datetimepicker2').children().attr('disabled','disabled');
	    }
	});

	$(function () {
        $('#datetimepicker1').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#datetimepicker2').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $("#datetimepicker1").on("dp.change", function (e) {
            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker2").on("dp.change", function (e) {
            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });
    });

    function find(encontrar){
    	$("html, body").animate({ scrollTop: $(encontrar).offset().top }, 500);
    }
</script>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>
