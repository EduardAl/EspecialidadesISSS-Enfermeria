<?php require RUTA_APP.'\views\inc\header.php';$data=$datos; $id=0; $bool=false;?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Administración</h1>
		</div>
		<br><br><br><br>
		<div id="ocultar">
			<div class="col-xs-4">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/Administración.jpg">
					<div class="caption">
						<h3>Administración</h3>
						<a  onclick="Mostrar_Ocultar(1)"> Ingresar datos </a>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class=thumbnail>
					<img src="<?php echo RUTA_URL?>/images/administracion-empres-uw.jpg">
					<div class="caption">
						<h3>Gráficas</h3>
						<a href="<?php echo RUTA_URL?>/Nivel/Graficas"> Ver tablas y estadísticas </a>
					</div>
				</div>
			</div>
		</div>
		<div id="management" hidden>
			<div class="col-xs-12" id="datos">
				<?php 
					if(isset($data['admin'])){
						$datos=$data['admin'];
						if(count($datos['TítulosY'])>0){
				?>
				<form class="form-formulario" method="POST" action="<?=RUTA_URL.'/Nivel/IngresoAdministrativo/'?>">
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
			<div class="col-xs-12" id="metas">
				
			</div>
		</div>
	</div>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>

<script type="text/javascript">
	var hidden=true;
	window.onload = function(){
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
	function Mostrar_Ocultar(num){
		if(num==1){
			$('#ocultar').hide();
			$('#management').show();
		}
	}
</script>