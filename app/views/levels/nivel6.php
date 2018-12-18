<?php require RUTA_APP.'\views\inc\header.php'; ?>
<div class = "container">
	<div class = "row">
		<div class="col-xs-12">
			<div class="col-xs-10">
				<h1>Sexto Nivel</h1>
			</div>
			<div class="col-xs-2" >
				<form action="<?php echo RUTA_URL?>/Mantenimiento/Nivel/6">
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
				<img src="<?php echo RUTA_URL?>/images/nefrologia.jpg">
				<div class="caption">
					<h3>Nefrología</h3>
					<p> </p>
					<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/6/Nefrologia"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<div class=thumbnail>
				<img src="<?php echo RUTA_URL?>/images/neurologia.jpg">
				<div class="caption">
					<h3>Neurología</h3>
					<p> </p>
					<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/6/Neurologia"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<div class=thumbnail>
				<img src="<?php echo RUTA_URL?>/images/neurocirugia.jpg">
				<div class="caption">
					<h3>Neurocirugía</h3>
					<p> </p>
					<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/6/Neurocirugia"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>