<?php require RUTA_APP.'\views\inc\header.php';?>
<form class=form-formulario" method="POST" action="<?php echo RUTA_URL.'/Mantenimiento/IngresoCharla/'.$nNivel?>">
	<div class="container" align="center" id="hide">
			<div class="col-xs-3"></div>
				<div class="col-xs-6" style="align: center;">
			        <h2 class="text-center">Actualizar</h2>
			        <div class="row text-center">
			        	<label for="inputFName" class="text-center">Descripción:</label>
			        </div>
			        <input type="name" name="fname" id="inputFName" height="30px" class="form-control" placeholder="Descripción" required>
			        <br>
			        <div class="row text-center">
			        	<label for="estado" class="">Estado:</label>
			        </div>
			       <select name="estado" class="form-control" required>
		       			<option value="Programada">Programada</option>
		       			<option value="Realizada">Realizada</option>
					</select>
			        <br>
					<div class="row text-center">
			        	<label for="tipo" class="">Tipo:</label>
			        </div>
			       <select name="tipo" class="form-control" required>
			       		<?php
				       		foreach ($datos['health'] as $key) {
				       			echo "<option value=".$key->id.">".$key->title."</option>";
				       		}
						?>
					</select>
			        <br>
			        <button class="btn btn-lg btn-primary" type="submit">Entrar</button><br>
			        <?php if(isset($datos['error_message'])) { echo "<span class=estiloError; style='color:red;'>".$datos['error_message']."</span>";
			    	}?>
		     	</div>
		    <div class="col-xs-3"></div>
		</div>
</form>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>