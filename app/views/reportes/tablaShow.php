<?php
 if(isset($datos['values'])){
 	?>
<table class="table table-striped">
	<thead class="thead-dark">
		<?php
			if(isset($datos['tituloE'])){
				echo "<tr class='monthThead' style='background:white;'><th>  </th>";
				foreach ($datos['tituloE'] as $key) {
					echo "<th scope='col' style='text-align: center;'>".$key."</th>";
				} 
				echo "</tr>";
			}
		?>
		<tr>
			<th scope='col'>#</th>
		<?php
			foreach ($datos['titulo'] as $key) {
				echo "<th scope='col' style='text-align: center;'>".$key."</th>";
			} 
		?>
	    </tr>
	</thead>
	<tbody class="tbody-table">
		<?php
			$i = 0;
			foreach ($datos['values'] as $key) {
				$i++;
				$j=0;
				echo "<tr><th scope='row'>".$i."</th>";
				foreach ($key as $val) {
					if($j==0)
						echo "<td>".$val."</td>";
					else
						echo "<td style='text-align: center;'>".$val."</td>";
					$j++;
				}
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<?php
}
?>