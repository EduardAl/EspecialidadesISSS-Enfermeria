<div class="container">
	<form method="POST" enctype="multipart/form-data" action="<?php echo RUTA_URL?>/Mantenimiento/IngresoExcel"> 
		<div class="col-md">
			<div class="row">
				<div class="form-group">
					<label for="name">Nombre: </label>
		    		<input type="text" name="name" id="name" class="form-control" required maxlength="100">
				</div>
				<div class="form-group">
					<label for="desc">Descripción: </label>
		    		<input type="text" name="desc" id="desc" class="form-control" maxlength="200"required>
				</div>
				<div class="form-group">
					<label for="file">Archivo: </label>
		    		<input type="file" name="file" id="file" required>
				</div>
			</div>	
			<div class="row">
				<input type="submit" name="submit" class="btn btn-primary" value="Subir">
			</div>
		</div>
	</form>
	<br>
	<div class="row">
		<?php include RUTA_APP.'/views/reportes/tablaShow.php'?>
	</div>
</div>