<?php
 if(isset($datos['values'])){
 	?>
<table class="table table-striped">
	<thead class="thead-dark">
	    <tr>
			<th scope='col'>#</th>
		<?php foreach ($datos['titulo'] as $key) {
			echo "<th scope='col'>".$key."</th>";
		} ?>
	    </tr>
	</thead>
	<tbody class="tbody-table">
		<?php
			$i = 0; 
			foreach ($datos['values'] as $key) {
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