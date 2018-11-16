<?php require RUTA_APP.'\views\inc\header.php'; ?>
<STYLE>
.hideable { position: relative; visibility: visible; }
</STYLE>
<SCRIPT>
function Mostrar_Ocultar(hide) {
if (document.layers)
document.form.visibility = hide ? 'show' : 'hide';
else {
var g = document.all ? document.all.form :
document.getElementById('contenido');
g.style.visibility = hide ? 'visible' : 'hidden';
}
}
</SCRIPT>
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
			<div align="right">
				<div class="col-xs-8"></div>
				<div class="col-xs-3">
				<button class="btn btn-lg btn-primary type="submit" onclick="Mostrar_Ocultar();">Nuevo Usuario</button><br><br>
				</div>
				<div class="col-xs-1"></div>
			</div>
			<form name="form" style="visibility: visible;">
				<div class="container">
					<div class="col-xs-3"></div>
						<div class="col-xs-6" style="align: center;">
					        <h2 class="text-center">Registro de nuevo usuario</h2>
					        <div class="row text-center">
					        	<label for="inputFName" class="text-center">Nombre:</label>
					        </div>
					        <input type="name" name="name" id="inputFName" class="form-control" placeholder="Inserte su Nombre" required autofocus>
					        <br>
					        <div class="row text-center">
						        <label for="inputLName" class="">Apellido:</label>
						    </div>
					        <input type="name" name="name" id="inputLName" class="form-control" placeholder="Inserte su Apellido" required autofocus>
					        <br>
					        <div class="row text-center">
						        <label for="inputEmail" class="">Correo:</label>
						    </div>
					        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="nombre_usuario@dominio.com" required autofocus>
					        <br>
					        <div class="row text-center">
					        	<label for="inputPassword" class="">Contraseña:</label>
					        </div>
					        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="**********" required minlength="4">
					        <br>
					        <div class="row text-center">
					        	<label for="inputRol" class="">Rol:</label>
					        </div>
					        <select class="form-control">
								<option value="1">Administrador</option>
								<option value="2">Usuario</option>
								<option value="3">Invitado</option>
							</select>
					        <br>
					        <button class="btn btn-lg btn-primary" type="submit">Entrar</button><br>
					        <?php if(isset($datos['error_message'])) { echo "<span class=estiloError>".$datos['error_message']."</span>"; }?>
				     	</div>
				    <div class="col-xs-3"></div>
				</div>
			</form>
			
		</div>
	</div>
</body>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>