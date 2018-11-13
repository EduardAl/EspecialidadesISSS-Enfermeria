<?php
	//Cargamos aquí las librerías
	require_once 'config/configurar.php';

	//Autoload php
	spl_autoload_register(function($nombreClase){
		require_once 'library/'.$nombreClase.'.php';
	});
?>