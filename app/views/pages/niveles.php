<?php require RUTA_APP.'\views\inc\header.php'; ?>
<div class="container" style="min-height: 350px;">
	<div class="row">
		<div id="Seleccionadores">
			<br>
			<div class="col-xs-3">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h4>Indicadores de Enfermería</h4>
						<p> </p>
						<a onclick="Mostrar_Ocultar(2)"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>

			<div class="col-xs-3">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h4>Preparación de Pacientes</h4>
						<p> </p>
						<a onclick="Mostrar_Ocultar(2)"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>

			<div class="col-xs-3">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h4>Ausentismo</h4>
						<p> </p>
						<a onclick="Mostrar_Ocultar(1)"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>

			<div class="col-xs-3">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h4>Educación en Salud</h4>
						<p> </p>
						<a onclick="Mostrar_Ocultar(1)"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>

			<div class="col-xs-3">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h4>Charlas Informativas</h4>
						<p> </p>
						<a onclick="Mostrar_Ocultar(2)"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>

			<div class="col-xs-3">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h4>Educación Continua</h4>
						<p> </p>
						<a onclick="Mostrar_Ocultar(1)"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>

			<div class="col-xs-3">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h4>Educación C. Epidemiología</h4>
						<p> </p>
						<a onclick="Mostrar_Ocultar(2)"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>

			<div id="tab1" class="col-xs-3">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/urologia.jpg">
					<div class="caption">
						<h4>Gestión Administrativa</h4>
						<p> </p>
						<a onclick="Mostrar_Ocultar(1)"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>
		</div>

		<div id="tablas">

			<div id="btn" class="col-xs-2 navbar-right" style="padding-top: 8px;">
				<button class="btn btn-info btn-block" onclick="Mostrar_Ocultar(0)">Volver</button>
			</div>
			<div id="preparacionNivel" class="col-xs-12">
				<div class="col-xs-12">
					<h3>Preparación de Pacientes</h3>
				</div>
				<div class="col-xs-12" style="overflow: auto; max-height: 800px;">
					<?php $data=$datos; $datos=$data['datos1']; $id=1;
					include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
				<div class="col-xs-12">
					<div class=thumbnail style="align-items: center; overflow: auto; overflow-y: hidden; ">
						<?php include RUTA_APP.'\views\reportes\levelChart.php'; ?>
					</div>
				</div>
			</div>

			<div id="ausentismoNivel" class="col-xs-12">
				<div>
					<h3>Ausentismo por Nivel</h3>
				</div>
				<div class="col-xs-12" style="overflow: auto; max-height: 800px;">
					<?php $datos=$data['datos1']; $id++;
					include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
				<div class="col-xs-12">
					<div class=thumbnail style="align-items: center; overflow: auto; overflow-y: hidden; ">
						<?php include RUTA_APP.'\views\reportes\levelChart.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function(){
		Mostrar_Ocultar(0);
	}
	function Mostrar_Ocultar(num){
		if(num!=0)
			$('#Seleccionadores').hide();
		$('#preparacionNivel').hide();
		$('#ausentismoNivel').hide();
		$('#btn').show();

		switch(num){
			case 1:
				$('#ausentismoNivel').show();
			break;
			case 2:
				$('#preparacionNivel').show();
			break;
			default:
				$('#btn').hide();
				$('#Seleccionadores').show();
			break;
		}
	}
</script>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>