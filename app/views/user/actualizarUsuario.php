<?php require RUTA_APP.'/views/inc/header.php'; ?>
<form name="form" id="form-hide" method="POST" action="<?= RUTA_URL . '/Users/Actualizar' ?>">
	<div class="container" align="center">
		<div class="col-xs-3 colapsa"></div>
		<div class="col-xs-12 col-md-6" style="align: center;">
			<input type="text" name="id" hidden value="<?php echo $datos['id']?>">
	        <h2 class="text-center">Actualización de Usuario</h2>
        	<div class="form-group" align="center">
        		<label for="inputFName">Nombre:</label>
        		<input type="name" name="fname" id="inputFName" class="form-control" placeholder="Inserte su Nombre" required autofocus>
        	</div>
	        <div class="form-group" align="center">
		        <label for="inputLName">Apellido:</label>
		        <input type="name" name="lname" id="inputLName" class="form-control" placeholder="Inserte su Apellido" required >
		    </div>
	        <div class="form-group" align="center">
		        <label for="inputEmail" class="">Correo:</label>
	        	<input type="email" name="email" id="inputEmail" class="form-control" placeholder="nombre_usuario@dominio.com" required>
		    </div>
	        <div class="form-group" align="center">
	        	<label for="inputPassword" class="">Contraseña:</label>
	        	<input type="password" name="password" id="inputPassword" class="form-control" placeholder="**********" minlength="4">
	        </div>
	        <div class="form-group" align="center">
	        	<label for="inputRol" class="">Rol:</label>
		    	<select name="rol" class="form-control" id="inputRol" >
					<option value="2" style="text-align: center;">Administrador</option>
					<option value="3">Usuario</option>
					<option value="4">Administrativo</option>
				</select>
	        </div>
	        <div class="col-xs-12"><button class="btn btn-lg btn-primary" type="submit">Actualizar</button></div>
	        <?php if(isset($datos['error_message'])) { echo "<span class=estiloError; style='color:red;'>".$datos['error_message']."</span>";
	    	}?>
</form>
    		<div class="col-xs-3">
		    	<form method="POST" action="<?= RUTA_URL . '/Users/Actualizar' ?>">
					<input type="text" name="id" hidden value="<?php echo $datos['id']?>">
    				<button class="btn btn-sm btn-danger" type="submit">Eliminar Usuario</button>
	    		</form>
	     	</div>
     	</div>
	    <div class="col-xs-3 colapsa"></div>
	</div>
<script type="text/javascript">
	window.onload=function(){
		$("#inputFName").val("<?php echo $datos['usuario']->Nombre?>");
		$("#inputLName").val("<?php echo $datos['usuario']->Apellido?>");
		$("#inputEmail").val("<?php echo $datos['usuario']->Email?>");
		$("#inputRol").val("<?php echo $datos['usuario']->Rol?>");

	}
</script>
<?php require RUTA_APP.'/views/inc/footer.php'; ?>