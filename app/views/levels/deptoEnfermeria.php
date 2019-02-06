<?php require RUTA_APP.'\views\inc\header.php';$data=$datos;?>
<div>
	<div style="background: #050D42;">
		<div class="container">
			<div class="col-xs-10 col-md-10">
				<h1 style="color: white;">Departamento de Enfermería</h1>
			</div>
			<div class="col-xs-2 col-md-2 impre" align="right">
			<?php
				if((isset($_SESSION['acceso']))&&
					($_SESSION['acceso']==1||$_SESSION['acceso']==2||$_SESSION['acceso']==3)){?>
				<div class="navbar-toggle collapsed">
					<button class="btn btn-primary" onclick="window.location='<?php echo RUTA_URL?>/Mantenimiento/Nivel/Enfermeria'">
		  				<span class="glyphicon glyphicon-edit"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse">
					<br>
		  			<button id="hide" class="btn btn-primary" onclick="window.location='<?php echo RUTA_URL?>/Mantenimiento/Nivel/Enfermeria'">
		  				<span class="glyphicon glyphicon-edit"></span> Ingresar Datos
	  				</button>
	  			</div>
	  		<?php }?>
	  		</div>
		</div>
	</div>
	<div id="navbar" class="extra impre">
		<div class="container">
			<ul>
				<li><a id="es" class="">Estadísticas del Departamento</a></li>
			</ul>
		</div>
	</div>
</div>
<div class = "container">
	<div id="graficos" style="min-height: 350px;">
		<div class = "row">
			<div class="col-xs-12">
				<h2><?php if(isset($datos['fechaT']))echo$datos['fechaT'];else echo"Mes Actual";?></h2>
			</div>
			<div id="filtro" class="col-xs-12 impre" align="right">
				<div class="col-xs-12">
					<hr>
				</div>
				<form method="post" action="<?php echo RUTA_URL?>/Nivel/level/DeptoEnfermeria">
					<div class="col-xs-3 col-md-1" align="left">
						<div class="form-group" align="right" style="padding-top: 7px;">
							<label for="cbOrdenar">Ver por:</label>
						</div>
					</div>
					<div class="col-xs-4 col-md-2">
						<div class="form-group">
							<select name="cbOrdenar" class="form-control" id="dates" >
								<option value="Month">Mes</option>
								<option value="Year">Año</option>
								<option value="Per">Personalizado</option>
							</select>
						</div>
					</div>
					<div class="col-xs-5 col-md-2">
						<div class="form-group">
							<select name="cbSeparador" class="form-control" id="separador">
								<option value="1" selected>Una sola Tabla</option>
								<option value="2">Separar Meses</option>
							</select>
						</div>
					</div>
					<div class="col-xs-2 col-md-1">
						<div class="form-group">
							<label style="text-align: center; padding-top: 7px;">Entre:</label>
						</div>
					</div>
					<div class="col-xs-5 col-md-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker1'>
						        <input type='text' class="form-control" name="fecha1" id="fecha1" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-5 col-md-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker2'>
						        <input type='text' class="form-control" name="fecha2" id="fecha2" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-12 col-md-2" align="center">
						<button class="btn btn-info"type="submit" >
							<span class="glyphicon glyphicon-refresh"></span> Actualizar
						</button>
					</div>
				</form>
				<div class="col-xs-12">
					<hr>
				</div>
			</div>
		</div>
		<div class = "row">
			<div id="indicadoresEnfermeria">
				<div class="col-xs-12">
					<h3>Indicadores de Enfermería</h3>
				</div>
				<?php if(isset($data['indicadores'])){$datos=$data['indicadores'];
					include RUTA_APP.'\views\reportes\tablaShow.php';} ?>
			</div>
			<div class="col-xs-12">
				<hr>
			</div>
			<div id="ausentismo">
				<div class="col-xs-12">
					<h3>Ausentismo</h3>
				</div>
				<?php if(isset($data['ausentismo'])){$datos=$data['ausentismo'];
					include RUTA_APP.'\views\reportes\tablaShow.php'; }?>
			</div>
			<div class="col-xs-12">
				<hr>
			</div>
			<div id="graphics">
				<?php if(isset($data['graf'])){ 
					foreach($data['graf'] as $key){
					$datos=$key; include RUTA_APP.'\views\reportes\pieChart.php';
				}}?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function (){
		$("#es").css("background-color","#E8E8EC");
		$("#es").css("color","black");
	<?php
		if(isset($data['tiempo']))
		{
			$tempo =$data['tiempo'];
	?>
		$("#dates").val("<?php echo $tempo['tipo']?>");
		$("#fecha1").val("<?php echo $tempo['fecha1']?>");
		$("#fecha2").val("<?php echo $tempo['fecha2']?>");
		$("#separador").val("<?php echo $tempo['separador']?>");
	<?php
		}
		else{
	?>
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
</script>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>