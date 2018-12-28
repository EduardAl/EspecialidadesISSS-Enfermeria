<button class="btn btn-primary" onclick="changeChart<?php echo $id?>();">Clic</button>
<br><br>
<canvas id="chart<?php echo $id?>" style="background-color: white;"></canvas>
<script>
    //Variables controladoras
    var myChart<?php echo $id?>;
    var ctx<?php echo $id?> = document.getElementById("chart<?php echo $id?>").getContext('2d');
    var type<?php echo $id?> = 'line';
    var data<?php echo $id?> =  {
            labels:[
            <?php
                foreach ($datos['values'] as $key) {
                  echo "'".$key->Actividad."', ";
                }
              ?>
              ],
            datasets: [
            {
                label: "Meta",
                backgroundColor: 'rgba(0, 179, 255, 0.6)',
                data: [
                <?php
                foreach ($datos['values'] as $key) {
                  echo $key->Meta.", ";
                }
                ?>
                ]
            },
            {
                label: "Realizado",
                backgroundColor: 'rgb(0,0,139)',
                data: [
                <?php
                foreach ($datos['values'] as $key) {
                  echo $key->Realizado.", ";
                }
                ?>
                ]
            },
            ]
            };
    var options<?php echo $id?> = {
        scaleShowValues: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }],
            xAxes: [{
                ticks: {
                    autoSkip: false
                }
            }]
        }
        };

    //Inicializador del gráfico
    function start<?php echo $id?>(){
       myChart<?php echo $id?> = new Chart(ctx<?php echo $id?>, {
        type: this.type<?php echo $id?>,
        data: this.data<?php echo $id?>,
        }); 

        if(this.type<?php echo $id?>!="radar"){
          myChart<?php echo $id?>.options=this.options<?php echo $id?>;
          myChart<?php echo $id?>.update();
        }
    }

    //Cambio de gráfico
    function changeChart<?php echo $id?>() {
        myChart<?php echo $id?>.destroy();
        this.type<?php echo $id?> = (this.type<?php echo $id?>=='bar')?'radar':'bar';
        start<?php echo $id?>();
    }

    start<?php echo $id?>();
</script>
