<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device=width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="id=edge">
	<meta charset="utf-8" />
    <link rel="stylesheet" href="<?php echo(RUTA_URL) ?>/css/bootstrap.css">
	<title><?php echo NOMBRESITIO;?></title>
</head>
    <body>
        <nav class="navbar navbar-default">
        <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Desplegar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" >Especialidades</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo RUTA_URL?>/Pages/index">Inicio</a></li>
                    <li><a href="<?php echo RUTA_URL?>/Nivel/niveles/4">Nivel 4</a></li>
                    <li><a href="<?php echo RUTA_URL?>/Nivel/niveles/5">Nivel 5</a></li>
                    <li><a href="<?php echo RUTA_URL?>/Nivel/niveles/6">Nivel 6</a></li>
                    <li><a href="<?php echo RUTA_URL?>/Nivel/niveles/7">Nivel 7</a></li>
                    <li><a href="<?php echo RUTA_URL?>/Pages/Users">Usuarios</a></li>
                    <li><a href="<?php echo RUTA_URL?>/Pages/Settings">Configuración</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"> Julie </a></li>
                    <li><a href="<?php echo RUTA_URL?>/Login/signout"> (cerrar sesión)</a></li>
                </ul>
                </div>
            </div>
        </nav>
