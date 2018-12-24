<?php require RUTA_APP.'\views\inc\header.php'; ?>
<body>
	<script type="text/javascript">
		window.onload = function(){
			$('#datosEspecialidades').hide();
			$('#procedimientosEspecialidades').hide();
			$('#metasEspecialidades').hide();
		}
		function Mostrar_Ocultar($num){
			if($num==1)
			{
				$('#datosNivel').show();
				$('#datosEspecialidades').hide();
				$('#procedimientosEspecialidades').hide();
				$('#metasEspecialidades').hide();
			}
			else if($num==2)
			{
				$('#datosEspecialidades').show();
				$('#datosNivel').hide();
				$('#procedimientosEspecialidades').hide();
				$('#metasEspecialidades').hide();
			}
			else if($num==3)
			{
				$('#procedimientosEspecialidades').show();
				$('#datosNivel').hide();
				$('#datosEspecialidades').hide();
				$('#metasEspecialidades').hide();
			}
			else if($num==4)
			{
				$('#metasEspecialidades').show();
				$('#procedimientosEspecialidades').hide();
				$('#datosNivel').hide();
				$('#datosEspecialidades').hide();
			}
	}
	</script>
	<div class = "container" style="min-height: 500px;">
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a class="mouseHover" onclick="Mostrar_Ocultar(1)">Datos del Nivel</a></li>
				<li><a class="mouseHover" onclick="Mostrar_Ocultar(2)">Datos Especialidades</a></li>
				<li><a class="mouseHover" onclick="Mostrar_Ocultar(3)">Procedimientos de Especialidades</a></li>
				<li><a class="mouseHover" onclick="Mostrar_Ocultar(4)">Metas de Especialidades</a></li>
			</ul>
		</div>
		<div class = "row">
			<div  class="col-xs-12">
				<h1 class="">Cuarto Nivel</h1>
			</div>
			<!-- Procedimientos Mes -->
			<div class="col-xs-12" id="datosNivel">
  				<form class="form-formulario" method="POST" action="<?=RUTA_URL.'/Mantenimiento/IngresoNivel/4'?>">
					<div class="col-xs-12" style=" display: inline-block; align-items: center">
					<h3>Ingreso de datos de nivel</h3>
					</div>
					<div class="col-xs-12" style="display: inline-block; align-items: center">
					<?php 
						$data = $datos;
						$datos=$data['levelThings'];
						include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
					?>
					</div>
					<div class="col-xs-12" >
						<div class="col-xs-12">
    						<button class="btn btn-primary navbar-right" type="submit">Ingresar Datos</button>
    					</div>
					</div>
					<div class="col-xs-12" style="display: inline-block; align-items: center">
						<hr>
					</div>
				</form>
			</div>
			<div class='col-xs-12' id="datosEspecialidades">
				<div>					
					<?php
					if(isset($data['especialidades']))
					{
						?>
					<h2>Datos de las especialidades</h2>
				</div>
				<?php
						foreach ($data['especialidades'] as $key) {
						echo "<h3>".$key->title."</h3>";
						?>
	  					<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/IngresoEspecialidad/4/'.$key->id?>">
							<div class="col-xs-12" style="display: inline-block; align-items: center">
								<?php 
								$datos=$data['specialty'];
								include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
								?>
							</div>
							<div class="col-xs-12">
								<div class="col-xs-12">
		    						<button class="btn btn-primary navbar-right" type="submit">Ingresar Datos</button>
								</div>
							</div>
							<div class="col-xs-12" style="display: inline-block; align-items: center">
								<hr>
							</div>
						</form>
					<?php
						}
				}
				?>
			</div>
			<div class='col-xs-12' id="procedimientosEspecialidades">
				<?php
				if(isset($data['especialidades']))
				{
						echo "<h2>Procedimientos de las especialidades</h2>";
						$variable=0;
						foreach ($data['especialidades'] as $key) {
						echo "<h3>".$key->title."</h3>";
						?>
				
	  					<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/IngresoProcedimiento/4/'.$key->id?>">
						<div class="col-xs-12" style="display: inline-block; align-items: center">
							<?php 
							$datos=$data['procedures'];
							$datos = $datos[$variable];
							include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
							$variable ++;
							?>
						</div >
						<div class="col-xs-12" >
							<div class="col-xs-12">
	    						<button class="btn btn-primary navbar-right" type="submit">Ingresar Datos</button>
	    					</div>
						</div>
						<div class="col-xs-12" style="display: inline-block; align-items: center">
							<hr>
						</div>
						</form>
					<?php
						}
				}
				?>
			</div>
			<div class='col-xs-12' id="metasEspecialidades">
				<?php
				if(isset($data['especialidades']))
				{
						echo "<h2>Metas de los procedimientos de las especialidades</h2>";
						$variable=0;
						foreach ($data['especialidades'] as $key) {
						echo "<h3>".$key->title."</h3>";
						?>
				
	  					<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/IngresoMeta/4/'.$key->id?>">
						<div class="col-xs-12" style="display: inline-block; align-items: center">
							<?php 
							$datos=$data['procedures'];
							$datos = $datos[$variable];
							include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
							$variable ++;
							?>
						</div >
						<div class="col-xs-12" >
							<div class="col-xs-12">
	    						<button class="btn btn-primary navbar-right" type="submit">Ingresar Datos</button>
	    					</div>
						</div>
						<div class="col-xs-12" style="display: inline-block; align-items: center">
							<hr>
						</div>
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