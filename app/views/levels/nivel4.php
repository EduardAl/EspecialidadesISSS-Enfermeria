<?php require RUTA_APP.'\views\inc\header.php'; ?>
<div class = "container">
	<div class = "row">

		<div class="col-xs-12">
			<div class="col-xs-10">
				<h1>Cuarto Nivel</h1>
			</div>
			<div class="col-xs-2" >
					<br>
	      			<button class="btn btn-primary btn-block" onclick="window.location='<?php echo RUTA_URL?>/Mantenimiento/Nivel/4'">Ingresar</button>
			</div>
		</div>

		<br> <br> <br>

		<div class="col-xs-12">
			<h3>Especialidades del Nivel</h3>
		</div>
		<br> <br> <br> <br>

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
	</div>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>
