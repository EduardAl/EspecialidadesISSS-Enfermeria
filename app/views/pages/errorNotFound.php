<?php require RUTA_APP.'/views/inc/header.php'; ?>
<body>
	<div class="container">
		<h2>¡Error!</h2>
		<br>
		<h3>La página que has solicitado no existe o no se encuentra disponible</h3>
		<?php
		if(isset($_SESSION['error'])){
			echo "<br><h4><b>Causa del error: </b>";
			echo $_SESSION['error']."</h4>"; 
			unset($_SESSION['error']);
		}
		?>
	</div>
</body>
<?php require RUTA_APP.'/views/inc/footer.php'; ?>