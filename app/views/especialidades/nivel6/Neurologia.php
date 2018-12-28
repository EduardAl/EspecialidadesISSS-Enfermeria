<?php require RUTA_APP.'\views\inc\header.php'; ?>
<div class = "container">
	<div class = "row">
		<div class="col-xs-8">
			<h1>Neurología</h1>
			<h4><?php if(isset($datos['fechaT']))echo$datos['fechaT'];else echo"Mes Actual";?></h4>
		</div>

		<div class="col-xs-4">
			<ul class="nav navbar-nav navbar-right">
				<li><a class="mouseHover" onclick="find('#pacientes');">Pacientes</a></li>
			</ul>
		</div>

		<br><br><br><br><br>
		<div class="col-xs-12" style="display: inline-block; align-items: center">
			<hr>
		</div>
		<div id="filtro" class="col-xs-12" align="right">
			<form method="post" action="<?php echo  RUTA_URL . '/Nivel/Especialidad/6/Neurologia'?>">
				<div class="col-xs-1">
					<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Ver por:</label>
				</div>
				<div class="col-xs-2">
					<select name="cbOrdenar" class="form-control" id="dates" >
						<option value="Month">Mes</option>
						<option value="Year">Año</option>
						<option value="Per">Personalizado</option>
					</select>
				</div>
				<div class="col-xs-1">
					<label for="cbOrdenar" style="text-align: center; padding-top: 8px;">Desde:</label>
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
		<br><br>
		<div id="pacientes" class="col-xs-12" style="display: inline-block; align-items: center">
			<hr>
		</div>
		<br><br>
		<!-- Procedimientos Mes -->
		<div  class="col-xs-12" id="pacientes">
			<div class="col-xs-12" >
				<h3>Pacientes</h3>
			</div>
			<div class="col-xs-12" style="overflow: auto; max-height: 400px;">
				<?php $data=$datos;$datos=$data['datos2']; $id=1;
				include RUTA_APP.'\views\reportes\tablaShow.php'; ?>
			</div>
			<div class="col-xs-12">
				<div class=thumbnail style="align-items: center; overflow: auto; overflow-y: hidden; ">
					<?php include RUTA_APP.'\views\reportes\pieChart.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function(){
			$('#datosEspecialidades').hide();
			$('#procedimientosEspecialidades').hide();
			<?php
			if(isset($data['tiempo']))
			{
				$tempo =$data['tiempo'];
			?>
			$("#dates").val("<?php echo $tempo['tipo']?>");
			$("#fecha1").val("<?php echo $tempo['fecha1']?>");
			$("#fecha2").val("<?php echo $tempo['fecha2']?>");
			<?php
			}
			?>
			if($("#dates").val()!="Per"){
		    	$('#datetimepicker1').children().prop('disabled',true);
		    	$('#datetimepicker2').children().prop('disabled',true);
	    	}
		}
	$("#dates").change(function(){
	    if($(this).val()=="Per"){
	    	$('#datetimepicker1').children().attr('disabled',false);
	    	$('#datetimepicker2').children().attr('disabled',false);
	    }
	    else{
	    	$('#datetimepicker1').children().attr('disabled','disabled');
	    	$('#datetimepicker2').children().attr('disabled','disabled');
	    }
	});

	$(function () {
        $('#datetimepicker1').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $('#datetimepicker2').datetimepicker({
            locale:'es',
            format: 'YYYY/MM/DD',
        });
        $("#datetimepicker1").on("dp.change", function (e) {
            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker2").on("dp.change", function (e) {
            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });
    });

    function find(encontrar){
    	$("html, body").animate({ scrollTop: $(encontrar).offset().top }, 500);
    }
</script>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>