<?php
if(isset($datos))
{
	//El form se coloca fuera de esto, para seleccionar la acción que desea
?>
<table class="table table-striped table-bordered impre">
	<thead class="formulario">
	    <tr>
		<?php foreach ($datos['TítulosX'] as $key) {
			echo "<th scope='col' style='text-align: center;'>".$key."</th>";
		} ?>
	    </tr>
	</thead>
	<tbody class="datosFormulario">
		<?php
			$j = 1; 
			foreach ($datos['TítulosY'] as $key) {
				$j++;
				//echo "<tr>";
				echo "<tr><th scope='row'>".$key->title."</th>";
				for ($i=1; $i < count($datos['TítulosX']); $i++) {
					echo "<th scope='row' style='text-align: center;'>"."<input type='number' min='-1' style='text-align: center;' name='".$key->id."' required value='0'></th>";
				}
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<?php
}
?>
