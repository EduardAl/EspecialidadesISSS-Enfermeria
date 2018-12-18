<?php 

  class ProceduresDataModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    /*
      ************

      ************
                  */

    public function procedimientos($nombre,$tiempo){
      $fecha1=date("Y-m-d",mktime(0, 0, 0, date("m")  , 1, date("Y")));
      $fecha2=date("Y-m-d",mktime(0, 0, 0, date("m")  , date("j"), date("Y")));
      if(isset($tiempo['tipo'])){
        $tipo=$tiempo['tipo'];
        if($tipo=='Per'){
          $fecha1=date("Y-m-d",strtotime($tiempo['fecha1']));
          $fecha2=date("Y-m-d",strtotime($tiempo['fecha2']));
        }
        else if ($tipo=='Year'){
          $fecha1=date("Y-m-d",mktime(0, 0, 0, 1  , 1, date("Y")));
          $fecha2=date("Y-m-d",mktime(0, 0, 0, 12  ,31, date("Y")));
        }
      }

      $sql = "SELECT procedures.name as 'Actividad', goals.number as 'Meta', sum(procedure_data.number) as 'Realizado', IFNULL(ROUND(((sum(procedure_data.number)/goals.number)*100), 2), 100) as '% realización' from procedures inner join procedure_data on procedure_data.procedure_id = procedures.id inner join goals on goals.procedure_id = procedures.id inner join specialties on specialties.id = procedures.specialty_id where specialties.name LIKE '%".$nombre."%' and procedure_data.date between '".$fecha1."' and '".$fecha2."' group by procedures.id;";

      $this->query($sql);
      return $this->registros();
      }

    public function datosEspecialidades($nombre,$tiempo){
      $fecha1=date("Y-m-d",mktime(0, 0, 0, date("m")  , 1, date("Y")));
      $fecha2=date("Y-m-d",mktime(0, 0, 0, date("m")  , date("j"), date("Y")));
      if(isset($tiempo['tipo'])){
        $tipo=$tiempo['tipo'];
        if($tipo=='Per'){
          $fecha1=date("Y-m-d",strtotime($tiempo['fecha1']));
          $fecha2=date("Y-m-d",strtotime($tiempo['fecha2']));
        }
        else if ($tipo=='Year'){
          $fecha1=date("Y-m-d",mktime(0, 0, 0, 1  , 1, date("Y")));
          $fecha2=date("Y-m-d",mktime(0, 0, 0, 12  ,31, date("Y")));
        }
      }
      //Modificar el query
      $sql = "SELECT st.name as 'Título', sum(sd.number) as 'Value' from specialty_things_data sd inner join specialty_things st on sd.specialty_things_id=st.id  inner join specialties s on sd.specialty_id=s.id where s.name like '%".$nombre."%' and sd.date between '".$fecha1."' and '".$fecha2."' group by st.id;";
      $this->query($sql);
      //$this->bind(':nombre',$nombre);
      return $this->registros();
    }
}