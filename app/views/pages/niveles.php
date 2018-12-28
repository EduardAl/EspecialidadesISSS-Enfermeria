<?php require RUTA_APP.'\views\inc\header.php'; ?>
<div class="container">
	<div id="datosNivel" class="col-xs-12">
		<div>
			<h3>Ausentismo por Nivel</h3>
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
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>