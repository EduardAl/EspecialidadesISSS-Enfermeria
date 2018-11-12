<?php
	//Cargamos aquí las librerías
	require_once 'config/configurar.php';
    require_once 'koolreport/autoload.php';

	require_once 'library/Base.php';
	require_once 'library/Core.php';
	require_once 'library/Controller.php';
    require_once RUTA_APP.'/views/reports/urologia_view.php';

	//Autoload php
	spl_autoload_register(function($nombreClase){
		require_once $nombreClase.'.php';
	});
?>