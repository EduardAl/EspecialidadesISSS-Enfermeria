<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   
</head>

    <?php
		//Cargamos el iniciador
		require_once '../app/inicializador.php';
    ?>

    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/estilos.css">
    <script type="js/jquery.js"></script>
    <script type="js/bootstrap.min.js"></script>

    <?php
		//Instanciamos la clase controlador
		$Iniciar = new Core;
	?>
</html>
