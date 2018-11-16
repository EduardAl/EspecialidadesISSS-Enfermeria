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

				<div class="col-xs-12">
					<div class="col-xs-6 showing graf">
						<div class=thumbnail style="overflow: auto; overflow-y: hidden;">
							<?php include RUTA_APP.'\views\reportes\columnChart.php'; ?>
						</div>
					</div>
					<div class="col-xs-6 showing" style="overflow: auto; ">
						<?php include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>