<?php require RUTA_APP.'\views\inc\header.php'; ?>
<body>
	<div class = "container">
		<div class = "row">
			<div class="col-xs-12">
				<h1>Usuarios</h1>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-12" style="overflow: auto; max-height: 400px;">
					<?php include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
				</div>
			</div>
		</div>
	</div>
</body>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>