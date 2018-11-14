<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Actividades', 'Valores']
    <?php
    	foreach ($datos['values'] as $key) {
    		echo ",['".$key->titulo."',";
    		echo $key->value."]";
    	}
    ?>
    ]);
    var options = {
      title: ' ',
      is3D: true,
      //sliceVisibilityThreshold: .2,
      //backgroundColor: '#ccc',
      chartArea:{left:20,right:20,bottom:20,top:20,width:'100%',height:'100%'},
      fontSize:13,
      legend:{alligment:'center'},
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>
<div id="piechart" style="height: 400px"></div>