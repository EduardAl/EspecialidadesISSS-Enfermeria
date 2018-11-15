<?php
 if(isset($datos['meta'])){
 	//Aquí se modifican los títulos
 	$titulos = ['Nivel','Meta','Realizado','Porcentaje de realización'];
 	$tabla = $datos['meta'];
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