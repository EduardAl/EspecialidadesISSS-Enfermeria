<?php if(isset($id))$id++;else$id=1 ?>
<div>
  <div class="col-xs-12 col-md-12">
    <div class=thumbnail>
      <div class="col-xs-1 colapsa impre" >
        <label style="color: white; position: center; padding-top:  14px;">Tipo de Gráfica:</label>
      </div>
      <div class="col-xs-2 colapsa impre" style="padding-top:  10px;">
        <select name="cbTipo" class="form-control" id="type<?php echo $id?>" >
          <option value="bar">Barra</option>
          <option value="doughnut" selected>Dona</option>
          <option value="pie">Pastel</option>
        </select>
      </div>
      <div class="col-xs-1 colapsa impre" >
        <label style="color: white; position: center; padding-top:  14px;">Colores:</label>
      </div>
      <div class="col-xs-2 colapsa collapse impre" style="padding-top:  10px;">
        <select name="cbColores" class="form-control" id="colors<?php echo $id?>" >
          <option value="rgb(255,215,0)">Amarillo</option>
          <option value="rgb(0,0,139)">Azul</option>
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

          <option disabled="disabled">----------</option>
          
          <option value="D1" selected>Degradado Azul</option>
          <option value="D2">Degradado Rojo</option>
          <option value="D3">Degradado Verde</option>
          <option value="D4">Degradado Café</option>

          <option disabled="disabled">----------</option>

          <option value="4">Tierra</option>
          <option value="15">Otoño</option>
          <option value="21">Canela</option>
          <option value="13">Tierra en Anochecer</option>
          <option value="11">Retro</option>
          <option value="5">Montaña</option>
          <option value="8">Frescura</option>
          <option value="9">Pradera</option>
          <option value="18">Elegante</option>
          <option value="6">Ártico</option>
          <option value="10">Noche</option>
          <option value="16">Fresas</option>
          <option value="24">Cereza</option>
          <option value="20">Naranjada</option>
          <option value="2">Playa</option>
          <option value="3">Pascua</option>
          <option value="17">Intenso</option>
          <option value="23">Neón</option>
          <option value="1">Rosas</option>
        </select>
      </div>
      <div class="colapsa impre">
          <br><br><br>
      </div>
      <canvas id="chart<?php echo $id?>" style="background-color: #FCFCFC;"></canvas>
  </div>
</div>
<script>

  //Variables controladoras
  var myChart<?php echo $id?>;
  var ctx<?php echo $id?> = document.getElementById("chart<?php echo $id?>").getContext('2d');
  var data<?php echo $id?> =  {
    labels:[
      <?php
          foreach ($datos['values'] as $key) {
            //echo "'".'1'."', ";
            echo "'".$key->Título."', ";
          }
        ?>
        ],
      datasets: [
      {
        label:'Valores',
        data:
          [
          <?php
            foreach ($datos['values'] as $key) {
              echo $key->Value.",";
            }
          ?>
          ],
          backgroundColor:
   ['#070719','#0B173B','#0B2161','#08298A','#0431B4','#0040FF','#2E64FE','#0489B1','#58ACFA','#81DAF5']
      },
      ]};
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
        },
        "hover": {
          "animationDuration": 0
        },
        "animation": {
          "duration": 1,
          "onComplete": function() {
            var chartInstance = this.chart,
              ctx = chartInstance.ctx;

            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';

            this.data.datasets.forEach(function(dataset, i) {
              var meta = chartInstance.controller.getDatasetMeta(i);
              meta.data.forEach(function(bar, index) {
                var data = dataset.data[index];
                ctx.fillText(data, bar._model.x, bar._model.y - 5);
              });
            });
          }
        },
        tooltips: {
          "enabled":false,
        } 
        };

  //Inicializador del gráfico
  function start<?php echo $id?>(type){
    myChart<?php echo $id?> = new Chart(ctx<?php echo $id?>, {
      type: type,
      data: this.data<?php echo $id?>,
      options:{
        tooltips: {
          "enabled":false,
        } ,
        animation: {
          duration: 500,
          easing: "easeOutQuart",
           onComplete: function () {
            var ctx = this.chart.ctx;
              ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
              ctx.textAlign = 'center';
              ctx.textBaseline = 'bottom';

            this.data.datasets.forEach(function (dataset) {
              for (var i = 0; i < dataset.data.length; i++) {
                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                    total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                    mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
                    start_angle = model.startAngle,
                    end_angle = model.endAngle,
                    mid_angle = start_angle + (end_angle - start_angle)/2;

                var x = mid_radius * Math.cos(mid_angle);
                var y = mid_radius * Math.sin(mid_angle);

                ctx.fillStyle = '#fff';
                if(start_angle!=end_angle){
                    if(dataset.data[i]>0){
                        var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
                        ctx.fillText(dataset.data[i], model.x + x, model.y + y);
                        // Display percent in another line, line break doesn't work for fillText
                        ctx.fillText(percent, model.x + x, model.y + y + 15);
                    }
                }
              }
            });               
    }
  }

      }
      }); 
    if(type=="bar"){
      myChart<?php echo $id?>.options=this.options<?php echo $id?>;
      myChart<?php echo $id?>.update();
    }
  }
  start<?php echo $id?>($("#type<?php echo $id?>").val());

  //Cambio de gráfico
 $("#type<?php echo $id?>").change(function(){
    myChart<?php echo $id?>.destroy();
    start<?php echo $id?>($(this).val());
 });

    //-------------------------------------------------------------------------------

    //ComboBox
  $("#colors<?php echo $id?>").change(function(){
    var bColor='#140237';
    switch($(this).val()){

      //Degradados
      case "D1":
      bColor=['#070719','#0B173B','#0B2161','#08298A','#0431B4','#0040FF','#2E64FE','#0489B1','#58ACFA','#81DAF5'];
        break;
      case "D2":
      bColor=['#190707','#3B0B0B','#610B0B','#8A0808','#B40404','#DF0101','#FE2E2E','#FA5858','#F78181','#F5A9A9'];
        break;
      case "D3":
      bColor=['#071907','#0B3B0B','#0B610B','#088A08','#04B404','#01DF01','#37E837','#58FA58','#81F781','#A9F5A9'];
        break;
      case "D4":
      bColor=['#191007','#2A120A','#3B240B','#61380B','#8A4B08','#8A4B08','#B45F04','#DF7401','#FE9A2E','#FAAC58'];
        break;
      case "D5":
      bColor=['#000000','#1C1C1C','#2E2E2E','#424242','#585858','#6E6E6E','#848484','#A4A4A4','#BDBDBD','#D8D8D8'];
        break;

      //Planteados
      /*
      case "0":
      bColor=['#140237','#220E6F','#00BFFF','#B0E0E6','#DFCAFA','#9370DB','#6D00FC','#470672','#0A8967','#00E1A5'];
        break;
      */
      case "1":
      bColor=['#8B0000','#FF8C00','#F08080','#FFFACD','#265C00','#7AA802','#EDAE01','#D61800','#E94F08','#7F152E'];
        break;        
      case "2":
      bColor=['#F4CC70','#DE7A22','#20948B','#6AB187','#257985','#5EA8A7','#E6CCB5','#E2C499','#E38B75','#E8A735'];
        break;        
      case "3":
      bColor=['#5BC8AC','#E6D72A','#FA8D9E','#98DBC6','#C1E1DC','#FFCCAC','#FDD475','#FFEB94','#FF9A97','#7DCCFF'];
        break;        
      case "4":
      bColor=['#8D230F','#C99E10','#9B4F0F','#1E434C','#46211A','#6E6702','#C05805','#A43820','#7D4427','#DB9501'];
        break;        
      case "5":
      bColor=['#68829E','#AEBD38','#598234','#505160','#90AFC5','#336B87','#4F6457','#324851','#7DA3A1','#763626'];
        break;        
      case "6":
      bColor=['#BCBABE','#1995AD','#A1D6E2','#F1F1F2','#B6C2C9','#C4DFE6','#ACD0C0','#8FCAE8','#66A5AD','#12959E'];
        break;        
      case "7":
        break;        
      case "8":
      bColor=['#4CB5F5','#B7B8B6','#B3C100','#34675C','#2E4600','#486B00','#A2C523','#2D4262','#1D9C94','#6FB98F'];
        break;        
      case "9":
      bColor=['#375E97','#7CAA2D','#34888C','#3F681C','#F5E356','#CB6318','#EB8A44','#ECD434','#4B7447','#8EBA43'];
        break;        
      case "10":
      bColor=['#011A27','#063852','#E6DF44','#F0810F','#2F3131','#283B5B','#426E86','#EBA844','#FFCE77','#F9BA32'];
        break;
      case "11":
      bColor=['#75B1A9','#D9B44A','#4F6457','#ACD0C0','#97B8C2','#F1DCC9','#D6C6B9','#BF9A77','#EFD48B','#688B8A'];
        break;
      case "12":
      break;
      case "13":
      bColor=['#73605B','#D09683','#363237','#2D4262','#D5C3AA','#867666','#7D5E3C','#4D648D','#283655','#1E1F26'];
        break;
      case "14":
      //QUEDA EN EVALUACIÓN
        break;
      case "15":
      bColor=['#2E2300','#C05805','#6E6702','#DB9501','#81715E','#FAAE3D','#E38533','#A57C65','#919636','#5A5F37'];
        break;
      case "16":
      bColor=['#CB0000','#E4EA8C','#3F6C45','#50312F','#524A3A','#E2C499','#919636','#5A5F37','#C5001A','#8C0004'];
        break;
      case "17":
      bColor=['#000B29','#EDB83D','#D70026','#E4E3DB','#00293C','#8C0004','#C8000A','#E8A735','#FDF49F','#1E656D'];
        break;
      case "18":
      bColor=['#0F1B07','#FDF49F','#5C821A','#C6D166','#B7B8B6','#B3C100','#34675C','#7E7B15','#563E20','#EBDF00'];
        break;
      case "19":
      //QUEDA EN EVALUACIÓN
        break;
      case "20":
      bColor=['#F25C00','#F9A603','#F7EFE2','#F70025','#8C0004','#E7552C','#FFB745','#DDDEDE','#F34A4A','#962715'];
        break;
      case "21":
      bColor=['#AF4425','#662E1C','#C9A66B','#EBDCB2','#DAC3B3','#CDAB81','#BF9A77','#AA4B41','#E38B75','#7E675E']
        break;
      case "22":
      //QUEDA EN EVALUACIÓN
        break;
      case "23":
      bColor=['#B8D20B','#321B12','#F77604','#F56C57','#00CFFA','#FF0038','#43D156','#020509','#FAAF08','#F0810F'];
        break;
      case "24":
      bColor=['#A10115','#C0B2B5','#D72C16','#F0EFEA','#F25C00','#F7EFE2','#F9A603','#F1F3CE','#DB9501','#F6D7A3'];
        break;
      default:
        bColor=($(this).val());
        break;
    }
    myChart<?php echo $id?>.data.datasets[0].backgroundColor=bColor;
    myChart<?php echo $id?>.update();
  });
</script>