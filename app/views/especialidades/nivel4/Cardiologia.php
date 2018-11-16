<?php require RUTA_APP.'\views\inc\header.php'; ?>
	<div class = "container">
		<div class = "row">
			<div class="col-xs-12">
				<h1>Procedimientos de Cardiología</h1>
				<a href="<?php echo RUTA_URL?>/Mantenimiento/Procedimiento/Cardiologia">Ingresar</a>
			</div>
			<!-- Procedimientos Mes -->
			<div>
				<div class="col-xs-12">
					<h3>Datos del Mes Actual</h3>
				</div>

			<!-- De prueba -->
			<div class="col-xs-12">
				<div class="col-xs-12" style="overflow: auto; max-height: 400px;">
					<?php include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-12">
					<div class=thumbnail style="align-items: center; overflow: auto; overflow-y: hidden;  min-width: 1210px; max-width: 2000px;">
						<?php include RUTA_APP.'\views\reportes\columnChart.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>