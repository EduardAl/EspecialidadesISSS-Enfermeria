<?php require RUTA_APP.'\views\inc\header.php'; ?>
<div class = "container">
	<div class = "row">
		<div class="col-xs-12">
			<div class="col-xs-10">
				<h1>Quinto Nivel</h1>
			</div>
			<div class="col-xs-2" >
				<form action="<?php echo RUTA_URL?>/Mantenimiento/Nivel/5">
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
				<img src="<?php echo RUTA_URL?>/images/oftalmologia.jpg">
				<div class="caption">
					<h3>Oftalmología</h3>
 						<p> </p>
 						<a href="<?php echo RUTA_URL?>/Nivel/Especialidad/5/Oftalmologia"> Ver tablas y estadísticas </a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>