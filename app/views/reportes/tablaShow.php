<?php
 if(isset($datos['values'])){
 	?>
<!--<table class="table table-striped table-bordered">-->
<table class="table table-striped table-bordered">
	<thead class="thead-dark">
		<?php
			if(isset($datos['tituloE'])){
				echo "<tr class='monthThead' style='background:white;'><th COLSPAN='2'></th>";
				foreach ($datos['tituloE'] as $key) {
					echo "<th scope='col' style='text-align: center; vertical-align: middle;' COLSPAN='3'>".$key."</th>";
				} 
				echo "</tr>";
			}
		?>
		<tr>
			<th scope='col' style='text-align: center;'>#</th>
		<?php
			$contar=count($datos['titulo']);
			foreach ($datos['titulo'] as $key) {
				echo "<th scope='col' style='text-align: center; vertical-align: middle;'>".$key."</th>";
			} 
			if(isset($extra)){
				echo "<th scope='col' style='text-align: center;'>Acciones</th>";
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
				echo "<tr><th scope='row' style='text-align: center; vertical-align: middle;'>".$i."</th>";
				foreach ($key as $val) {
					if($j==0)
						echo "<td style:'vertical-align: middle;'>".$val."</td>";
					else if($j==$contar&&isset($extra)){
						echo "<td style='text-align: center;'>";
						echo "<form method='POST' action='".$extra."'>";
						echo "<input type='text' name='extra' hidden value='".$val."'>";
						echo "<input type='submit' class='btn btn-sm btn-info' value='Actualizar'>";
						echo "</td></form>";
					}
					else
						echo "<td style='text-align: center; vertical-align: middle;'>".$val."</td>";
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