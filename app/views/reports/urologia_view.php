<?php 
    require_once RUTA_APP.'/views/inc/header.php';
    require_once RUTA_APP."/koolreport/autoload.php";
    
?>
<div class="container"> 
    <form method="post" action="" id="form_1">
        <label for="r1">Informacicon por dia</label>
        <label for="r2">Informacion por semana</label>
        <label for="r3">Informacion por mes</label>
        <label for="r4">Informacion por trimestre</label>
        <label for="r5">Informacion por semestre</label>
        <input type="radio" name="opcion" id="r1" value="1">
        <input type="radio" name="opcion" id="r2" value="2">
        <input type="radio" name="opcion" id="r3" value="3">
        <input type="radio" name="opcion" id="r4" value="4">
        <input type="radio" name="opcion" id="r5" value="5">
        <input type="submit" value="elegir opcion" id="boton-submit">
        <?php
        Table::create(array(
            "dataStore"=>$this->dataStore("urologia")
        ));
        ?>
        ?>
    </form>
</div>
<div id="opcion-1">
    
</div>
<?php require_once RUTA_APP.'/views/inc/footer.php'?>