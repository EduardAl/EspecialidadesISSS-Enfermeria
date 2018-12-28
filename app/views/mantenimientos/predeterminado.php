<?php if(!isset($lNivel))$lNivel="Cuarto Nivel";if(!isset($nNivel))$nNivel="4";?>
<div id="navbar" class="navbar-collapse collapse" style="background: #050D42;">
	<div class="container">
		<ul class="nav navbar-nav barra">
			<li><a id="1"class="mouseHover" onclick="Mostrar_Ocultar(1)">Datos del Nivel</a></li>
			<li><a id="5"class="mouseHover" onclick="Mostrar_Ocultar(5)">Ausentismo</a></li>
			<li><a id="2"class="mouseHover" onclick="Mostrar_Ocultar(2)">Datos Especialidades</a></li>
			<li><a id="3"class="mouseHover" onclick="Mostrar_Ocultar(3)">Procedimientos de Especialidades</a></li>
			<li><a id="6"class="mouseHover" onclick="Mostrar_Ocultar(6)">Educación en Salud</a></li>
			<li><a id="7"class="mouseHover" onclick="Mostrar_Ocultar(7)">Gestión Administrativa</a></li>
		</ul>
	</div>
</div>
<div class = "container" style="min-height: 500px;">
	<div class = "row">
		<div  class="col-xs-12">
			<h1 class=""><?php echo $lNivel?></h1>
		</div>
		<!-- Procedimientos Mes -->
		<div class="col-xs-12" id="datosNivel">
			<div>
				<h2>Datos de nivel</h2>
			</div>
			<?php 
				$data = $datos;
				if(isset($data['levelThings'])){
					$datos=$data['levelThings'];
					if(count($datos['TítulosY'])>0){
			?>
			<form class="form-formulario" method="POST" action="<?=RUTA_URL.'/Mantenimiento/IngresoNivel/'.$nNivel?>">
				<div class="col-xs-12" style="display: inline-block; align-items: center">
			<?php include RUTA_APP.'\views\mantenimientos\datosNivel.php'; ?>
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
			<?php 
					}
				}
			?>
		</div>
		<div class='col-xs-12' id="datosEspecialidades">
			<div>					
				<h2>Datos de las especialidades</h2>
			</div>
			<?php
				if(isset($data['especialidades']))
				{
					if(count(($data['specialty'])['TítulosY'])>0){
					foreach ($data['especialidades'] as $key) {
					echo "<div class='col-xs-12'><h3>".$key->title."</h3></div>";
			?>
			<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/IngresoEspecialidad/'.$nNivel.'/'.$key->id?>">
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
			}
			?>
		</div>
		<div class='col-xs-12' id="procedimientosEspecialidades">
			<div class='col-xs-10'>					
				<h2>Procedimientos de las especialidades</h2>
			</div>
			<div class='col-xs-2' style="padding-top: 20px;">					
				<button class="btn btn-primary btn-block" onclick="Mostrar_Ocultar(4);">Metas</button>
			</div>
			<?php
			if(isset($data['especialidades']))
			{
				$variable=0;
				foreach ($data['especialidades'] as $key) {
					if(count(($data['procedures'])[$variable]['TítulosY'])>0){
						echo "<div class='col-xs-12'><h3>".$key->title."</h3></div>";
			?>
				<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/IngresoProcedimiento/'.$nNivel.'/'.$key->id?>">
					<div class="col-xs-12" style="display: inline-block; align-items: center">
						<?php 
						$datos=$data['procedures'];
						$datos = $datos[$variable];
						include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
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
					$variable ++;
				}
			}
			?>
		</div>
		<div class='col-xs-12' id="metasEspecialidades">
			<div class='col-xs-10'>					
				<h2>Metas de los procedimientos de las especialidades</h2>
			</div>
			<div class='col-xs-2' style="padding-top: 20px;">					
				<button class="btn btn-primary btn-block" onclick="Mostrar_Ocultar(31);">Procedimientos</button>
			</div>
			<?php
			if(isset($data['especialidades']))
			{
				$variable=0;
				foreach ($data['especialidades'] as $key) {
					if(count(($data['procedures'])[$variable]['TítulosY'])>0){
					echo "<div class='col-xs-12'><h3>".$key->title."</h3></div>";
					?>
			
			<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/IngresoMeta/'.$nNivel.'/'.$key->id?>">
				<div class="col-xs-12" style="display: inline-block; align-items: center">
					<?php 
					$datos=$data['procedures'];
					$datos = $datos[$variable];
					include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
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
					$variable ++;
				}
			}
			?>
		</div>
		<div class="col-xs-12" id="ausentismo">
			<div>
				<h2>Ausentismo del Nivel</h2>
			</div>
			<?php 
				if(isset($data['absences'])){
					$datos=$data['absences'];
					if(count($datos['TítulosY'])>0){
			?>
			<form class="form-formulario" method="POST" action="<?=RUTA_URL.'/Mantenimiento/IngresoAusentismo/'.$nNivel?>">
				<div class="col-xs-12" style="display: inline-block; align-items: center">
			<?php include RUTA_APP.'\views\mantenimientos\datosNivel.php'; ?>
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
			<?php 
					}
				}
			?>
		</div>
		<div class="col-xs-12" id="educacion">
			<div class='col-xs-10'>					
				<h2>Educación en Salud</h2>
			</div>
			<div class='col-xs-2' style="padding-top: 20px;">					
				<button class="btn btn-primary btn-block" onclick="Mostrar_Ocultar(4);">Nuevo</button>
			</div>
			<?php 
				if(isset($data['education'])){
					$datos=$data['education'];
					if(count($datos['TítulosY'])>0){
			?>
			<form class="form-formulario" method="POST" action="<?=RUTA_URL.'/Mantenimiento/ActualizarEducacion/'.$nNivel?>">
				<div class="col-xs-12" style="display: inline-block; align-items: center">
			<?php include RUTA_APP.'\views\mantenimientos\datosNivel.php'; ?>
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
			<?php 
					}
				}
			?>
		</div>
		<div class="col-xs-12" id="administrativa">
			<div>
				<h2>Gestión Administrativa</h2>
			</div>
			<?php 
				if(isset($data['admin'])){
					$datos=$data['admin'];
					if(count($datos['TítulosY'])>0){
			?>
			<form class="form-formulario" method="POST" action="<?=RUTA_URL.'/Mantenimiento/IngresoAdministrativo/'.$nNivel?>">
				<div class="col-xs-12" style="display: inline-block; align-items: center">
			<?php include RUTA_APP.'\views\mantenimientos\datosNivel.php'; ?>
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
			<?php 
					}
				}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function(){
		Mostrar_Ocultar(<?php if(isset($datos['cargado']))echo $datos['cargado'];else echo 1;?>);
	}
	function Mostrar_Ocultar(num){

		$("#1").css("background-color","transparent");
		$("#1").css("color","white");
		$("#2").css("background-color","transparent");
		$("#2").css("color","white");
		$("#3").css("background-color","transparent");
		$("#3").css("color","white");
		$("#5").css("background-color","transparent");
		$("#5").css("color","white");
		$("#6").css("background-color","transparent");
		$("#6").css("color","white");
		$("#7").css("background-color","transparent");
		$("#7").css("color","white");

		$("#"+num).css("background-color","#E8E8EC");
		$("#"+num).css("color","black");
		if(num==1)
		{
			$('#datosNivel').show('fast');
			$('#datosEspecialidades').hide();
			$('#procedimientosEspecialidades').hide();
			$('#metasEspecialidades').hide();
			$('#ausentismo').hide();
			$('#educacion').hide();
			$('#administrativa').hide();
		}
		else if(num==2)
		{
			$('#datosEspecialidades').show('fast');
			$('#datosNivel').hide();
			$('#procedimientosEspecialidades').hide();
			$('#metasEspecialidades').hide();
			$('#ausentismo').hide();
			$('#educacion').hide();
			$('#administrativa').hide();
		}
		else if(num==3)
		{
			$('#datosNivel').hide();
			$('#datosEspecialidades').hide();
			$('#metasEspecialidades').hide('slow');
			$('#ausentismo').hide();
			$('#procedimientosEspecialidades').show('fast');
			$('#educacion').hide();
			$('#administrativa').hide();
		}
		else if(num==31)
		{
			$("#3").css("background-color","#E8E8EC");
			$("#3").css("color","black");
			$('#metasEspecialidades').hide('slow');
			$('#procedimientosEspecialidades').show('slow');
			$('#educacion').hide();
			$('#administrativa').hide();
		}
		else if(num==4)
		{
			$("#3").css("background-color","#E8E8EC");
			$("#3").css("color","black");
			$('#procedimientosEspecialidades').hide('slow');
			$('#datosNivel').hide('slow');
			$('#datosEspecialidades').hide('slow');
			$('#ausentismo').hide('slow');
			$('#metasEspecialidades').show('fast');
			$('#educacion').hide();
			$('#administrativa').hide();
		}
		else if(num==5)
		{
			$('#ausentismo').show('fast');
			$('#procedimientosEspecialidades').hide();
			$('#datosNivel').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#educacion').hide();
			$('#administrativa').hide();
		}
		else if(num==6)
		{
			$('#educacion').show('fast');
			$('#procedimientosEspecialidades').hide();
			$('#datosNivel').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#administrativa').hide();
		}
		else if(num==7)
		{
			$('#administrativa').show('fast');
			$('#procedimientosEspecialidades').hide();
			$('#datosNivel').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#ausentismo').hide();
			$('#educacion').hide();
		}
	}
</script>