<?php require RUTA_APP.'\views\inc\header.php'; ?>
<body>
	<div class = "container">
		<div class = "row">
			<div style="background-color: gray" class="col-xs-12">
				<h1 class="">Quinto Nivel</h1>
			</div>
			<!-- Procedimientos Mes -->
			<div class="col-xs-12" >
  				<form class="form-formulario" method="POST" action="<?= RUTA_URL . '/Mantenimiento/IngresoNivel/5' ?>">
					<div class="col-xs-12" style="background-color: darkgray; display: inline-block; align-items: center">
					<h3>Ingreso de datos de nivel</h3>
    					<button class="btn btn-primary navbar-right" type="submit">Ingresar Datos</button>
					</div>
					<?php 
					$data = $datos;
					$datos=$data['levelThings'];
					include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
					?>
				</form>
			</div>
			<div class='col-xs-12' >
			<div style="background-color: darkgray">					
			<?php

			if(isset($data['especialidades']))
			{
				?>
				<?php
					echo "<h2>Datos de las especialidades</h2>";
					?>

			</div>
			<?php
					foreach ($data['especialidades'] as $key) {
					echo "<h3>".$key->title."</h3>";
					?>
  					<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/IngresoEspecialidad/5/'.$key->id?>">
					<div class="col-xs-12" style="display: inline-block; align-items: center">
    					<button class="btn btn-primary navbar-right" type="submit">Ingresar Datos</button>
					</div>
					<?php 
					$datos=$data['specialty'];
					include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
					?>
					</form>
				<?php
					}
			}
			?>
			</div>
			<div class='col-xs-12'>
			<?php
			if(isset($data['especialidades']))
			{
					echo "<h2>Procedimientos de las especialidades</h2>";
					$variable=0;
					foreach ($data['especialidades'] as $key) {
					echo "<h3>".$key->title."</h3>";
					?>
			
  					<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/IngresoProcedimiento/5/'.$key->id?>">
					<div class="col-xs-12" style="display: inline-block; align-items: center">
    					<button class="btn btn-primary navbar-right" type="submit">Ingresar Datos</button>
					</div >
					<?php 
					$datos=$data['procedures'];
					$datos = $datos[$variable];
					include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
					$variable ++;
					?>
					</form>
				<?php
					}
			}
			?>
			</div>
		</div>
	</div>
</div>
</body>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>