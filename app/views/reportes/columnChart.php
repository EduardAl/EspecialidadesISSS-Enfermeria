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

      /*/var options = {
        width: 1000,
        height: 400,
        chart: {
          title: 'Procedimientos de Especialidades'
        }
      };
/*/
                  var options = {
                bar: {groupWidth:'35%'},
                vAxis: {
                    gridlines: {
                        color: 'transparent'
                    },
                    textPosition: 'none',
                    textStyle: {
                        bold: false,
                        fontSize: '10',
                        paddingRight: '100',
                       marginTop: '100'
                    },
                    textPosition: 'none',
                    viewWindow: {
                        min: data.getColumnRange(1).min + (data.getColumnRange(1).min / 5),
                        max: data.getColumnRange(1).max / 10 + (data.getColumnRange(1).max / 10),
                    }
                    },
                    hAxis: {
                        slantedText: true,
                        slantedTextAngle: 90,
                        textStyle: {
                          bold: true,
                            fontName: 'Whitney HTF Light',
                            fontSize: 10
                        },
                    },
                    legend: {
                        position: 'none',
                        textStyle: {
                            bold: true,
                            color: 'black',
                            fontName: 'Whitney HTF Light',
                            fontSize: 8
                        }
                    },
                    tooltip: {
                        trigger: 'none',
                        textStyle: {
                          bold: false,
                          color: 'black',
                          fontSize: 8
                        }
                    },
                   annotations: {
                        alwaysOutside: true,
                        textStyle: {
                            fontName: 'Whitney HTF Light',
                            fontSize: 10,
                            color: 'black',
                        },
                        stem: {
                            length: 5,
                            color: 'transparent',
                        },
                    },
                    chartArea: {
                        height: '100%',
                        width: '100%',
                        left: 20,
                        top: 10,
                    },
                    legend: {
                        position: 'bottom',
                        textStyle: {
                            fontName: 'Arial',
                            fontSize: 8,
                            color: 'black'
                        },
                    }
            };
      var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
      materialChart.draw(data, options);
    }
</script>
<div id="chart_div" ></div>