<?php
 if(isset($datos['values'])&&isset($datos['values'][0])){
 	if(isset($tblId))$tblId++;else {$tblId=1;
 	?>
<script language="javascript">
	function exportTableToExcel(tableID, filename = ''){
	    var downloadLink;
	    var dataType = 'application/vnd.ms-excel';
	    var tableSelect = document.getElementById(tableID);
	    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
	    
	    // Specify file name
	    filename = filename?filename+'.xls':'excel_data.xls';
	    
	    // Create download link element
	    downloadLink = document.createElement("a");
	    
	    document.body.appendChild(downloadLink);
	    
	    if(navigator.msSaveOrOpenBlob){
	        var blob = new Blob(['ufeff', tableHTML], {
	            type: dataType
	        });
	        navigator.msSaveOrOpenBlob( blob, filename);
	    }else{
	        // Create a link to the file
	        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
	    
	        // Setting the file name
	        downloadLink.download = filename;
	        
	        //triggering the function
	        downloadLink.click();
	    }
	}
</script><?php }?>
<!--
 <div class="col-xs-12">
 <div class="navbar-right">
 <button onclick="exportTableToExcel('tblData<?php echo $tblId;?>', 'Tabla_Especialidades-ISSS')" class="btn btn-success">Exportar</button>
  </div></div>
-->
<table class="table table-striped table-bordered" id="tblData<?php echo $tblId;?>">
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
						echo "<td style='vertical-align: middle;'>".$val."</td>";
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