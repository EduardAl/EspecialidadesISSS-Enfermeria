<?php require RUTA_APP.'\views\inc\header.php'; ?>
<body>
	<div class = "container">
		<div class = "row">
			<div class="col-xs-12">
				<h1>Procedimientos de Oftalmología</h1>
				<a href="<?php echo RUTA_URL?>/Mantenimiento/Procedimiento/Oftalmología">Ingresar</a>
			</div>

			<!-- De prueba -->
			<div class="col-xs-12">
				<div class="col-xs-6">
					<div class=thumbnail style="overflow: auto; overflow-y: hidden;  max-width: 500px;">
						<?php include RUTA_APP.'\views\reportes\columnChart.php'; ?>
					</div>
				</div>
				<div class="col-xs-6" style="overflow: auto; max-height: 400px;">
					<?php include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
			</div>
		</div>
	</div>
</body>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>