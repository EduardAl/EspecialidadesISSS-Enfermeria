
<div class="col-xs-2 navbar-right" style="padding-top:  10px;">
  <select name="cbColores" class="form-control" id="colors<?php echo $id?>" >
    <option value="0">Azul</option>
    <option value="1">Rosas</option>
    <option value="2">Playa</option>
    <option value="3">Pascua</option>             
    <option value="4">Tierra</option>             
    <option value="5">Montaña</option>
    <option value="6">Ártico</option>
    <option value="7">Aves y Bayas</option>
    <option value="8">Frescura</option>
    <option value="9">Puesta de sol</option>
    <option value="10">Noche</option>
    <option value="11">Retro</option>
    <option value="12">Cítrico</option>
    <option value="13">Tierra en Anochecer</option>
    <option value="14">Tropical</option>
    <option value="15">Otoño</option>
    <option value="16">Fresas</option>
    <option value="17">Intenso</option>
    <option value="18">Elegante</option>
    <option value="19">Atemporal</option>
    <option value="20">Naranjada</option>
    <option value="21">Canela</option>
    <option value="22">Tonos Pastel</option>
    <option value="23">Neón</option>
    <option value="24">Cereza</option>
  </select>
</div>
<div class="col-xs-1 navbar-right" >
  <label style="color: white; position: center; padding-top:  14px;">Colores:</label>
</div>
<div class="col-xs-2 navbar-right" style="padding-top:  10px;">
  <select name="cbTipo" class="form-control" id="colors<?php echo $id?>" >
  </select>
</div>
<div class="col-xs-1 navbar-right" >
  <label style="color: white; position: center; padding-top:  14px;">Colores:</label>
</div>
<br><br><br><canvas id="chart<?php echo $id?>" style="background-color: #FCFCFC;"></canvas>
<script>

  //Variables controladoras
  var myChart<?php echo $id?>;
  var ctx<?php echo $id?> = document.getElementById("chart<?php echo $id?>").getContext('2d');
  var type<?php echo $id?> = 'doughnut';
  var backgroundColor;
  var data<?php echo $id?> =  {
    labels:[
      <?php
          foreach ($datos['values'] as $key) {
            echo "'".$key->Título."', ";
          }
        ?>1
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
          ?>3
          ],
          backgroundColor:['rgb(34,14,111)','rgb(0,191,255)','rgb(176,224,230)','rgb(147,112,219)']
      },
      ]};
  var options<?php echo $id?> = {
    };

  //Inicializador del gráfico
  function start<?php echo $id?>(){
     myChart<?php echo $id?> = new Chart(ctx<?php echo $id?>, {
      type: this.type<?php echo $id?>,
      data: this.data<?php echo $id?>,
      options: this.options<?php echo $id?>
      }); 
  }

  //Cambio de gráfico
  function changeChart<?php echo $id?>() {
      myChart<?php echo $id?>.destroy();
      this.type<?php echo $id?> = (this.type<?php echo $id?>=='pie')?'doughnut':'pie';
      start<?php echo $id?>();
  }
  start<?php echo $id?>();
    //-------------------------------------------------------------------------------

    //ComboBox
  $("#colors<?php echo $id?>").change(function(){
    switch($(this).val()){
      case "0":
      this.backgroundColor=['rgb(34,14,111)','rgb(0,191,255)','rgb(176,224,230)','rgb(147,112,219)'];
        break;
      case "1":
      this.backgroundColor=['rgb(139,0,0)','rgb(255,140,0)','rgb(240,128,128)','rgb(255,250,205)'];
        break;        
      case "2":
      this.backgroundColor=['#F4CC70','#DE7A22','#20948B','#6AB187'];
        break;        
      case "3":
      this.backgroundColor=['#5BC8AC','#E6D72A','#FA8D9E','#98DBC6'];
        break;        
      case "4":
      this.backgroundColor=['#8D230F','#C99E10','#9B4F0F','#1E434C'];
        break;        
      case "5":
      this.backgroundColor=['#68829E','#AEBD38','#598234','#505160'];
        break;        
      case "6":
      this.backgroundColor=['#F1F1F2','#1995AD','#A1D6E2','#BCBABE'];
        break;        
      case "7":
      this.backgroundColor=['#9A9EAB','#EC96A4','#DFE166','#5D535E'];
        break;        
      case "8":
      this.backgroundColor=['#4CB5F5','#B7B8B6','#B3C100','#34675C'];
        break;        
      case "9":
      this.backgroundColor=['#375E97','#FFBB00','#FB6542','#3F681C'];
        break;        
      case "10":
      this.backgroundColor=['#011A27','#063852','#E6DF44','#F0810F'];
        break;
      case "11":
      this.backgroundColor=['#75B1A9','#D9B44A','#4F6457','#ACD0C0'];
        break;
      case "12":
      this.backgroundColor=['#F9DC24','#8EBA43','#4B7447','#EB8A44'];
        break;
      case "13":
      this.backgroundColor=['#73605B','#D09683','#363237','#2D4262'];
        break;
      case "14":
      this.backgroundColor=['#FFD64D','#F52549','#9BC01C','#FA6775'];
        break;
      case "15":
      this.backgroundColor=['#2E2300','#C05805','#6E6702','#DB9501'];
        break;
      case "16":
      this.backgroundColor=['#CB0000','#E4EA8C','#3F6C45','#50312F'];
        break;
      case "17":
      this.backgroundColor=['#000B29','#EDB83D','#D70026','#F8F5F2'];
        break;
      case "18":
      this.backgroundColor=['#0F1B07','#FDF49F','#5C821A','#C6D166'];
        break;
      case "19":
        this.backgroundColor=['#00293C','#F62A00','#FDF49F','#1E656D'];
        break;
      case "20":
        this.backgroundColor=['#F25C00','#F9A603','#F7EFE2','#F70025'];
        break;
      case "21":
        this.backgroundColor=['#AF4425','#662E1C','#C9A66B','#EBDCB2']
        break;
      case "22":
        this.backgroundColor=['#C1E1DC','#FFCCAC','#FDD475','#FFEB94'];
        break;
      case "23":
        this.backgroundColor=['#B8D20B','#321B12','#F77604','#F56C57'];
        break;
      case "24":
        this.backgroundColor=['#A10115','#C0B2B5','#D72C16','#F0EFEA'];
        break;
    }
    myChart<?php echo $id?>.data.datasets[0].backgroundColor=this.backgroundColor;
    myChart<?php echo $id?>.update();
  });
</script>
