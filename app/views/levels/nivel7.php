<?php require RUTA_APP.'\views\inc\header.php'; ?>
<div class = "container">
	<div class = "row">
		<div class="col-xs-12">
			<div class="col-xs-10">
				<h1>Séptimo Nivel</h1>
			</div>
			<div class="col-xs-2" >
				<form action="<?php echo RUTA_URL?>/Mantenimiento/Nivel/7">
					<br>
	      			<button class="btn btn-primary btn-block" type="submit">Ingresar</button>
	      		</form>
			</div>
		</div>
		<br> <br> <br>

		<div class="col-xs-12">
			<h3>Especialidades del Nivel</h3>
		</div>
		<br> <br> <br> <br>


		<div class="col-xs-4">
			<div class=thumbnail>
				<img src="<?php echo RUTA_URL?>/images/neumologia.jpg">
				<div class="caption">
					<h3>Neumología</h3>
					<p> </p>
					<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/7/Neumologia"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<div class=thumbnail>
				<img src="<?php echo RUTA_URL?>/images/gastroenterologia.png">
				<div class="caption">
					<h3>Gastroenterología</h3>
					<p> </p>
					<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/7/Gastroenterologia"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<div class=thumbnail>
				<img src="<?php echo RUTA_URL?>/images/reumatologia.jpg">
				<div class="caption">
					<h3>Reumatología</h3>
					<p> </p>
					<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/7/Reumatologia"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<div class=thumbnail>
				<img src="<?php echo RUTA_URL?>/images/cirugiaPeriferica.jpg">
				<div class="caption">
					<h3>Cirugía Periférica</h3>
					<p> </p>
					<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/7/Periferica"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<div class=thumbnail>
				<img src="<?php echo RUTA_URL?>/images/evaluacionCardiovascular.jpg">
				<div class="caption">
					<h4>Programa de Hipertensión Arterial y Evaluaciones CardioVasculares</h4>
					<p> </p>
					<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/7/CardioVascular"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>