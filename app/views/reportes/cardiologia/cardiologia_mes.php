<?php require RUTA_APP.'\views\inc\header.php'; ?> 

<div class="container">
    <h1>Reporte Mensual de Cardiologia<h2>
    <h2>Seleccione el mes de fechas a buscar</h2>
    <form action="<?php echo(RUTA_URL); ?>/controlador_cardiologia/reporte_mensual" method="post"> 
        <label for="mes"></label>
        <select name="mes">
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Septiembre</option>
            <option value="10">Otubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>
        <input type="submit">
    </form>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?>