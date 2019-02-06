<?php
 if(isset($datos['values'])&&isset($datos['values'][0])){
 	if(isset($tblId))$tblId++;else $tblId=1;?>
<div class="col-xs-12" style="overflow: auto;">
	<table class="table table-striped table-bordered" id="tblData<?php echo $tblId;?>">
		<thead class="thead-dark">
			<?php
				if(isset($datos['tituloE'])){
					echo "<tr class='monthThead' style='background:white;vertical-align: middle;'><th COLSPAN='2'></th>";
					foreach ($datos['tituloE'] as $key) {
						echo "<th scope='col' style='text-align: center; vertical-align: middle;' COLSPAN='3'>".$key."</th>";
					} 
					echo "</tr>";
				}
			?>
			<tr>
				<th scope='col' style='text-align: center;vertical-align: middle;'>#</th>
			<?php
				$contar=count($datos['titulo']);
				foreach ($datos['titulo'] as $key) {
					echo "<th scope='col' style='text-align: center; vertical-align: middle;'>".$key."</th>";
				} 
				if(isset($extra)){
					echo "<th scope='col' class='impre' style='text-align: center; vertical-align: middle;'>Acciones</th>";
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
							echo "<td style='vertical-align: middle;'>".$val."</td>";
						else if($j==$contar&&isset($extra)){
							echo "<td style='text-align: center;' class='impre'>";
							echo "<form method='POST' action='".$extra."'>";
							echo "<input type='text' name='extra' hidden value='".$val."'>";
							echo '<button type="submit" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span> Actualizar</button>';
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
</div>
<?php
}
?>