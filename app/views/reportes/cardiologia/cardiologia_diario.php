<?php require RUTA_APP.'\views\inc\header.php'; ?> 

<div class="container">
    <h1>Reporte Diario Cardiologia</h1>
    <h2>Selecione la fecha del reporte que desea</h2>
    <form action="<?php echo(RUTA_URL)?>/controlador_cardiologia/reporte_diario" method="post"> 
        <label for="fecha">Fecha comienzo: </label>
        <input type="date" name="fecha" min="2018-01-01" max="2030-12-31">
        <input type="submit">
    </form>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?> 