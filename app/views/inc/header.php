<?php if(!isset($_SESSION))session_start()?>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="id=edge">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/estilos.css">
	<title><?php echo NOMBRESITIO;?></title>
	 <div class="color"><br><br> </div> 
	<?php require RUTA_APP.'\views\inc\jumbotron.php'; ?> 
	</section>
</head>
<body>
	<header>
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nave_j">
						<span class="sr-only">Desplegar/Ocultar Menú</span>
						<span class="icon-bar"></span>
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
						<li><a href="#"> <?php if(isset($_SESSION['nombre'])) echo $_SESSION['nombre']?></a></li>
						<li><a href="<?php echo RUTA_URL?>/Login/signout"> Cerrar Sesión</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
</body>
