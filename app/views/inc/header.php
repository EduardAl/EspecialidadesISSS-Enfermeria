<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="id=edge">
	<meta charset="utf-8" />
	<title><?php echo NOMBRESITIO;?></title>
	 <div class="color"><br> <br> </div> 
	<section class="jumbotron jumbo-nav">
		<div class="container cont">
			<img src="<?php echo RUTA_URL?>/images/LOGO_ISSS_SIN_FONDO.png" width="100" height="100">
			<h2>&nbsp&nbspConsultorio de Especialidades - Departamento de Enfermería</h2>
		</div>
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
						<li><a href="#"> <?=USER_ACTIVE?></a></li>
						<li><a href="<?php echo RUTA_URL?>/Login/signout"> Cerrar Sesión</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
</body>
