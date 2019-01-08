<?php if(!isset($lNivel))$lNivel="Cuarto Nivel";if(!isset($nNivel))$nNivel="4";
$bool = (isset($_SESSION['acceso'])&& ($_SESSION['acceso']==1||$_SESSION['acceso']==2)); ?>
<div id="navbar" class="navbar-collapse collapse" style="background: #050D42;">
	<div class="container">
		<ul class="nav navbar-nav barra">
			<li><a id="1"class="mouseHover" onclick="Mostrar_Ocultar(1)">Datos del Nivel</a></li>
			<li><a id="5"class="mouseHover" onclick="Mostrar_Ocultar(5)">Ausentismo</a></li>
			<li><a id="2"class="mouseHover" onclick="Mostrar_Ocultar(2)">Datos Especialidades</a></li>
			<li><a id="3"class="mouseHover" onclick="Mostrar_Ocultar(3)">Procedimientos de Especialidades</a></li>
			<li><a id="6"class="mouseHover" onclick="Mostrar_Ocultar(6)">Educación y Charlas</a></li>
			<li><a id="7"class="mouseHover" onclick="Mostrar_Ocultar(7)">Gestión Administrativa</a></li>
		</ul>
	</div>
</div>
<div class = "container" style="min-height: 500px;">
	<div class = "row">
		<div  class="col-xs-<?php echo ($bool)?3:12?>">
			<h1 class=""><?php echo $lNivel?></h1>
		</div><?php if($bool) { ?>
			
		<div class="col-xs-9">
			<div class="col-xs-4">
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
				<input class="admin" type="text" name="fecha" hidden>
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
					<input class="admin" type="text" name="fecha" hidden>
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
				<input class="admin" type="text" name="fecha" hidden>
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
		<div class="col-xs-12" id="educacion">
			<div class='col-xs-10'>					
				<h2>Educación y Charlas</h2>
			</div>
			<div class='col-xs-2' style="padding-top: 20px;">					
				<button id="newE" class="btn btn-primary btn-block" onclick="Mostrar_Ocultar(61);">Nuevo</button>
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
						       			if(isset($data['health']))
							       		foreach ($data['health'] as $key) {
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
	</div>
</div>
<script type="text/javascript">
	var hidden=true;
	window.onload = function(){
		Mostrar_Ocultar(<?php if(isset($data['cargado'])){echo $data['cargado'];}else echo 1;?>);
		var val = new Date();
		$('#hide').hide();
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
		}}?>
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
			$('#ausentismo').hide();
			$('#metasEspecialidades').hide();
			$('#datosEspecialidades').hide();
			$('#administrativa').hide();
		}
		else if(num==61)
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
	$(function () {
        $('#datetimepicker1').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#datetimepicker2').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#fechaCh').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
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
    });
</script>