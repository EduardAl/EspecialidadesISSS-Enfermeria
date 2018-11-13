<?php
require_once RUTA_APP.'/library/Base.php';
require_once RUTA_APP.'/views/inc/header.php';
$conn = new Base;
$conn->query("select * from procedures where specialty_id = 1");
$conn->execute();
$data=$conn->registros();
?> 