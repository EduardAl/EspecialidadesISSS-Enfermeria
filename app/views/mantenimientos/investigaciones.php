<?php require RUTA_APP.'/views/inc/header.php'; $data=$datos;?>
<div class="container">
	<div class="col-xs-3 colapsa"></div>
	<div class="col-xs-12 col-md-6" align="center">
		<form class=form-formulario" method="POST" action="<?php echo RUTA_URL.'/Mantenimiento/ActualizarInv/';?>"><?php 
			if(isset($data['investigations'])){
				echo '<input type="text" name="id" hidden value="'.$_POST['extra'].'">';
				echo '<input type="text" name="level" hidden value="'.$data['investigations']->nivel.'">';
				}
			?>
	        <h2 class="text-center">Actualizar</h2>
	        <div class="row text-center">
	        	<label for="inputFName" class="text-center">Nombre:</label>
	        </div>
	        <input type="name" name="fname" id="inputFName" height="30px" class="form-control" placeholder="Descripción" required autofocus>
	        <br>
	        <div class="row text-center">
	        	<label for="inputFName" class="text-center">Descripción:</label>
	        </div>
	        <input type="name" name="description" id="inputDescription" height="30px" class="form-control" placeholder="Descripción" required>
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
	        <br>
	        <button class="btn btn-primary" type="submit">Actualizar</button><br>
	        <?php if(isset($datos['error_message'])) { echo "<span class=estiloError; style='color:red;'>".$datos['error_message']."</span>";
	    	}?>
		</form>
	</div>
	<div class="col-xs-3 colapsa"></div>
</div>
<script type="text/javascript">
	$(function () {
        $('#fechaCh').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
    });
	window.onload = function(){<?php
		if(isset($data['investigations'])){?>

		$('#inputFName').val("<?php echo $data['investigations']->name; ?>");
		$('#inputDescription').val("<?php echo $data['investigations']->descripcion; ?>");
		$('#inputEstado').val("<?php echo $data['investigations']->estatus; ?>");
		$('#fechaC').val("<?php echo $data['investigations']->fecha; ?>");<?php }?>

	}
</script>
<?php require RUTA_APP.'/views/inc/footer.php'; ?>