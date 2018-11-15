<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawTitleSubtitle);

function drawTitleSubtitle() {

      var data = new google.visualization.arrayToDataTable([
          ['', 'Meta', 'Realizado']
          <?php
            foreach ($datos['values'] as $key) {
              echo ",['".$key->Actividad."',".$key->Meta.",";
              echo $key->Realizado."]";
            }
          ?>
        ]);

      var options = {
        chart: {
          title: 'Procedimientos de Especialidades',
        }
      };

      var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
      materialChart.draw(data, options);
    }
</script>
<div id="chart_div" ></div>