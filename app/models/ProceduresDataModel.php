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
      //Especialidad
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
        ) F order by F.Actividad";
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

      $sql = "SELECT * from (SELECT A.Título,ifnull(B.Value,0) as 'Value' from 
        (Select st.name as 'Título' from specialty_things st) A left join 
          (SELECT st.name as 'tit', sum(std.number) as'Value' from specialty_things_data std inner join specialty_things st on st.id=std.specialty_things_id inner join specialties s on std.specialty_id=s.id  where s.name LIKE '%".$nombre."%' and std.date between '".$fecha1."' and '".$fecha2."' group by st.id) B on A.Título=B.tit
       )F";

      $this->query($sql);
      //$this->bind(':nombre',$nombre);
      return $this->registros();
      }

      //Nivel
    public function datosNivel($nivel,$tiempo){
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
      $sql = "SELECT * from (SELECT A.Título,ifnull(B.Value,0) as 'Value' from 
        (Select lt.name as 'Título' from level_things lt) A left join 
          (SELECT lt.name as 'tit', sum(lth.number) as'Value' from level_things_data lth inner join level_things lt on lt.id=lth.level_things_id inner join levels l on l.id =lth.level_id  where l.name LIKE '%".$nivel."%' and lth.date between '".$fecha1."' and '".$fecha2."' group by lt.id) B on A.Título=B.tit
       )F";

      $this->query($sql);
      $this->bind(':nivel',$nivel);
      return $this->registros();
      }
    public function ausentismoNivel($nivel,$tiempo){
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
      $sql = "SELECT * from (SELECT A.Título,ifnull(B.Value,0) as 'Value' from 
        (Select ab.type as 'Título' from absences ab) A left join 
          (SELECT ab.type as 'tit', sum(abd.number) as'Value' from absences_data abd inner join absences ab on ab.id=abd.absences_id inner join levels l on l.id =abd.level_id  where l.name LIKE '%".$nivel."%' and abd.date between '".$fecha1."' and '".$fecha2."' group by ab.id) B on A.Título=B.tit
       )F";

      $this->query($sql);
      $this->bind(':nivel',$nivel);
      return $this->registros();
      }
    public function administracionNivel($nivel,$tiempo){
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
      $sql = "SELECT * from (SELECT A.Título,ifnull(B.Value,0) as 'Value' from 
        (Select am.activities as 'Título' from administrative_management am) A left join 
          (SELECT am.activities as 'tit', sum(amd.number) as'Value' from administrative_management_data amd inner join administrative_management am on am.id=amd.administrative_management_id inner join levels l on l.id =amd.level_id  where l.name LIKE '%".$nivel."%' and amd.date between '".$fecha1."' and '".$fecha2."' group by am.id) B on A.Título=B.tit
       )F";

      $this->query($sql);
      $this->bind(':nivel',$nivel);
      return $this->registros();
      }

      //General

    public function pPacientes($tiempo){
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
         $sql = "SELECT * from (SELECT A.Nivel,ifnull(B.Consulta,0) as 'Consulta',ifnull(C.Preparacion,0) as 'Preparacion',CONCAT(ROUND(ifnull((C.Preparacion/B.Consulta)*100,0),2),'%') as 'Porcentaje' from 
        (Select l.name as 'Nivel' from levels l) A left join 
        (SELECT l.name as 'niv', sum(std.number) as'Consulta' from specialty_things_data std inner join specialty_things st on st.id=std.specialty_things_id inner join specialties s on s.id=std.specialty_id inner join levels l on l.id=s.level_id where st.id=1 and std.date between '".$fecha1."' and '".$fecha2."' group by l.id) B 
          on A.Nivel=B.niv left join (".
          "SELECT l.name as 'niv', sum(std.number) as'Preparacion' from specialty_things_data std inner join specialty_things st on st.id=std.specialty_things_id inner join specialties s on s.id=std.specialty_id inner join levels l on l.id=s.level_id where st.id=2 and std.date between '".$fecha1."' and '".$fecha2."' group by l.id) C 
          on A.Nivel=C.niv
       )F ";
      $this->query($sql);
      return $this->registros();
      }
}