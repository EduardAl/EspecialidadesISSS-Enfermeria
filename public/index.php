<!DOCTYPE html>
<html lang="es">
<head>
<?php require_once '../app/inicializador.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="height=device-height width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo NOMBRESITIO;?></title>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/estilos.css">
    <script type="text/javascript" src="<?php echo RUTA_URL?>/js/loader.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_URL?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_URL?>/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/bootstrap-datetimepicker.css">
    <script type="text/javascript" src="<?php echo RUTA_URL?>/js/moment-with-locales.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_URL?>/js/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript" src="<?php echo RUTA_URL?>/js/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_URL?>/js/Chart.min.js"></script>
    <link rel="shortcut icon" href="<?php echo RUTA_URL?>/images/logo_isss_ico.ico" type="image/ico"/>

</head>
<?php
	//Instanciamos la clase controlador
	$Iniciar = new Core;
?>
</html>
