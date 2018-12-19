<canvas id="chart<?php echo $id?>" style="background-color: white;"></canvas>
<script>
var ctx = document.getElementById("chart<?php echo $id?>").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
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
            backgroundColor: 'rgba(0,0,139,0.8)',
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
            backgroundColor: 'rgba(0, 179, 255, 0.8)',
            data: [
            <?php
            foreach ($datos['values'] as $key) {
              echo $key->Realizado.", ";
            }
            ?>
            ]
        },
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
