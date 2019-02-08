<?php if(isset($id))$id++;else$id=1 ?>
    <div class="col-xs-12">
        <div class=thumbnail>
            <div class="col-xs-1 navbar-collapse collapse" >
              <label style="color: white; position: center; padding-top:  14px;">Tipo de Gráfica:</label>
            </div>
            <div class="col-xs-2 navbar-collapse collapse" style="padding-top:  10px;">
              <select name="cbTipo" class="form-control" id="type<?php echo $id?>" >
                <option value="bar" selected>Barra</option>
                <option value="line">Línea</option>
                <option value="radar">Radar</option>
              </select>
            </div>
            <div class="col-xs-1 navbar-collapse collapse" >
              <label style="color: white; position: center; padding-top:  14px;">Meta:</label>
            </div>
            <div class="col-xs-2 navbar-collapse collapse" style="padding-top:  10px;">
              <select name="cbColores" class="form-control" id="colors1<?php echo $id?>" >
                <option value="rgba(255,215,0,0.6)">Amarillo</option>
                <option value="rgba(0,0,139,0.6)">Azul</option>
                <option value="rgba(139,69,19,0.6)">Café</option>
                <option value="rgba(205,133,63,0.6)">Café Claro</option>
                <option value="rgba(0,179,255,0.6)" selected>Celeste</option>
                <option value="rgba(128,128,128,0.6)">Gris</option>
                <option value="rgba(255,140,0,0.6)">Naranja</option>
                <option value="rgba(75,0,130,0.6)">Indigo</option>
                <option value="rgba(255,0,0,0.6)">Rojo</option>
                <option value="rgba(139,0,0,0.6)">Rojo Oscuro</option>
                <option value="rgba(255,192,203,0.6)">Rosa</option>
                <option value="rgba(0,128,0,0.6)">Verde</option>
                <option value="rgba(17,196,17,0.6)">Verde Claro</option>
                <option value="rgba(0,100,0,0.6)">Verde Oscuro</option>
              </select>
            </div>
            <div class="col-xs-1 navbar-collapse collapse" >
              <label style="color: white; position: center; padding-top:  14px;">Realizado:</label>
            </div>
            <div class="col-xs-2 navbar-collapse collapse" style="padding-top:  10px;">
              <select name="cbColores" class="form-control" id="colors2<?php echo $id?>" >
                <option value="rgb(255,215,0)">Amarillo</option>
                <option value="rgb(0,0,139)" selected>Azul</option>
                <option value="rgb(139,69,19)">Café</option>
                <option value="rgb(205,133,63)">Café Claro</option>
                <option value="rgb(0,179,255)">Celeste</option>
                <option value="rgb(128,128,128)">Gris</option>
                <option value="rgb(255,140,0)">Naranja</option>
                <option value="rgb(75,0,130)">Indigo</option>
                <option value="rgb(255,0,0)">Rojo</option>
                <option value="rgb(139,0,0)">Rojo Oscuro</option>
                <option value="rgb(255,192,203)">Rosa</option>
                <option value="rgb(0,128,0)">Verde</option>
                <option value="rgb(17,196,17)">Verde Claro</option>
                <option value="rgb(0,100,0)">Verde Oscuro</option>
              </select>
            </div>
            <div class="col-xs-2 navbar-collapse collapse" style="padding-top:  10px;">
                <button onclick="cambiar<?php echo $id?>();" class="btn btn-info">
                    <span class="glyphicon glyphicon-transfer"></span> Porcentaje
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <br><br><br>
            </div>
            <canvas id="chart<?php echo $id?>" style="background-color: #FCFCFC;"></canvas>
        </div>
    </div>
<script>
    //Variables controladoras
    var cambio<?php echo $id?>=false;
    var myChart<?php echo $id?>;
    var ctx<?php echo $id?> = document.getElementById("chart<?php echo $id?>").getContext('2d');
    var porcentaje<?php echo $id?> = {
        labels:[<?php
            foreach ($datos['values'] as $key) {
              echo "'".$key->Actividad."', ";
            }
            ?>
        ],
        datasets: [
        {
            label: "Porcentajes",
            backgroundColor: 'rgba(0,179,255,0.6)',
            data: [
            <?php
              foreach ($datos['values'] as $key) {
                if(isset($key->Porcentaje))
                  echo $key->Porcentaje.", ";
                else
                  echo "100,";
              }
            ?>
            ]
        }
        ]
      };
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
        },
        };

    //Inicializador del gráfico
    function start<?php echo $id?>(type){
       myChart<?php echo $id?> = new Chart(ctx<?php echo $id?>, {
        type: type,
        data: (this.cambio<?php echo $id?>)?this.porcentaje<?php echo $id?> :this.data<?php echo $id?>,
        }); 
        if(type!="radar"){
          myChart<?php echo $id?>.options=this.options<?php echo $id?>;
          myChart<?php echo $id?>.update();
        }
        else
          myChart<?php echo $id?>.options={
                scale: {
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                    }
                }
            };
          myChart<?php echo $id?>.update();
    }

    function cambiar<?php echo $id?>(){
        this.cambio<?php echo $id?>=!this.cambio<?php echo $id?>;
        myChart<?php echo $id?>.destroy();
        this.start<?php echo $id?>($("#type<?php echo $id?>").val());
    }

    $("#type<?php echo $id?>").change(function(){
        myChart<?php echo $id?>.destroy();
        start<?php echo $id?>($(this).val());
    });
    $("#colors1<?php echo $id?>").change(function(){
        myChart<?php echo $id?>.data.datasets[0].backgroundColor=($(this).val());
        myChart<?php echo $id?>.update();
    });
    $("#colors2<?php echo $id?>").change(function(){
        if(myChart<?php echo $id?>.data.datasets.length>1){
            myChart<?php echo $id?>.data.datasets[1].backgroundColor=($(this).val());
        }
        else{
            myChart<?php echo $id?>.data.datasets[0].backgroundColor=($(this).val());
        }
        myChart<?php echo $id?>.update();
    });
    start<?php echo $id?>('bar');
</script>
