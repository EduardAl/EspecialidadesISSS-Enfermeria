<?php require RUTA_APP.'\views\inc\header.php'; ?> 

<div class="container">
    <h1>Reporte entre peiodo de tiempo Urologia</h1>
    <h1>Reporte entre dos fechas</h1>
    <h2>Seleccione el rango de fechas a buscar</h2>
    <form action="<?php echo(RUTA_URL); ?>/controlador_urologia/reporte_rango" method="post"> 
        <label for="fecha_1">Fecha comienzo: </label>
        <input type="date" name="fecha_1" min="2018-01-01" max="2030-12-31">
        <br>
        <label for="fecha_2">Fecha fin: </label>
        <input type="date" name="fecha_2" min="2018-01-01" max="2030-12-31">
        <br>
        <input type="submit">
    </form>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?> 