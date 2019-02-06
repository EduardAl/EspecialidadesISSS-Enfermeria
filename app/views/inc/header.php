<?php if(!isset($_SESSION))session_start()?>
<body>
	<div class="Página">
	<header>
	<div class="color"><br><br> </div> 
<?php require RUTA_APP.'\views\inc\jumbotron.php'; ?>

	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"data-target="#nave_j">
					<span class="sr-only">Desplegar/Ocultar Menú</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?php echo RUTA_URL?>/Pages/index" class="navbar-brand" >
					<span class="glyphicon glyphicon-home"></span> Inicio
				</a>
			</div>
			<div id="nave_j" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo RUTA_URL?>/Nivel/Administracion">
						<span class="glyphicon glyphicon-stats"></span> Administración
					</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle mouseHover" data-toggle="dropdown">
							<span class="glyphicon glyphicon-list"></span> Niveles
						</a>
						<ul class="dropdown-menu inverse-dropdown">
							<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/4">
								<span class="glyphicon glyphicon-asterisk"></span> Nivel 4</a>
							</li>
							<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/5">
								<span class="glyphicon glyphicon-asterisk"></span> Nivel 5</a>
							</li>
							<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/6">
								<span class="glyphicon glyphicon-asterisk"></span> Nivel 6</a>
							</li>
							<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/7">
								<span class="glyphicon glyphicon-asterisk"></span> Nivel 7</a>
							</li>
						</ul>
					</li>
					<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/DeptoEnfermeria">
						<span class="glyphicon glyphicon-plus"></span> Depto. Enfermería
					</a></li>
					<li><a href="<?php echo RUTA_URL?>/Nivel/Niveles/Epidemiologia">
						<span class="glyphicon glyphicon-tint"></span> Epidemiología
					</a></li>
					<?php
					if(isset($_SESSION['acceso'])&&$_SESSION['acceso']==1){
					?><li><a href="<?php echo RUTA_URL?>/Users">						
						<span class="glyphicon glyphicon-star"></span> Usuarios</a>
					</a></li><?php }?>			
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle mouseHover" data-toggle="dropdown">
							<span class="glyphicon glyphicon-user"></span> Mi Cuenta
						</a>
						<ul class="dropdown-menu">
							<li><a href='<?php echo RUTA_URL?>/Users/MiPerfil'>
								<span class="glyphicon glyphicon-cog"></span> Editar</a>
							</li>
							<li><a href="<?php echo RUTA_URL?>/Login/signout">
								<span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	</header>
	