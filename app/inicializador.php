<?php
	//Cargamos aquí las librerías
	require_once 'config/configurar.php';
	//require_once 'library/Base.php';
	//require_once 'library/Core.php';
	//require_once 'library/Controller.php';
	//require_once 'library/Model.php';
	//require_once 'library/Session.php';
	require_once RUTA_APP.'/../vendor/autoload.php';
	//Autoload php
	spl_autoload_register(function($nombreClase){
		require_once 'library/'.$nombreClase.'.php';
	});
?>