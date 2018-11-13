<?php require RUTA_APP.'\views\inc\header.php'; ?> 
<div class="container">
    <h1>Haga click la opcion que desea</h1>
    <a href="<?php echo(RUTA_URL)?>/controlador_cardiologia/reporte_diario">Reporte Diario</a>
    <br>
    <a href="<?php echo(RUTA_URL)?>/controlador_cardiologia/reporte_rango">Reporte entre dos fechas</a>
    <br>
    <a href="<?php echo(RUTA_URL)?>/controlador_cardiologia/reporte_mensual">Reporte mensual</a>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>