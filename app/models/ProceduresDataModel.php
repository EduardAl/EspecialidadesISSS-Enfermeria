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
      $fecha2=date("Y-m-d",mktime(0, 0, 0, date("m")  , date("t"), date("Y")));
      $fecha3=$fecha1;
      $fecha4=$fecha2;
      if(isset($tiempo['tipo'])){
        $tipo=$tiempo['tipo'];
        if($tipo=='Per'){
          $fecha1=date("Y-m-d",strtotime($tiempo['fecha1']));
          $fecha2=date("Y-m-d",strtotime($tiempo['fecha2']));
          $fecha3=date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tiempo['fecha1'])), 1, date("Y",strtotime($tiempo['fecha1']))));
          $fecha4=date("Y-m-d",mktime(0, 0, 0, date("m",strtotime($tiempo['fecha2'])), date("t",strtotime($tiempo['fecha2'])), date("Y",strtotime($tiempo['fecha2']))));
        }
        else if ($tipo=='Year'){
          $fecha1=date("Y-m-d",mktime(0, 0, 0, 1  , 1, date("Y")));
          $fecha2=date("Y-m-d",mktime(0, 0, 0, 12  ,31, date("Y")));
          $fecha3=$fecha1;
          $fecha4=$fecha2;
        }
      }
      $sql = "SELECT * FROM (SELECT A.Actividad,ifnull(A.Meta,B.Realizado)as 'Meta',B.Realizado as 'Realizado', CONCAT(ROUND((B.Realizado/A.Meta)*100,2),'%') as '% realización' from (select p.name as 'Actividad',sum(g.number)as 'Meta' from goals g inner join procedures p on p.id= g.procedure_id inner join specialties s on s.id = p.specialty_id where s.name LIKE '%".$nombre."%' and g.date between '".$fecha3."' and '".$fecha4."' group by p.id) as A inner join
        (Select p.name as 'Actividad',sum(pd.number) as 'Realizado' from procedure_data pd inner join procedures p on p.id =pd.procedure_id inner join specialties s on s.id = p.specialty_id where s.name LIKE '%".$nombre."%' and pd.date between '".$fecha1."' and '".$fecha2."' group by p.id) as B on A.Actividad=B.Actividad
        UNION ALL
        SELECT p.name as 'Actividad',sum(pd.number) as 'Meta', sum(pd.number) as 'Realizado', '100.00%' as '% realización' from procedures p left outer join procedure_data pd on p.id =pd.procedure_id left outer join goals g on pd.procedure_id = g.procedure_id and g.date between '".$fecha3."' and '".$fecha4."' inner join specialties s on s.id = p.specialty_id where s.name LIKE '%".$nombre."%' and pd.date between '".$fecha1."' and '".$fecha2."' and g.id is null group by p.name
        UNION ALL
        SELECT p.name as 'Actividad',ifnull(sum(g.number),0) as 'Meta',0 as 'Realizado','0.00%' as '% realización' from procedures p left outer join procedure_data pd on p.id =pd.procedure_id and pd.date between '".$fecha1."' and '".$fecha2."' left outer join goals g on p.id = g.procedure_id and g.date between '".$fecha3."' and '".$fecha4."' inner join specialties s on s.id = p.specialty_id where s.name LIKE '%".$nombre."%'  and pd.id is null group by p.name
        ) F order by Actividad";
      $this->query($sql);
      return $this->registros();
      }

    public function datosEspecialidades($nombre,$tiempo){
      $fecha1=date("Y-m-d",mktime(0, 0, 0, date("m")  , 1, date("Y")));
      $fecha2=date("Y-m-d",mktime(0, 0, 0, date("m")  , date("t"), date("Y")));
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