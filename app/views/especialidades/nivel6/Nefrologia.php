<?php require RUTA_APP.'\views\inc\header.php'; //Esta no lleva
 ?>
<body>
	<div class = "container">
		<div class = "row">
			<div class="col-xs-12">
				<h1>Procedimientos de Nefrología</h1>
			</div>

			<!-- Procedimientos Mes -->
			<div>
				<div class="col-xs-12">
					<h3>Datos del Mes Actual</h3>
				</div>
			<div class="col-xs-12">
				<div class="col-xs-12" style="overflow: auto; max-height: 400px;">
					<?php $data=$datos; $datos=$data['datos2']; $id=1;
					include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-12">
					<div class=thumbnail style="align-items: center; overflow: auto; overflow-y: hidden;  min-width: 1210px; max-width: 2000px;">
						<?php include RUTA_APP.'\views\reportes\pieChart.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>