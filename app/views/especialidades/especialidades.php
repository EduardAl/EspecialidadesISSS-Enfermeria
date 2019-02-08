<?php require RUTA_APP.'/views/inc/header.php'; $data=$datos;$id=0;?>
<div class = "container">
	<div class = "row">
		<div class="col-xs-12">
			<h1><?php if(isset($datos['especialidad']))echo$datos['especialidad'];else echo"Sin Datos";?></h1>
			<h4><?php if(isset($datos['fechaT']))echo$datos['fechaT'];else echo"Mes Actual";?></h4>
		</div>
		<div id="filtro" class="col-xs-12 impre" align="right">
			<div class="col-xs-12">
				<hr>
			</div>
			<form method="post" <?php
			if(isset($datos['recarga'])) echo 'action="'.RUTA_URL.'/Nivel/Especialidad/'.$datos['recarga'].'"'?>>
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
	<!-- Procedimientos -->
		<div id="procedimientos">
			<?php if(isset($data['datos1']['meta'])&&isset($data['datos1']['meta']['values'][0])){ ?>
			<div class="col-xs-12" >
				<h3>Procedimientos</h3>
			</div>
			<?php $datos=$data['datos1']['meta'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				if(isset($data['datos1']['graf']))$datos=$data['datos1']['graf']; 
					include RUTA_APP.'/views/reportes/columnChart.php'; ?>
			<?php }?>
		</div>
	<!-- Pacientes -->
		<div id="pacientes">
			<?php if(isset($data['datos2']['meta'])&&isset($data['datos2']['meta']['values'][0])){ ?>
			<div class="col-xs-12" >
				<h3>Pacientes</h3>
			</div>
			<?php $datos=$data['datos2']['meta'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				if(isset($data['datos2']['graf']))$datos=$data['datos2']['graf']; 
				include RUTA_APP.'/views/reportes/pieChart.php';
			}?>
		</div>
	<!-- Referencias -->
		<div id="referencias">
			<?php if(isset($data['datos3']['meta'])&&isset($data['datos3']['meta']['values'][0])){ ?>
			<div class="col-xs-12" >
				<h3>Referencias</h3>
			</div>
			<?php $datos=$data['datos3']['meta'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
			}?>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function(){
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
			else
			{
				echo '$("#fecha1").val("'.date('Y/m/d').'");';
				echo '$("#fecha2").val("'.date('Y/m/d').'");';
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
<?php require RUTA_APP.'/views/inc/footer.php'; ?>