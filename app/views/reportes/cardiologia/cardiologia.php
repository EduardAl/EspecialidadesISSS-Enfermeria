<?php require RUTA_APP.'\views\inc\header.php'; ?> 

<div class="container">
<table class="table table-dark">
    <?php
    $var = json_encode($datos['info']);
    ?>
    <script type="text/javascript"> var infojson = "<?= $var ?>";?</script>
</table>
<div id="muestra"></div>
<div id="piechart"></div>
</div>
<?php require RUTA_APP.'\views\inc\footer.php'; ?> 