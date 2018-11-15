<?php
 if(isset($datos['procedimientoMes'])){
 	//Aquí se modifican los títulos
 	$titulos = ['Actividad','Meta','Realizado','Porcentaje de realización'];
 	$tabla = $datos['procedimientoMes'];
 ?>
<table class="table table-striped">
	<thead class="thead-dark">
	    <tr>
			<th scope='col'>#</th>
		<?php foreach ($titulos as $key) {
			echo "<th scope='col'>".$key."</th>";
		} ?>
	    </tr>
	</thead>
	<tbody>
		<?php
			$i = 0; 
			foreach ($tabla as $key) {
				$i++;
				echo "<tr><th scope='row'>".$i."</th>";
				foreach ($key as $val) {
					echo "<td>".$val."</td>";
				}
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<?php
}
?>