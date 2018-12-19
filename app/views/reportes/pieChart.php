<canvas id="chart<?php echo $id?>" style="background-color: white;"></canvas>
<script>
var ctx = document.getElementById("chart<?php echo $id?>").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels:[
        <?php
            foreach ($datos['values'] as $key) {
              echo "'".$key->Título."', ";
            }
          ?>
          ],
        datasets: [
        {
          data:
            [
            <?php
              foreach ($datos['values'] as $key) {
                echo $key->Value.",";
              }
            ?>
            ],
            backgroundColor : ['rgba(0,0,128,0.8)','rgba(0,0,205,0.8)','rgba(0,191,255,0.8)','rgba(176,224,230,0.8)','rgba(147,112,219,0.8)','rgba(153,50,204,0.8)','rgba(75,0,130,0.8)'],
        },
        ]
    },
    options: {
      
    }
});
</script>
