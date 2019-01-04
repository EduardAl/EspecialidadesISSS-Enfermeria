<?php if(!isset($_SESSION))session_start()?>
<body>
	<div class="Página">
	<header>
	<div class="color"><br><br> </div> 
<?php require RUTA_APP.'\views\inc\jumbotron.php'; ?>

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
				<a href="<?php echo RUTA_URL?>/Pages/index" class="navbar-brand" >Inicio</a>
			</div>

			<div id="nave_j" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo RUTA_URL?>/Nivel/Administracion">Administración</a></li>
					<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/4">Nivel 4</a></li>
					<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/5">Nivel 5</a></li>
					<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/6">Nivel 6</a></li>
					<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/7">Nivel 7</a></li><?php
					if(isset($_SESSION['acceso'])&&$_SESSION['acceso']==1)
					echo   '
					<li><a href="'.RUTA_URL.'/Users">Usuarios</a></li>';
					?>			
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
					if(isset($_SESSION['nombre']))
						echo "<li><a href='#'>".$_SESSION['nombre']."</a></li>"
					?>

					<li><a href="<?php echo RUTA_URL?>/Login/signout"> Cerrar Sesión</a></li>
				</ul>
			</div>
		</div>
	</nav>
	</header>
	