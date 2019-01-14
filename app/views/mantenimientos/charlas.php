<?php require RUTA_APP.'\views\inc\header.php'; $data=$datos;?>
<div class="container">
	<div class="col-xs-6" align="center">
		<form class=form-formulario" method="POST" action="<?php echo RUTA_URL.'/Mantenimiento/ActualizarCharla/';?>"><?php 
			if(isset($data['Charla'])){
				echo '<input type="text" name="id" hidden value="'.$_POST['extra'].'">';
				echo '<input type="text" name="level" hidden value="'.$data['Charla']->nivel.'">';
				}
			?>
	        <h2 class="text-center">Actualizar</h2>
	        <div class="row text-center">
	        	<label for="inputFName" class="text-center">Descripción:</label>
	        </div>
	        <input type="name" name="fname" id="inputFName" height="30px" class="form-control" placeholder="Descripción" required>
	        <br>
	        <div class="row text-center">
	        	<label for="estado" class="">Estado:</label>
	        </div>
	       <select name="estado" class="form-control" id="inputEstado" required>
       			<option value="Programada">Programada</option>
       			<option value="Realizada">Realizada</option>
				<option value="Perdida">Perdida</option>;
			</select>
	        <br>
	        <div class="row text-center">
	        	<label for="inputFDate" class="text-center">Fecha:</label>
			</div>
			<div class="form-group">
				<div class='input-group date' id='fechaCh'>
					<input type='text' class="form-control" name="fechaC" id="fechaC" required/>
				        <span class="input-group-addon">
				            <span class="glyphicon glyphicon-calendar"></span>
				        </span>
				</div>
			</div>
			<div class="row text-center">
	        	<label for="tipo" class="">Tipo:</label>
	        </div>
	       <select name="tipo" class="form-control" id="inputTipo" required>
	       		<?php
	       		if(isset($data['health'])){
		       		foreach ($data['health']['TítulosY'] as $key) {
		       			echo "<option value=".$key->id.">".$key->title."</option>";
		       		}
		       	}
				?>
			</select>
	        <br>
	        <button class="btn btn-primary" type="submit">Actualizar</button><br>
	        <?php if(isset($datos['error_message'])) { echo "<span class=estiloError; style='color:red;'>".$datos['error_message']."</span>";
	    	}?>
		</form>
	</div>
	<div class="col-xs-6" align="center">
		<?php 
			if(isset($data['Charla'])){
			echo '<form method="POST" style="padding-top: 20px;" action="'.RUTA_URL.'/Mantenimiento/ActualizarEducacion/">';

				if($data['Charla']->Oyentes=="Personal"){
					$datos=$data['Listeners'][0];
				}
				else{
					$datos=$data['Listeners'][1];
				}
				echo '<input type="text" name="id" hidden value="'.$_POST['extra'].'">';
				echo '<input type="text" name="level" hidden value="'.$data['Charla']->nivel.'">';
				include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
				echo '<button class="btn btn-primary" type="submit">Actualizar datos</button>';
				echo "</form>";
			}
		?>
	</div>
</div>
<script type="text/javascript">
	$(function () {
        $('#fechaCh').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
    });
	window.onload = function(){<?php
		if(isset($data['Charla'])){?>

		$('#inputFName').val("<?php echo $data['Charla']->descripcion; ?>");
		$('#inputEstado').val("<?php echo $data['Charla']->estatus; ?>");
		$('#fechaC').val("<?php echo $data['Charla']->fecha; ?>");
		$('#fechaCh').val("<?php echo $data['Charla']->fecha; ?>");
		$('#inputTipo').val("<?php echo $data['Charla']->tipo; ?>");<?php }?>

	}
</script>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>