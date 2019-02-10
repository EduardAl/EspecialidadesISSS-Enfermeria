<?php require RUTA_APP.'/views/inc/header.php'; $data=$datos;$fechaBool=false; ?>
<div class="container" style="min-height: 350px;">
	<div id="ConseguirDatos"hidden>
		<div class="row" style="padding-top: 8px;">
			<div hidden id="btn1">
				<div class="col-xs-12 col-md-12" align="right" >
					<button class="btn btn-info impre" hidden onclick="Mostrar_Ocultar(41)">Ocultar</button>
				</div>
			</div>
		</div>
		<form method="POST" class="impre">
			<div class="col-xs-12 thumbnail caption">
				<div class="row">
					<div class="col-xs-12">
						<h3>Generador</h3>
					</div>
				</div>
				<div class="col-xs-5 col-md-1">
					<label style="padding-top: 6px;">Informe:</label>
				</div>
				<div class="col-xs-7 col-md-3">
					<div class="form-group">
						<select name="cbInforme" class="form-control" id="elegir" >
							<option value="indicadores" selected>Indicadores de Enfermería</option>
							<option value="pPacientes">Preparación de Pacientes</option>
							<option value="ausentismo">Ausentismo</option>
							<option value="referencias">Referencias</option>
							<option value="eduSalud">Educación en Salud</option>
							<option value="eduCharlas">Charlas Informativas</option>
							<option value="eduContinua">Educación Continua</option>
							<option value="eduEpidemiologia">Educación C. Epidemiología</option>
							<option value="eduOftalmologia">Educación C. Oftalmología</option>
							<option value="reuniones">Reuniones Administrativas</option>
							<option value="administracion">Gestión Administrativa</option>
							<option value="administracion2">Administración</option>
						</select>
					</div>
				</div>
				<div class="col-xs-5 col-md-1">
					<label style="padding-top: 6px;">Fechas:</label>
				</div>
				<div class="col-xs-7 col-md-3">
					<div class="form-group">
						<select name="cbFecha" class="form-control" id="fecha" >
							<option value="Month" selected>Mes Actual</option>
							<option value="Year">Año Actual</option>
							<option value="Per">Personalizado</option>
						</select>
					</div>
				</div>
				<div class="col-xs-5 col-md-1">
					<label style="padding-top: 6px;">Separador:</label>
				</div>
				<div class="col-xs-7 col-md-3">
					<div class="form-group">
						<select name="cbSeparador" class="form-control" id="separador" disabled>
							<option value="1" selected>Una sola columna</option>
							<option value="2">Separar Meses</option>
						</select>
					</div>
				</div>
				<div class="col-xs-2 colapsa"></div>
				<div class="col-xs-5 col-md-1" align="center">
					<label style="padding-top: 8px;">Desde:&nbsp;</label>
				</div>
				<div class="col-xs-7 col-md-3">
					<div class="form-group">
					    <div class='input-group date' id='datetimepicker1' style="color: black;">
					        <input type='text' class="form-control" name="fecha1" id="fecha1" disabled required />
					        <span class="input-group-addon">
					            <span class="glyphicon glyphicon-calendar"></span>
					        </span>
					    </div>
					</div>
				</div>
				<div class="col-xs-5 col-md-1" align="center">
					<label style="padding-top: 8px;">Hasta:&nbsp;</label>
				</div>
				<div class="col-xs-7 col-md-3">
					<div class="form-group">
					    <div class='input-group date' id='datetimepicker2' style="color: black;">
					        <input type='text' class="form-control" name="fecha2" id="fecha2" disabled required/>
					        <span class="input-group-addon">
					            <span class="glyphicon glyphicon-calendar"></span>
					        </span>
					    </div>
					</div>
				</div>
				<div class="col-xs-12 col-md-12" align="center">
					<button class="btn btn-info btn-lg">Generar</button>
				</div>
				<div class="col-xs-12">
					<br>
				</div>
			</form>
		</div>
	</div>
	<div id="tablas" hidden>
		<div class="row">
			<?php
				if(isset($data['fecha'])){
					if($data['fecha']=='Mes Actual'||$data['fecha']=='Año Actual'){
						echo '<div class="col-xs-8 col-md-10">';
					}
					else{
						echo '<div class="col-xs-12 col-md-10">';
					}
					echo "<h2>".$data['fecha']."</h2>";
				}
				else{
					echo '<div class="col-xs-8 col-md-10">';
					echo "<h2>Mes Actual</h2>";
				}
				echo "</div>";
			?><div class="col-xs-3 col-md-2"align="right" style="padding-top: 18px;">
				<div class="impre" id="btn2">
					<button class="btn btn-info" onclick="Mostrar_Ocultar(40)">Generar otro</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div id="indicadorEnfermeria" hidden>
				<div class="col-xs-12">
					<h3>Indicadores de Enfermería</h3>
				</div>
				<?php if(isset($data['indicadores'])){$datos=$data['indicadores'];
					include RUTA_APP.'/views/reportes/tablaShow.php'; }?>
			</div>
			<div id="preparacionNivel" hidden>
				<div class="col-xs-12">
					<h3>Preparación de Pacientes</h3>
				</div>
				<?php if(isset($data['pPacientes'])){$datos=$data['pPacientes']['meta'];
					include RUTA_APP.'/views/reportes/tablaShow.php';
					if(isset($data['pPacientes']['graf']))$datos=$data['pPacientes']['graf'];
						include RUTA_APP.'/views/reportes/levelChart.php';
					}?>
			</div>
			<div id="ausentismoNivel" hidden>
				<div class="col-xs-12">
					<h3>Ausentismo por Nivel</h3>
				</div>
					<?php if(isset($data['ausentismo'])){$datos=$data['ausentismo']['meta'];
					include RUTA_APP.'/views/reportes/tablaShow.php';
					if(isset($data['ausentismo']['graf']))$datos=$data['ausentismo']['graf'];
						include RUTA_APP.'/views/reportes/levelChart.php';
					}?>
			</div>
			<div id="referencias" hidden>
				<div class="col-xs-12">
					<h3>Referencias</h3>
				</div>
				<div class="col-xs-12">
					<h4>Por Nivel</h4>
				</div>
				<?php if(isset($data['referencias'])){
				$datos=$data['referencias']['nivel'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				if(isset($data['referencias']['graf']))$datos=$data['referencias']['graf'];
				include RUTA_APP.'/views/reportes/levelChart.php';?>

				<div class="col-xs-12">
					<h4>Por Lugar</h4>
				</div>
				<?php $datos=$data['referencias']['hospital'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				}?>
			</div>
			<div id="educacionSalud" hidden>
				<div class="col-xs-12">
					<h3>Educación en Salud</h3>
				</div>
				<div class="col-xs-12">
					<h4>Metas</h4>
				</div>
					<?php if(isset($data['eduSalud'])){
					// Por Nivel
					$datos=$data['eduSalud']['meta'];
					include RUTA_APP.'/views/reportes/tablaShow.php';
					if(isset($data['eduSalud']['graf']))$datos=$data['eduSalud']['graf'];
						include RUTA_APP.'/views/reportes/columnChart.php';
					// Suma
					$datos=$data['eduSalud']['total'];
					include RUTA_APP.'/views/reportes/tablaShow.php';
					if(isset($data['eduSalud']['graf2']))$datos=$data['eduSalud']['graf2'];
						include RUTA_APP.'/views/reportes/columnChart.php'; ?>

				<div class="col-xs-12">
					<h4>Oyentes</h4>
				</div>
					<?php $datos=$data['eduSalud']['oyentes'];
					include RUTA_APP.'/views/reportes/tablaShow.php';}?>
			</div>
			<div id="charlas" hidden>
				<div class="col-xs-12">
					<h3>Charlas Informativas</h3>
				</div>
				<div class="col-xs-12">
					<h4>Metas</h4>
				</div>
				<?php if(isset($data['eduCharlas'])){
					$datos=$data['eduCharlas']['meta'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				if(isset($data['eduCharlas']['graf']))$datos=$data['eduCharlas']['graf'];
					include RUTA_APP.'/views/reportes/columnChart.php';
				$datos=$data['eduCharlas']['total'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				include RUTA_APP.'/views/reportes/columnChart.php';?>
				<div class="col-xs-12">
					<h4>Oyentes</h4>
				</div>
					<?php $datos=$data['eduCharlas']['oyentes'];
					include RUTA_APP.'/views/reportes/tablaShow.php';}?>
			</div>
			<div id="educacionContinua" hidden>
				<div class="col-xs-12">
					<h3>Educación Continua</h3>
				</div>
				<div class="col-xs-12">
					<h4>Metas</h4>
				</div>
				<?php if(isset($data['eduContinua'])){
					$datos=$data['eduContinua']['meta'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				if(isset($data['eduContinua']['graf']))$datos=$data['eduContinua']['graf'];
					include RUTA_APP.'/views/reportes/columnChart.php'; ?>
				<div class="col-xs-12">
					<h4>Personal</h4>
				</div>
				<?php $datos=$data['eduContinua']['personal'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				$datos=$data['eduContinua']['grafico'];
					include RUTA_APP.'/views/reportes/pieChart.php';
				}?>
			</div>
			<div id="educacionEpidemiologica" hidden>
				<div class="col-xs-12">
					<h3>Educación Continua en Epidemiología</h3>
				</div>
				<div class="col-xs-12">
					<h4>Metas</h4>
				</div>
				<?php if(isset($data['eduEpidemiologia'])){
					$datos=$data['eduEpidemiologia']['meta'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				if(isset($data['eduEpidemiologia']['graf']))$datos=$data['eduEpidemiologia']['graf'];
					include RUTA_APP.'/views/reportes/columnChart.php'; ?>
				<div class="col-xs-12">
					<h4>Personal</h4>
				</div>
				<?php $datos=$data['eduEpidemiologia']['personal'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				$datos=$data['eduEpidemiologia']['grafico'];
				include RUTA_APP.'/views/reportes/pieChart.php'; }?>
			</div>
			<div id="educacionOftalmologica" hidden>
				<div class="col-xs-12">
					<h3>Educación Continua en Oftalmología</h3>
				</div>
				<div class="col-xs-12">
					<h4>Metas</h4>
				</div>
				<?php if(isset($data['eduOftalmologia'])){
					$datos=$data['eduOftalmologia']['meta'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				if(isset($data['eduOftalmologia']['graf']))$datos=$data['eduOftalmologia']['graf'];
					include RUTA_APP.'/views/reportes/columnChart.php'; ?>

				<div class="col-xs-12">
					<h4>Personal</h4>
				</div>
					<?php $datos=$data['eduOftalmologia']['personal'];
					include RUTA_APP.'/views/reportes/tablaShow.php';
					$datos=$data['eduOftalmologia']['grafico'];
					include RUTA_APP.'/views/reportes/pieChart.php'; }?>
			</div>
			<div id="reunionesNivel" hidden>
				<div class="col-xs-12">
					<h3>Reuniones Administrativas</h3>
				</div>
				<div class="col-xs-12">
					<h4>Metas</h4>
				</div>
				<?php if(isset($data['reuniones'])){
					$datos=$data['reuniones']['meta'];
				include RUTA_APP.'/views/reportes/tablaShow.php';
				if(isset($data['reuniones']['graf']))$datos=$data['reuniones']['graf'];
				include RUTA_APP.'/views/reportes/levelChart.php'; }?>
			</div>
			<div id="gestionAdministrativaNivel" hidden>
				<div class="col-xs-12">
					<h3>Gestión Administrativa</h3>
				</div>
				<?php if(isset($data['administracion'])){$datos=$data['administracion'];
					include RUTA_APP.'/views/reportes/tablaShow.php'; }?>
			</div>
			<div id="AdministrativaNivel" hidden>
				<div class="col-xs-12">
					<h3>Administración</h3>
				</div>
				<?php if(isset($data['administracion2'])){$datos=$data['administracion2'];
					include RUTA_APP.'/views/reportes/tablaShow.php'; }?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function(){
		$('#tablas').show();
		Mostrar_Ocultar(<?php echo (isset($data['cargado']))?$data['cargado']:0;?>);
	}
	function Mostrar_Ocultar(num){
		switch(num){
			case 1:
				$('#indicadorEnfermeria').show();
			break;
			case 2:
				$('#preparacionNivel').show();
			break;
			case 3:
				$('#ausentismoNivel').show();
			break;
			case 4:
				$('#educacionSalud').show();
			break;
			case 5:
				$('#charlas').show();
			break;
			case 6:
				$('#educacionContinua').show();
			break;
			case 7:
				$('#educacionEpidemiologica').show();
			break;
			case 8:
				$('#educacionOftalmologica').show();
			break;
			case 9:
				$('#reunionesNivel').show();
			break;
			case 10:
				$('#gestionAdministrativaNivel').show();
			break;
			case 11:
				$('#AdministrativaNivel').show();
			break;
			case 12:
				$('#referencias').show();
			break;
			case 30:
				$('#Metas').show();
				$('#ConseguirDatos').hide('slow');
				$('#tablas').hide();
			break;
			case 31:
				$('#Metas').hide();
				$('#ConseguirDatos').show('slow');
				break;
			case 40:
				$('#ConseguirDatos').show('slow');
				$('#btn1').show();
				$('#btn2').hide('fast');
			break;
			case 41:
				$('#ConseguirDatos').hide('slow');
				$('#btn2').show('fast');
			break;
			default:
				$('#ConseguirDatos').show();
				$('#tablas').hide();
			break;
		}
	}
	$(function () {
        $('#datetimepicker1').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
            defaultDate: new Date()
        });
        $('#datetimepicker2').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
            defaultDate: new Date()
        });
        $("#datetimepicker1").on("dp.change", function (e) {
            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker2").on("dp.change", function (e) {
            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });
    });
    $("#fecha").change(function(){
	    if($(this).val()=="Per"){
	    	$('#datetimepicker1').children().attr('disabled',false);
	    	$('#datetimepicker2').children().attr('disabled',false);
	    	$('#separador').attr('disabled',false);
	    }
	    else{
	    	$('#datetimepicker1').children().attr('disabled','disabled');
	    	$('#datetimepicker2').children().attr('disabled','disabled');
	    	if($(this).val()=="Year")
	    		$('#separador').attr('disabled',false);
	    	else
	    		$('#separador').attr('disabled','disabled');
	    }
	});
</script>
<?php require RUTA_APP.'/views/inc/footer.php'; ?>