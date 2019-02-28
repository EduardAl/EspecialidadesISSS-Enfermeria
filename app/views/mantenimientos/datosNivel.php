<?php
if(isset($datos))
{
	//El form se coloca fuera de esto, para seleccionar la acción que desea
?>
<table class="table table-striped table-bordered impre" >
	<thead class="formulario">
	    <tr>
		<?php foreach ($datos['TítulosX'] as $key) {
			echo "<th scope='col' style='text-align: center; vertical-align: middle;'>".$key."</th>";
		} ?>
	    </tr>
	</thead>
	<tbody class="datosFormulario">
		<?php
			foreach ($datos['TítulosY'] as $key) {
				//echo "<tr>";
				echo "<tr><th scope='row'>".$key->title."</th>";
				echo "<th scope='row' style='text-align: center;vertical-align: middle;'>"."<input type='number' class='form-control' min='-1' max='100000' style='text-align: center;max-height:30px;' name='".$key->id."' required value='0'></th>";
				if(count($datos['TítulosX'])==3){
					echo "<th scope='row' style='text-align: center;vertical-align: middle;'>"."<input class='form-control'type='number' min='0' max=59  style='text-align: center; min-width: 60px;' name='e".$key->id."' required value='0'></th>";
				}
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<?php
}
?>
