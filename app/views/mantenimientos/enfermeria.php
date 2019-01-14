<?php require RUTA_APP.'\views\inc\header.php'; $nNivel='enfermeria';
$bool = (isset($_SESSION['acceso'])&& ($_SESSION['acceso']==1||$_SESSION['acceso']==2)); ?>
<div id="navbar" class="navbar-collapse collapse" style="background: #050D42;">
	<div class="container">
		<ul class="nav navbar-nav barra">
			<li><a id="1"class="mouseHover" onclick="Mostrar_Ocultar(1)">Datos del Nivel</a></li>
			<li><a id="5"class="mouseHover" onclick="Mostrar_Ocultar(5)">Ausentismo</a></li>
			<li><a id="6"class="mouseHover" onclick="Mostrar_Ocultar(6)">Educación</a></li>
			<li><a id="10"class="mouseHover" onclick="Mostrar_Ocultar(10)">Investigación</a></li>
			<li><a id="7"class="mouseHover" onclick="Mostrar_Ocultar(7)">Gestión Administrativa</a></li>
			<li><a id="11"class="mouseHover" onclick="Mostrar_Ocultar(11)">Reuniones</a></li>
		</ul>
	</div>
</div>
<div class = "container" style="min-height: 400px;">
	<div class = "row">
		<div  class="col-xs-<?php echo ($bool)?6:12?>">
			<h1 class="">Departamento de Enfermería</h1>
		</div><?php if($bool) { ?>
			
		<div class="col-xs-6">
			<div class="col-xs-5">
				<div class="form-group" style="padding-top: 22px;">
				    <div class='input-group date' id='admin'>
				        <input type='text' class="form-control" id="adminFecha" style="background: white;"readonly/>
				        <span class="input-group-addon">
			        	    <span class="glyphicon glyphicon-calendar"></span>
			    	    </span>
				    </div>
				</div>
			</div>
		</div><?php }?>

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
				<input class="admin" type="text" name="fecha" hidden>
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
		<div class="col-xs-12" id="ausentismo">
			<div class='col-xs-10'>					
				<h2>Ausentismo del Nivel</h2>
			</div>
			<div class='col-xs-2' style="padding-top: 20px;">					
				<button class="btn btn-primary btn-block" onclick="Mostrar_Ocultar(4);">Configuración</button>
			</div>
			<?php 
				if(isset($data['absences'])){
					$datos=$data['absences'];
					if(count($datos['TítulosY'])>0){
			?>
			<form class="form-formulario" method="POST" action="<?=RUTA_URL.'/Mantenimiento/IngresoAusentismo/'.$nNivel?>">
				<input class="admin" type="text" name="fecha" hidden>
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
		<div class='col-xs-12' id="configAusentismo">
			<div class='col-xs-10'>					
				<h2>Configuración de Ausentismo</h2>
			</div>
			<?php
			if(isset($data['absences_config']))
			{?>
			
			<div class="col-xs-12" style="display: inline-block; align-items: center">
				<br>
			</div>
			<form class="form-formulario" method="POST" action="<?php echo  RUTA_URL . '/Mantenimiento/ConfigurarAusentismo/'.$nNivel?>">
				<input class="admin" type="text" name="fecha" hidden>
				<div class="col-xs-12" style="display: inline-block; align-items: center">
					<?php 
					$datos=$data['absences_config'];
					include RUTA_APP.'\views\mantenimientos\datosNivel.php'; 
					?>
				</div >
				<div class="col-xs-12" >
					<div class="col-xs-12">
						<button class="btn btn-primary navbar-right" type="submit">Ingresar Datos</button>
					</div>
				</div>
			</form>
				<?php
			}
			?>
		</div>
		<div class="col-xs-12" id="educacion">
			<div class='col-xs-10'>					
				<h2>Educación y Charlas</h2>
			</div>
			<div class='col-xs-2' style="padding-top: 20px;">					
				<button id="newE" class="btn btn-primary btn-block" onclick="Mostrar_Ocultar(31);">Nuevo</button>
			</div><?php if($bool){?>
			<div class='col-xs-12'>	
				<hr>
			</div>				
			<div id="filtro" class="col-xs-12" align="right">
				<form method="post" action="<?=RUTA_URL.'/Mantenimiento/RecargarEducacion/'.$nNivel?>">
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Ver por:</label>
					</div>
					<div class="col-xs-3">
						<select name="cbOrdenar" class="form-control" id="dates" >
							<option value="">Realizados y Programados</option>
							<option value="default">Predeterminado*</option>
							<option value="Programada">Programados</option>
							<option value="Realizada">Realizados</option>
						</select>
					</div>
					<div class="col-xs-1">
						<label style="text-align: center; padding-top: 8px;">Desde:</label>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker1'>
						        <input type='text' class="form-control" name="fecha1" id="fecha1" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Hasta:</label>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker2'>
						        <input type='text' class="form-control" name="fecha2" id="fecha2" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-2">
						<button class="btn btn-primary btn-block" type="submit">Actualizar</button>
					</div>
				</form>
			</div>
			<div class='col-xs-12'>					
				<hr>
			</div><?php }?>
			<form class=form-formulario" method="POST" action="<?php echo RUTA_URL.'/Mantenimiento/IngresoCharla/'.$nNivel?>">
				<div class="container" align="center" id="hide">
						<div class="col-xs-3"></div>
							<div class="col-xs-6" style="align: center;">
						        <h2 class="text-center">Registro</h2>
						        <div class="row text-center">
						        	<label for="inputFName" class="text-center">Descripción:</label>
						        </div>
						        <input type="name" name="fname" id="inputFName" height="30px" class="form-control" placeholder="Descripción" required>
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
						       <select name="tipo" class="form-control" required>
						       		<?php
						       			if(isset($data['health']['TítulosY']))
							       		foreach ($data['health']['TítulosY'] as $key) {
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
					    <div class='col-xs-12'>					
							<hr>
						</div>
					</div>
			</form>
			<?php
				if(isset($data['education']))
				{
					$extra=RUTA_URL.'/Mantenimiento/ActualizarDatos'; 
					$datos=$data['education'];
					include RUTA_APP.'\views\reportes\tablaShow.php'; 
				}
			?>
		</div>
		<div class="col-xs-12" id="investigacion">
			<div class='col-xs-10'>					
				<h2>Investigación Enfermería</h2>
			</div>
			<div class='col-xs-2' style="padding-top: 20px;">					
				<button id="newE" class="btn btn-primary btn-block" onclick="Mostrar_Ocultar(41);">Nuevo</button>
			</div><?php if($bool){?>
			<div class='col-xs-12'>	
				<hr>
			</div>				
			<div id="filtro" class="col-xs-12" align="right">
				<form method="post" action="<?=RUTA_URL.'/Mantenimiento/Recargarinvestigacion/'.$nNivel?>">
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Ver por:</label>
					</div>
					<div class="col-xs-3">
						<select name="cbOrdenar" class="form-control" id="dates2" >
							<option value="">Realizados y Programados</option>
							<option value="default">Predeterminado*</option>
							<option value="Programada">Programados</option>
							<option value="Realizada">Realizados</option>
						</select>
					</div>
					<div class="col-xs-1">
						<label style="text-align: center; padding-top: 8px;">Desde:</label>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker3'>
						        <input type='text' class="form-control" name="fecha1" id="fecha3" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Hasta:</label>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker4'>
						        <input type='text' class="form-control" name="fecha2" id="fecha4" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-2">
						<button class="btn btn-primary btn-block" type="submit">Actualizar</button>
					</div>
				</form>
			</div>
			<div class='col-xs-12'>					
				<hr>
			</div><?php }?>
			<form class=form-formulario" method="POST" action="<?php echo RUTA_URL.'/Mantenimiento/IngresoInvestigacion/'.$nNivel?>">
				<div class="container" align="center" id="hide2">
						<div class="col-xs-3"></div>
							<div class="col-xs-6" style="align: center;">
						        <h2 class="text-center">Registro</h2>
						        <div class="row text-center">
						        	<label for="inputFName" class="text-center">Nombre:</label>
						        </div>
						        <input type="name" name="fname" id="inputFName" class="form-control" placeholder="Nombre" required>
						        <br>
						        <div class="row text-center">
						        	<label for="inputFName" class="text-center">Descripción:</label>
						        </div>
						        <input type="name" name="description" id="inputDescription" class="form-control" placeholder="Descripción" required>
						        <br>
						        <div class="row text-center">
						        	<label for="inputFDate" class="text-center">Fecha:</label>
						        </div>
								<div class="form-group">
					                <div class='input-group date' id='fechaCh2'>
					                    <input type='text' class="form-control" name="fechaC" id="fechaC2" required/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
						        <div class="row text-center">
						        	<label for="estado" class="">Estado:</label>
						        </div>
						       <select name="estado" class="form-control" required>
					       			<option value="Programada">Programada</option>;
					       			<option value="Realizada">Realizada</option>;
								</select>
						        <br>
						        <button class="btn btn-lg btn-primary" type="submit">Entrar</button><br>
						        <?php if(isset($datos['error_message'])) { echo "<span class=estiloError; style='color:red;'>".$datos['error_message']."</span>";
						    	}?>
					     	</div>
					    <div class="col-xs-3"></div>
					    <div class='col-xs-12'>					
							<hr>
						</div>
					</div>
			</form>
			<?php
				if(isset($data['investigacion']))
				{
					$extra=RUTA_URL.'/Mantenimiento/ActualizarInvestigacion'; 
					$datos=$data['investigacion'];
					include RUTA_APP.'\views\reportes\tablaShow.php'; 
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
				<input class="admin" type="text" name="fecha" hidden>
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
		<div class="col-xs-12" id="reuniones">
			<div class='col-xs-10'>					
				<h2>Reuniones Administrativas</h2>
			</div>
			<div class='col-xs-2' style="padding-top: 20px;">					
				<button id="newE" class="btn btn-primary btn-block" onclick="Mostrar_Ocultar(61);">Nuevo</button>
			</div><?php if($bool){?>
			<div class='col-xs-12'>	
				<hr>
			</div>				
			<div id="filtro" class="col-xs-12" align="right">
				<form method="post" action="<?=RUTA_URL.'/Mantenimiento/RecargarReuniones/'.$nNivel?>">
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Ver por:</label>
					</div>
					<div class="col-xs-3">
						<select name="cbOrdenar" class="form-control" id="dates3" >
							<option value="">Todos</option>
							<option value="default">Predeterminado*</option>
							<option value="Programada">Programados</option>
							<option value="Realizada">Realizados</option>
							<option value="Perdida">Perdidos</option>
						</select>
					</div>
					<div class="col-xs-1">
						<label style="text-align: center; padding-top: 8px;">Desde:</label>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker5'>
						        <input type='text' class="form-control" name="fecha1" id="fecha5" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-1">
						<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Hasta:</label>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
						    <div class='input-group date' id='datetimepicker6'>
						        <input type='text' class="form-control" name="fecha2" id="fecha6" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
					</div>
					<div class="col-xs-2">
						<button class="btn btn-primary btn-block" type="submit">Actualizar</button>
					</div>
				</form>
			</div>
			<div class='col-xs-12'>					
				<hr>
			</div><?php }?>
			<form class=form-formulario" method="POST" action="<?php echo RUTA_URL.'/Mantenimiento/IngresoReunion/'.$nNivel?>">
				<div class="container" align="center" id="hide3">
						<div class="col-xs-3"></div>
							<div class="col-xs-6" style="align: center;">
						        <h2 class="text-center">Registro</h2>
						        <div class="row text-center">
						        	<label for="inputFName" class="text-center">Nombre:</label>
						        </div>
						        <input type="name" name="fname" id="inputFName" class="form-control" placeholder="Nombre" required>
						        <br>
						        <div class="row text-center">
						        	<label for="inputFName" class="text-center">Descripción:</label>
						        </div>
						        <input type="name" name="description" id="inputDescription" class="form-control" placeholder="Descripción" required>
						        <br>
						        <div class="row text-center">
						        	<label for="inputFDate" class="text-center">Fecha:</label>
						        </div>
								<div class="form-group">
					                <div class='input-group date' id='fechaCh3'>
					                    <input type='text' class="form-control" name="fechaC" id="fechaC3" required/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					                </div>
					            </div>
						        <div class="row text-center">
						        	<label for="estado" class="">Estado:</label>
						        </div>
						       <select name="estado" class="form-control" required>
					       			<option value="Programada">Programada</option>;
					       			<option value="Realizada">Realizada</option>;
					       			<option value="Perdida">Perdida</option>;
								</select>
						        <br>
						        <button class="btn btn-lg btn-primary" type="submit">Entrar</button><br>
						        <?php if(isset($datos['error_message'])) { echo "<span class=estiloError; style='color:red;'>".$datos['error_message']."</span>";
						    	}?>
					     	</div>
					    <div class="col-xs-3"></div>
					    <div class='col-xs-12'>					
							<hr>
						</div>
					</div>
			</form>
			<?php
				if(isset($data['reunion']))
				{
					$extra=RUTA_URL.'/Mantenimiento/ActualizarReunion'; 
					$datos=$data['reunion'];
					include RUTA_APP.'\views\reportes\tablaShow.php'; 
				}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	var hidden=true;
	var hidden2=true;
	var hidden3=true;
	window.onload = function(){
		Mostrar_Ocultar(<?php if(isset($data['cargado'])){echo $data['cargado'];}else echo 1;?>);
		var val = new Date();
		$('#hide').hide();
		$('#hide2').hide();
		$('#hide3').hide();
		<?php if($bool){?>

		$('.admin').val($("#adminFecha").val());<?php
		if(isset($_SESSION['fecha']))
		{
			$tempo =$_SESSION['fecha'];
			unset($_SESSION['fecha']);?>

		$("#dates").val("<?php echo $tempo['tipo'];?>");
		$("#fecha1").val("<?php echo $tempo['fecha1'];?>");
		$("#fecha2").val("<?php echo $tempo['fecha2'];?>");<?php
		}
		else{?>

		$("#dates").val("default");
    	$('#datetimepicker1').children().attr('disabled','disabled');
    	$('#datetimepicker2').children().attr('disabled','disabled');
		$("#fecha1").val("<?php echo date('Y/m/d')?>");
		$("#fecha2").val("<?php echo date('Y/m/d')?>");<?php
		}
		if(isset($_SESSION['fecha2']))
		{
			$tempo =$_SESSION['fecha2'];
			unset($_SESSION['fecha2']);?>

		$("#dates2").val("<?php echo $tempo['tipo'];?>");
		$("#fecha3").val("<?php echo $tempo['fecha1'];?>");
		$("#fecha4").val("<?php echo $tempo['fecha2'];?>");<?php
		}
		else{?>

		$("#dates2").val("default");
    	$('#datetimepicker3').children().attr('disabled','disabled');
    	$('#datetimepicker4').children().attr('disabled','disabled');
		$("#fecha3").val("<?php echo date('Y/m/d')?>");
		$("#fecha4").val("<?php echo date('Y/m/d')?>");<?php
		}
		if(isset($_SESSION['fecha3']))
		{
			$tempo =$_SESSION['fecha3'];
			unset($_SESSION['fecha3']);?>

		$("#dates3").val("<?php echo $tempo['tipo'];?>");
		$("#fecha5").val("<?php echo $tempo['fecha1'];?>");
		$("#fecha6").val("<?php echo $tempo['fecha2'];?>");<?php
		}
		else{?>

		$("#dates3").val("default");
    	$('#datetimepicker5').children().attr('disabled','disabled');
    	$('#datetimepicker6').children().attr('disabled','disabled');
		$("#fecha5").val("<?php echo date('Y/m/d')?>");
		$("#fecha6").val("<?php echo date('Y/m/d')?>");<?php
		}}?>
	}
	function Mostrar_Ocultar(num){

		$("#1").css("background-color","transparent");
		$("#1").css("color","white");
		$("#5").css("background-color","transparent");
		$("#5").css("color","white");
		$("#6").css("background-color","transparent");
		$("#6").css("color","white");
		$("#7").css("background-color","transparent");
		$("#7").css("color","white");
		$("#10").css("background-color","transparent");
		$("#10").css("color","white");
		$("#11").css("background-color","transparent");
		$("#11").css("color","white");

		$("#"+num).css("background-color","#E8E8EC");
		$("#"+num).css("color","black");

		if(num==1)
		{
			$('#datosNivel').show('fast');
			$('#datosEspecialidades').hide();
			$('#procedimientosEspecialidades').hide();
			$('#metasEspecialidades').hide();
			$('#ausentismo').hide();
			$('#configAusentismo').hide();
			$('#educacion').hide();
			$('#metasEducacion').hide();
			$('#administrativa').hide();
			$('#investigacion').hide();
			$('#reuniones').hide();
		}
		else if(num==5)
		{
			$('#ausentismo').show('fast');
			$('#configAusentismo').hide();
			$('#procedimientosEspecialidades').hide();
			$('#datosNivel').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#educacion').hide();
			$('#metasEducacion').hide();
			$('#administrativa').hide();
			$('#investigacion').hide();
			$('#reuniones').hide();
		}
		else if(num==21){
			$("#5").css("background-color","#E8E8EC");
			$("#5").css("color","black");
			$('#configAusentismo').hide('slow');
			$('#ausentismo').show('slow');
		}
		else if(num==6)
		{
			$('#educacion').show('fast');
			$('#metasEducacion').hide();
			$('#procedimientosEspecialidades').hide();
			$('#datosNivel').hide();
			$('#ausentismo').hide();
			$('#configAusentismo').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#administrativa').hide();
			$('#investigacion').hide();
			$('#reuniones').hide();
		}
		else if(num==31)
		{
			$("#6").css("background-color","#E8E8EC");
			$("#6").css("color","black");
			if(hidden){
				$('#hide').show('slow');
				hidden=false;
			}
			else{
				$('#hide').hide('slow');
				hidden=true;
			}
		}
		else if(num==10)
		{
			$('#investigacion').show('fast');
			$('#metasEducacion').hide();
			$('#procedimientosEspecialidades').hide();
			$('#datosNivel').hide();
			$('#ausentismo').hide();
			$('#configAusentismo').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#educacion').hide();
			$('#administrativa').hide();
			$('#reuniones').hide();
		}
		else if(num==41)
		{
			$("#10").css("background-color","#E8E8EC");
			$("#10").css("color","black");
			if(hidden2){
				$('#hide2').show('slow');
				hidden2=false;
			}
			else{
				$('#hide2').hide('slow');
				hidden2=true;
			}
		}
		else if(num==7)
		{
			$('#administrativa').show('fast');
			$('#procedimientosEspecialidades').hide();
			$('#datosNivel').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#ausentismo').hide();
			$('#configAusentismo').hide();
			$('#educacion').hide();
			$('#metasEducacion').hide();
			$('#investigacion').hide();
			$('#reuniones').hide();
		}
		else if(num==11)
		{
			$('#reuniones').show('fast');
			$('#metasEducacion').hide();
			$('#procedimientosEspecialidades').hide();
			$('#datosNivel').hide();
			$('#ausentismo').hide();
			$('#configAusentismo').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#educacion').hide();
			$('#administrativa').hide();
			$('#investigacion').hide();
		}
		else if(num==61)
		{
			$("#11").css("background-color","#E8E8EC");
			$("#11").css("color","black");
			if(hidden3){
				$('#hide3').show('slow');
				hidden3=false;
			}
			else{
				$('#hide3').hide('slow');
				hidden3=true;
			}
		}
		else if(num==4)
		{
			$("#5").css("background-color","#E8E8EC");
			$("#5").css("color","black");
			$('#ausentismo').hide('slow');
			$('#configAusentismo').show('slow');
		}
	}
	$(function () {
        $('#datetimepicker1').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#datetimepicker2').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#datetimepicker3').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#datetimepicker4').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#datetimepicker5').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#datetimepicker6').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#fechaCh').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
            defaultDate: new Date()
        });
        $('#fechaCh2').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
            defaultDate: new Date()
        });
        $('#fechaCh3').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
            defaultDate: new Date()
        });<?php if($bool) { ?>

		$('#admin').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
            ignoreReadonly:true,
            defaultDate:new Date(),
        });

        $("#dates").change(function(){
		    if($(this).val()!="default"){
		    	$('#datetimepicker1').children().attr('disabled',false);
		    	$('#datetimepicker2').children().attr('disabled',false);
		    }
		    else{
		    	$('#datetimepicker1').children().attr('disabled','disabled');
		    	$('#datetimepicker2').children().attr('disabled','disabled');
		    }
		});
        $("#dates2").change(function(){
		    if($(this).val()!="default"){
		    	$('#datetimepicker3').children().attr('disabled',false);
		    	$('#datetimepicker4').children().attr('disabled',false);
		    }
		    else{
		    	$('#datetimepicker3').children().attr('disabled','disabled');
		    	$('#datetimepicker4').children().attr('disabled','disabled');
		    }
		});
        $("#dates3").change(function(){
		    if($(this).val()!="default"){
		    	$('#datetimepicker5').children().attr('disabled',false);
		    	$('#datetimepicker6').children().attr('disabled',false);
		    }
		    else{
		    	$('#datetimepicker5').children().attr('disabled','disabled');
		    	$('#datetimepicker6').children().attr('disabled','disabled');
		    }
		});
        $("#admin").on("dp.change", function (e) {
        $('.admin').val(e.date.format('YYYY/MM/DD'));
        });<?php
			}       
        ?>

        $("#datetimepicker1").on("dp.change", function (e) {
            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker2").on("dp.change", function (e) {
            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });
        $("#datetimepicker3").on("dp.change", function (e) {
            $('#datetimepicker4').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker4").on("dp.change", function (e) {
            $('#datetimepicker3').data("DateTimePicker").maxDate(e.date);
        });
        $("#datetimepicker5").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker5').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>