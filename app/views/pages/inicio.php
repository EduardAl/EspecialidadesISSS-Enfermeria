 Inicio 
 <?php 
 require RUTA_APP.'\views\inc\header.php'; 
 echo $datos['titulo'];
 ?>
 <ul>
 	<?php
 	foreach($datos['articulos'] as $articulo) :?>
 	<li>
 		<?php echo $articulo->titulo; ?>
 	</li>
 <?php endforeach; ?>
</ul>
 <?php
 require RUTA_APP.'\views\inc\footer.php'; ?>