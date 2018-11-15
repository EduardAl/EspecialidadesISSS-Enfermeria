<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        //Cargamos el iniciador
        require_once '../app/inicializador.php';
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script type="js/bootstrap.min.js"></script>    
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/bootstrap-theme.min.css"> 
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/estilos.css">
    <script src="text/javascript" src="<?php echo RUTA_URL?>/js/loader.js"></script>
    <script src="<?php echo RUTA_URL?>/js/bootstrap.min.js"></script>
</head>
    <body>
    <?php
		//Instanciamos la clase controlador
		$Iniciar = new Core;
	?>
    <script type="js/jquery.js"></script>
    <script type="<?php echo RUTA_URL?>/js/jquery.js"></script>
    </body>
</html>
