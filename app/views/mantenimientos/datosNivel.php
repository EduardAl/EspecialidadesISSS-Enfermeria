<?php
if(isset($datos))
{
	//El form se coloca fuera de esto, para seleccionar la acción que desea
?>
<table class="table table-striped">
	<thead class="formulario">
	    <tr>
		<?php foreach ($datos['TítulosX'] as $key) {
			echo "<th scope='col'>".$key."</th>";
		} ?>
	    </tr>
	</thead>
	<tbody class="datosFormulario">
		<?php
			$j = 1; 
			$valores=$datos['Tipo'];
			foreach ($datos['TítulosY'] as $key) {
				$j++;
				echo "<tr>";
				echo "<tr><th scope='row'>".$key->title."</th>";
				for ($i=1; $i < count($datos['TítulosX']); $i++) {
					echo "<th scope='row'>"."<input type='".$valores[$i-1]."' min='0' name='".$key->id."' required value='0'></th>";
				}
				echo "</tr>";
			}
		?>
	</tbody>
</table>
</form>
<?php
}
?>
<!-- 

// Primero están los valores del nivel

	| Nº de valoraciones por Enfermería                        |
	| Caídas de pacientes                                      |
	| Quejas de pacientes                                      |
	| Quejas resueltas a  pacientes                            |
	| Accidentes por contactos con sangre y fluidos corporales |
	| Cirugías programadas y agregadas                         |
	| Cirugías realizadas                                      |
	| Cirugias suspendidas                                     |
	| Cirugias suspendias por intervenciòn de enfermerìa       |

1. 



-->
