<?php 

  class ProceduresDataModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }
      //Especialidad
    public function procedimientos($nombre,$tiempo){
      $fecha1=date('Y-m-1');
      $fecha2=date('Y-m-t');
      if(isset($tiempo['tipo'])){
        $fecha1=date("Y-m-d",strtotime($tiempo['fecha1']));
        $fecha2=date("Y-m-d",strtotime($tiempo['fecha2']));
      }
      $fecha3=date('Y-m-01',strtotime($fecha1));;
      $fecha4=date('Y-m-t',strtotime($fecha2));;
      $sql="SELECT A.key as 'Actividad',ifnull(B.Meta,ifnull(C.Realizado,0)) as 'Meta',ifnull(C.Realizado,0) as 'Realizado',ROUND(ifnull((ifnull(C.Realizado,0)/ifnull(B.Meta,ifnull(C.Realizado,1))),0)*100,2)as 'Porcentaje' from (Select p.name as 'key' from procedures p inner join specialties s on s.id=p.specialty_id where s.name LIKE '$nombre%')A left join ("."
      SELECT p.name as 'key',sum(g.number)as 'Meta' from goals g inner join procedures p on p.id=g.procedure_id where g.date between '$fecha3' and '$fecha4' group by p.name)B on  A.key=B.key left join (".
      "SELECT p.name as 'key',sum(pd.number) as 'Realizado' from procedure_data pd inner join procedures p on p.id=pd.procedure_id where pd.date between '$fecha1' and '$fecha2' group by p.name)C on A.key=C.key order by Actividad";
      $this->query($sql);
      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['Actividad','Meta','Realizado','% Realización'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
        ];
        $temp[]=strtotime($fecha1);
        $temp[]=strtotime($fecha2);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.key as 'Actividad'";
        $param['key']="SELECT p.name as 'key' from procedures p inner join specialties s on s.id=p.specialty_id where s.name LIKE '$nombre%'";
        $param['meta']="SELECT p.name as 'key',sum(g.number)as 'Meta' from goals g inner join procedures p on p.id=g.procedure_id where g.date %param% group by p.name";
        $param['realizado']="SELECT p.name as 'key',sum(pd.number) as 'Realizado' from procedure_data pd inner join procedures p on p.id=pd.procedure_id where pd.date %param% group by p.name";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = 'Procedimientos'; 
       
        if(isset($result['titulos'])){
          foreach ($result['titulos'] as $key) {
            $titulos[] = $key;
          }
          $datos['meta']=[
            'values' => $this->registros(),
            'titulo' => $titulos,
            'tituloE'=>$result['meses']
          ];
        }
      }
      return $datos;
      }
    public function datosEspecialidades($nombre,$tiempo){
      $fecha1=date('Y-m-1');
      $fecha2=date('Y-m-t');
      if(isset($tiempo['tipo'])){
        $fecha1=date("Y-m-d",strtotime($tiempo['fecha1']));
        $fecha2=date("Y-m-d",strtotime($tiempo['fecha2']));
      }
      //Modificar el query
      $sql = "SELECT * from (SELECT A.Título,ifnull(B.Value,0) as 'Value' from 
        (Select st.name as 'Título' from specialty_things st) A left join 
          (SELECT st.name as 'tit', sum(std.number) as'Value' from specialty_things_data std inner join specialty_things st on st.id=std.specialty_things_id inner join specialties s on std.specialty_id=s.id  where s.name LIKE '$nombre%' and std.date between '$fecha1' and '$fecha2' group by st.id) B on A.Título=B.tit
       )F";

      $this->query($sql);
      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['Actividad','Cantidad'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
        ];
        $temp[]=strtotime($fecha1);
        $temp[]=strtotime($fecha2);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.key as 'Título'";
        $param['key']="SELECT st.name as 'key' from specialty_things st";
        $param['meta']="SELECT st.name as 'key', sum(std.number) as'Meta' from specialty_things_data std inner join specialty_things st on st.id=std.specialty_things_id inner join specialties s on std.specialty_id=s.id  where s.name LIKE '$nombre%' and std.date %param% group by st.id";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = 'Actividad'; 
       
        foreach ($result['meses'] as $key) {
          $titulos[] = $key;
        }
          $datos['meta']=[
            'values' => $this->registros(),
            'titulo'=>$titulos
          ];
      }
      return $datos;
      }
    public function referenciasEspecialidades($nombre,$tiempo){
      $fecha1=date('Y-m-1');
      $fecha2=date('Y-m-t');
      if(isset($tiempo['tipo'])){
        $fecha1=date("Y-m-d",strtotime($tiempo['fecha1']));
        $fecha2=date("Y-m-d",strtotime($tiempo['fecha2']));
      }

      //Modificar el query
      if($tiempo['separador']=="1"){
        $sql = "SELECT p.name as 'Título',ifnull(A.dato,0) as 'Value' from place p left join(SELECT sum(r.number) as 'dato',r.place_id as 'key' from reference r inner join specialties s on s.id=r.specialty_id where s.name LIKE '%$nombre%' and r.date between '$fecha1' and '$fecha2' group by r.place_id)A on p.id=A.key UNION ALL
          SELECT '<b>Total</b>',ifnull(B.dato,0) from (SELECT sum(r.number) as 'dato',r.place_id as 'key' from reference r inner join specialties s on s.id=r.specialty_id where s.name LIKE '%$nombre%' and r.date between '$fecha1' and '$fecha2')B ;";
        $this->query($sql);
        $titulos=['Lugar','Cantidad'];
      }
      else{
        $temp[]=strtotime($fecha1);
        $temp[]=strtotime($fecha2);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.tit as 'Título'";
        $param['key']="SELECT p.name as 'tit',p.id as 'key' from place p UNION ALL SELECT '<b>Total</b>',-1";
        $param['meta']="SELECT sum(r.number)as 'Meta',r.place_id as 'key' from reference r inner join specialties s on s.id=r.specialty_id where s.name LIKE '%$nombre%' and r.date %param% group by r.place_id UNION ALL SELECT sum(r.number)as 'Meta',-1 as 'key' from reference r inner join specialties s on s.id=r.specialty_id where s.name LIKE '%$nombre%' and r.date %param% group by r.place_id";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = 'Lugar'; 
       
        foreach ($result['meses'] as $key) {
          $titulos[] = $key;
        }
          $datos['meta']=[
            'values' => $this->registros(),
            'titulo'=>$titulos
          ];
      }

      $datos['meta']=[
        'values' => $this->registros(),
        'titulo' => $titulos,
      ];
      return $datos;
      }

    public function cargarDatosNivel($nivel,$tiempo=0){
      $fecha1=date('Y-m-1');
      $fecha2=date('Y-m-t');
      $fecha3=$fecha1;
      $fecha4=$fecha2;
      if(isset($tiempo['tipo'])){
        if($tiempo['tipo']=='Per'){
          $fecha1=$tiempo['fecha1'];
          $fecha2=$tiempo['fecha2'];
          $fecha3=date('Y-m-01',strtotime($fecha1));
          $fecha4=date('Y-m-t',strtotime($fecha2));
        }
        else if ($tiempo['tipo']=='Year'){
          $fecha1=date("Y-01-01");
          $fecha2=date("Y-12-31");
          $fecha3=$fecha1;
          $fecha4=$fecha2;
        }
      }
      if(isset($tiempo['separador'])&&$tiempo['separador']!='1'){
        $temp[]=strtotime($fecha1);
        $temp[]=strtotime($fecha2);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.key as 'Indicadores'";
        $param['key']="("."SELECT st.name as 'key' from specialty_things st where st.name LIKE '%Total%')UNION ALL 
          (Select lt.name as 'key' from level_things lt where description='Indicador') UNION ALL 
          (Select 'Total de personal de Enfermería' as 'key') UNION ALL 
          (Select 'Horas laborales en el mes' as 'key') UNION ALL 
          (Select 'Horas laborales en el periodo' as 'key') UNION ALL 
          (Select 'Horas Ausencias' as 'key') UNION ALL 
          (Select Concat(Concat('<li>',a.type),'</li>') as 'key' from absences a) UNION ALL 
          (Select 'Desarrollo de Competencias Programadas' as 'key') UNION ALL 
          (Select 'Desarrollo de Competencias Realizadas' as 'key') UNION ALL 
          (Select 'Educación en Salud Programada' as 'key') UNION ALL
          (Select 'Educación en Salud Realizada' as 'key') UNION ALL
          (Select 'Investigación en Enfermería Programada' as 'key') UNION ALL 
          (Select 'Investigación en Enfermería Realizada' as 'key')";

        $param['meta']="("."SELECT st.name as 'key',sum(std.number) as 'Meta' from specialty_things st inner join specialty_things_data std on st.id=std.specialty_things_id inner join specialties s on s.id =std.specialty_id where st.name LIKE '%Total%' and s.level_id=$nivel and std.date %param% group by st.name) UNION ALL
          (Select lt.name as 'key',sum(ltd.number) as 'Meta' from level_things lt inner join level_things_data ltd on lt.id=ltd.level_things_id where ltd.level_id=$nivel and ltd.date %param% group by lt.name) UNION ALL
          (Select 'Total de personal de Enfermería' as 'key',ROUND(ifnull(sum(E.e),P.v),0) as 'Meta' from levels l left join (Select level_id as 'key', AVG(employees) as e from hours_data where date %param% group by level_id)E on l.id=E.key left join (Select id as 'key', value as v from adminsettings)P on l.id=P.key where l.id=$nivel) UNION ALL 
          (Select 'Horas laborales en el mes' as 'key',sum(E.this) as 'Meta' from levels l left join (Select level_id as 'key', working_hours_at_month*employees as 'this' from hours_data where date %param% and level_id=$nivel)E on l.id=E.key) UNION ALL
          (Select 'Horas laborales en el periodo' as 'key',sum(E.this) as 'Meta' from levels l left join (Select level_id as 'key', working_hours_at_period*employees as 'this' from hours_data where date %param% and level_id=$nivel)E on l.id=E.key) UNION ALL
          (Select 'Horas Ausencias' as 'key',sum(ad.number) from absences_data ad where ad.date %param% and ad.level_id=$nivel) UNION ALL 
          (Select Concat(Concat('<li>',a.type),'</li>') as 'key',sum(ad.number) as 'Meta' from absences a inner join absences_data ad on a.id=absences_id where ad.date %param% and ad.level_id=$nivel group by a.type) UNION ALL 
          (Select 'Desarrollo de Competencias Programadas' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Personal'and hed.level_id=$nivel and  hed.created_at %param%) UNION ALL 
          (Select 'Desarrollo de Competencias Realizadas' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Personal'and hed.level_id=$nivel and hed.status='Realizada' and hed.created_at %param%) UNION ALL 
          (Select 'Educación en Salud Programada' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Pacientes'and hed.level_id=$nivel and hed.created_at %param%) UNION ALL 
          (Select 'Educación en Salud Realizada' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Pacientes'and hed.level_id=$nivel and hed.status='Realizada' and hed.created_at %param%) UNION ALL 
          (Select 'Investigación en Enfermería Programada' as 'key',count(i.id) as 'Meta' from investigations i where i.date %param% and i.level_id=$nivel) UNION ALL
          (Select 'Investigación en Enfermería Realizada' as 'key',count(i.id) as 'Meta' from investigations i where i.status='Realizada' and i.date %param% and i.level_id=$nivel)";

        $result=$this->separador($param);
        $sql1=($result['sql']);
        $titulos[] = 'Indicadores'; 
       
        foreach ($result['meses'] as $k) {
          $titulos[] = $k;
        }
      }
      else{
        $sql1 = "SELECT A.key as 'Indicadores',ifnull(B.Meta,0) as 'Total' from (
          (Select st.name as 'key' from specialty_things st where st.name LIKE '%Total%')UNION ALL 
          (Select lt.name as 'key' from level_things lt where description='Indicador') UNION ALL 
          (Select 'Total de personal de Enfermería' as 'key') UNION ALL 
          (Select 'Horas laborales en el mes' as 'key') UNION ALL 
          (Select 'Horas laborales en el periodo' as 'key') UNION ALL 
          (Select 'Horas Ausencias' as 'key') UNION ALL 
          (Select Concat(Concat('<li>',a.type),'</li>') as 'key' from absences a) UNION ALL 
          (Select 'Desarrollo de Competencias Programadas' as 'key') UNION ALL 
          (Select 'Desarrollo de Competencias Realizadas' as 'key') UNION ALL 
          (Select 'Educación en Salud Programada' as 'key') UNION ALL
          (Select 'Educación en Salud Realizada' as 'key') UNION ALL
          (Select 'Investigación en Enfermería Programada' as 'key') UNION ALL 
          (Select 'Investigación en Enfermería Realizada' as 'key')  

         )A left join (

          (Select st.name as 'key',sum(std.number) as 'Meta' from specialty_things st inner join specialty_things_data std on st.id=std.specialty_things_id inner join specialties s on s.id =std.specialty_id where st.name LIKE '%Total%' and s.level_id=$nivel and std.date between '$fecha1' and '$fecha2' group by st.name) UNION ALL

          (Select lt.name as 'key',sum(ltd.number) as 'Meta' from level_things lt inner join level_things_data ltd on lt.id=ltd.level_things_id where ltd.level_id=$nivel and ltd.date between '$fecha1' and '$fecha2' group by lt.name) UNION ALL

          (Select 'Total de personal de Enfermería' as 'key',ROUND(AVG(hd.employees),0) as 'Meta' from hours_data hd where level_id=$nivel and date between '$fecha3' and '$fecha4') UNION ALL 
          (Select 'Horas laborales en el mes' as 'key',sum(E.this) as 'Meta' from levels l left join (Select level_id as 'key', working_hours_at_month*employees as 'this' from hours_data where date between '$fecha3' and '$fecha4' and level_id=$nivel)E on l.id=E.key) UNION ALL
          (Select 'Horas laborales en el periodo' as 'key',sum(E.this) as 'Meta' from levels l left join (Select level_id as 'key', working_hours_at_month*employees as 'this' from hours_data where date between '$fecha3' and '$fecha4' and level_id=$nivel)E on l.id=E.key) UNION ALL
          (Select 'Horas Ausencias' as 'key',sum(ad.number) from absences_data ad where ad.date between '$fecha1' and '$fecha2' and ad.level_id=$nivel) UNION ALL 
          (Select Concat(Concat('<li>',a.type),'</li>') as 'key',sum(ad.number) as 'Meta' from absences a inner join absences_data ad on a.id=absences_id where ad.date between '$fecha1' and '$fecha2' and ad.level_id=$nivel group by a.type) UNION ALL 
          (Select 'Desarrollo de Competencias Programadas' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Personal' and hed.level_id=$nivel and hed.created_at between '$fecha1' and '$fecha2') UNION ALL 
          (Select 'Desarrollo de Competencias Realizadas' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Personal' and hed.level_id=$nivel and hed.status='Realizada' and hed.created_at between '$fecha1' and '$fecha2') UNION ALL 
          (Select 'Educación en Salud Programada' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Pacientes' and hed.level_id=$nivel  and hed.created_at between '$fecha1' and '$fecha2') UNION ALL 
          (Select 'Educación en Salud Realizada' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Pacientes' and hed.level_id=$nivel and hed.status='Realizada' and hed.created_at between '$fecha1' and '$fecha2') UNION ALL 
          (Select 'Investigación en Enfermería Programada' as 'key',count(i.id) as 'Meta' from investigations i where i.date between '$fecha1' and '$fecha2' and i.level_id=$nivel) UNION ALL
          (Select 'Investigación en Enfermería Realizada' as 'key',count(i.id) as 'Meta' from investigations i where i.status='Realizada' and i.date between '$fecha1' and '$fecha2' and i.level_id=$nivel)


         )B on A.key=B.key";
        $titulos = ['Indicadores','Total']; 
      }
      $sql2 = "SELECT * from (SELECT A.Título,ifnull(B.Value,0) as 'Value' from 
        (Select ab.type as 'Título' from absences ab) A left join 
          (SELECT ab.type as 'tit', sum(abd.number) as'Value' from absences_data abd inner join absences ab on ab.id=abd.absences_id where abd.level_id =$nivel and abd.date between '$fecha1' and '$fecha2' group by ab.id) B on A.Título=B.tit
       )F";
      $sql3 = "SELECT A.Título,ifnull(B.Value,0) as 'Value' from 
        (Select st.id as 'key',st.name as 'Título' from specialty_things st) A left join 
          (SELECT std.specialty_things_id as 'key', sum(std.number) as'Value' from specialty_things_data std inner join specialties s on std.specialty_id=s.id  where s.level_id=$nivel and std.date between '$fecha1' and '$fecha2' group by std.specialty_things_id) B on A.key=B.key";
      $this->query($sql1);
      $this->bind(':nivel',$nivel);
      $datos['indicadores']=[
        'values' => $this->registros(),
        'titulo' => $titulos,
      ];
      $this->query($sql2);
      $this->bind(':nivel',$nivel);
      $datos['ausentismo']=[
        'values' => $this->registros(),
        'titulo' => ['Actividad','Cantidad'],
      ];
      if($nivel!='5'){
         $this->query($sql3);
       $this->bind(':nivel',$nivel);
        $datos['consultas']=[
          'values' => $this->registros(),
          'titulo' => ['Actividad','Cantidad'],
        ];
        $datos['graf'][]=$datos['consultas'];
      }
      $datos['graf'][]=$datos['ausentismo'];
      return $datos;
      }

      //Administración//Revisado

    public function indicadores($tiempo){
      if($tiempo['separador']=="1"){
        //No se muestran las horas del periodo en esta
        $fecha1=$tiempo['fecha1'];
        $fecha2=$tiempo['fecha2'];
        $sql = "SELECT A.key as 'Indicadores',ifnull(B.Meta,0) as 'Total' from (
          (Select st.name as 'key' from specialty_things st where st.name LIKE '%Total%')UNION ALL 
          (Select lt.name as 'key' from level_things lt where description='Indicador') UNION ALL 
          (Select 'Total de personal de Enfermería' as 'key') UNION ALL 
          (Select 'Horas laborales en el mes' as 'key') UNION ALL 
          (Select 'Horas laborales en el periodo' as 'key') UNION ALL 
          (Select 'Horas Ausencias' as 'key') UNION ALL 
          (Select Concat(Concat('<li>',a.type),'</li>') as 'key' from absences a) UNION ALL 
          (Select 'Desarrollo de Competencias Programadas' as 'key') UNION ALL 
          (Select 'Desarrollo de Competencias Realizadas' as 'key') UNION ALL 
          (Select 'Educación en Salud Programada' as 'key') UNION ALL
          (Select 'Educación en Salud Realizada' as 'key') UNION ALL
          (Select 'Investigación en Enfermería Programada' as 'key') UNION ALL 
          (Select 'Investigación en Enfermería Realizada' as 'key')  

         )A left join (

          (Select st.name as 'key',sum(std.number) as 'Meta' from specialty_things st inner join specialty_things_data std on st.id=std.specialty_things_id where st.name LIKE '%Total%' and std.date between '$fecha1' and '$fecha2' group by st.name) UNION ALL
          (Select lt.name as 'key',sum(ltd.number) as 'Meta' from level_things lt inner join level_things_data ltd on lt.id=ltd.level_things_id and ltd.date between '$fecha1' and '$fecha2' group by lt.name) UNION ALL
          (Select 'Total de personal de Enfermería' as 'key',ROUND(ifnull(sum(E.e),sum(P.v)),0) as 'Meta' from levels l left join (Select level_id as 'key', AVG(employees) as e from hours_data where date between '$fecha1' and '$fecha2' group by level_id)E on l.id=E.key left join (Select id as 'key', value as v from adminsettings)P on l.id=P.key) UNION ALL           
          (Select 'Horas laborales en el mes' as 'key',sum(E.this) as 'Meta' from levels l left join (Select level_id as 'key', working_hours_at_month*employees as 'this' from hours_data where date between '$fecha1' and '$fecha2')E on l.id=E.key) UNION ALL           
          (Select 'Horas laborales en el periodo' as 'key',sum(E.this) as 'Meta' from levels l left join (Select level_id as 'key', working_hours_at_month*employees as 'this' from hours_data where date between '$fecha1' and '$fecha2')E on l.id=E.key) UNION ALL           
          (Select 'Horas Ausencias' as 'key',sum(ad.number) from absences_data ad where ad.date between '$fecha1' and '$fecha2') UNION ALL           
          (Select Concat(Concat('<li>',a.type),'</li>') as 'key',sum(ad.number) as 'Meta' from absences a inner join absences_data ad on a.id=absences_id where ad.date between '$fecha1' and '$fecha2' group by a.type) UNION ALL 
          (Select 'Desarrollo de Competencias Programadas' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Personal' and hed.created_at between '$fecha1' and '$fecha2') UNION ALL 
          (Select 'Desarrollo de Competencias Realizadas' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Personal' and hed.status='Realizada' and hed.created_at between '$fecha1' and '$fecha2') UNION ALL 
          (Select 'Educación en Salud Programada' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Pacientes' and hed.created_at between '$fecha1' and '$fecha2') UNION ALL 
          (Select 'Educación en Salud Realizada' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Pacientes' and hed.status='Realizada' and hed.created_at between '$fecha1' and '$fecha2') UNION ALL 
          (Select 'Investigación en Enfermería Programada' as 'key',count(i.id) as 'Meta' from investigations i where i.date between '$fecha1' and '$fecha2') UNION ALL
          (Select 'Investigación en Enfermería Realizada' as 'key',count(i.id) as 'Meta' from investigations i where i.status='Realizada' and i.date between '$fecha1' and '$fecha2')
         )B on A.key=B.key";
        $this->query($sql);
        $titulos=['Actividad','Total'];
      }
      else{
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.key as 'Indicadores'";
        $param['key']="("."SELECT st.name as 'key' from specialty_things st where st.name LIKE '%Total%')UNION ALL 
          (Select lt.name as 'key' from level_things lt where description='Indicador') UNION ALL 
          (Select 'Total de personal de Enfermería' as 'key') UNION ALL 
          (Select 'Horas laborales en el mes' as 'key') UNION ALL 
          (Select 'Horas laborales en el periodo' as 'key') UNION ALL 
          (Select 'Horas Ausencias' as 'key') UNION ALL 
          (Select Concat(Concat('',a.type),'') as 'key' from absences a) UNION ALL 
          (Select 'Desarrollo de Competencias Programadas' as 'key') UNION ALL 
          (Select 'Desarrollo de Competencias Realizadas' as 'key') UNION ALL 
          (Select 'Educación en Salud Programada' as 'key') UNION ALL
          (Select 'Educación en Salud Realizada' as 'key') UNION ALL
          (Select 'Investigación en Enfermería Programada' as 'key') UNION ALL 
          (Select 'Investigación en Enfermería Realizada' as 'key')";

        $param['meta']="("."SELECT st.name as 'key',sum(std.number) as 'Meta' from specialty_things st inner join specialty_things_data std on st.id=std.specialty_things_id where st.name LIKE '%Total%' and std.date %param% group by st.name) UNION ALL
          (Select lt.name as 'key',sum(ltd.number) as 'Meta' from level_things lt inner join level_things_data ltd on lt.id=ltd.level_things_id and ltd.date %param% group by lt.name) UNION ALL
          (Select 'Total de personal de Enfermería' as 'key',ROUND(ifnull(sum(E.e),sum(P.v)),0) as 'Meta' from levels l left join (Select level_id as 'key', AVG(employees) as e from hours_data where date %param% group by level_id)E on l.id=E.key left join (Select id as 'key', value as v from adminsettings)P on l.id=P.key) UNION ALL 
          (Select 'Horas laborales en el mes' as 'key',sum(E.this) as 'Meta' from levels l left join (Select level_id as 'key', working_hours_at_month*employees as 'this' from hours_data where date %param%)E on l.id=E.key) UNION ALL
          (Select 'Horas laborales en el periodo' as 'key',sum(E.this) as 'Meta' from levels l left join (Select level_id as 'key', working_hours_at_period*employees as 'this' from hours_data where date %param%)E on l.id=E.key) UNION ALL
          (Select 'Horas Ausencias' as 'key',sum(ad.number) from absences_data ad where ad.date %param%) UNION ALL 
          (Select Concat(Concat('',a.type),'') as 'key',sum(ad.number) as 'Meta' from absences a inner join absences_data ad on a.id=absences_id where ad.date %param% group by a.type) UNION ALL 
          (Select 'Desarrollo de Competencias Programadas' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Personal' and hed.created_at %param%) UNION ALL 
          (Select 'Desarrollo de Competencias Realizadas' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Personal' and hed.status='Realizada' and hed.created_at %param%) UNION ALL 
          (Select 'Educación en Salud Programada' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Pacientes' and hed.created_at %param%) UNION ALL 
          (Select 'Educación en Salud Realizada' as 'key',count(hed.id) as 'Meta' from health_education he inner join health_education_data hed on he.id=hed.health_education_id where he.listeners='Pacientes' and hed.status='Realizada' and hed.created_at %param%) UNION ALL 
          (Select 'Investigación en Enfermería Programada' as 'key',count(i.id) as 'Meta' from investigations i where i.date %param%) UNION ALL
          (Select 'Investigación en Enfermería Realizada' as 'key',count(i.id) as 'Meta' from investigations i where i.status='Realizada' and i.date %param%)";

        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = 'Indicadores'; 
       
        foreach ($result['meses'] as $k) {
          $titulos[] = $k;
        }
      }
      $datos=[
        'values' => $this->registros(),
        'titulo' => $titulos,
      ];
      return $datos;
    }
    public function pPacientes($tiempo){
      $sql = "SELECT * from (SELECT A.Nivel,ifnull(B.Consulta,0) as 'Total Consulta',ifnull(C.Preparacion,0) as 'Preparación de Pacientes',ROUND(ifnull((C.Preparacion/ifnull(B.Consulta,C.Preparacion))*100,0),2) as 'Porcentaje' from 
        (Select l.name as 'Nivel' from levels l where l.name like '%nivel%') A left join 
        (SELECT l.name as 'niv', sum(std.number) as'Consulta' from specialty_things_data std inner join specialty_things st on st.id=std.specialty_things_id inner join specialties s on s.id=std.specialty_id inner join levels l on l.id=s.level_id where st.id=1 and std.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by l.id) B 
        on A.Nivel=B.niv left join (".
        "SELECT l.name as 'niv', sum(ltd.number) as'Preparacion' from level_things_data ltd inner join levels l on l.id=ltd.level_id where ltd.level_things_id=10 and ltd.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by l.id) C 
        on A.Nivel=C.niv
        )F ";
      $this->query($sql);
      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['Nivel','Total Consulta','Preparación de Pacientes','% Realización'],
          'titulosG' => ['Total Consulta','Preparación de Pacientes'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
          'titulosG' => ['Total Consulta','Preparación de Pacientes'],
        ];
        $param['tiempo'][]=strtotime($tiempo['fecha1']);
        $param['tiempo'][]=strtotime($tiempo['fecha2']);

        $param['sql']="SELECT K.key as 'Actividad'";
        $param['key']="SELECT l.name as 'key' from levels l where l.name like '%nivel%'";
        $param['meta']="SELECT l.name as 'key', sum(std.number) as'Meta' from specialty_things_data std inner join specialty_things st on st.id=std.specialty_things_id inner join specialties s on s.id=std.specialty_id inner join levels l on l.id=s.level_id where st.id=1 and std.date %param% group by l.id";
        $param['realizado']="SELECT l.name as 'key',sum(ltd.number) as'Realizado' from level_things_data ltd inner join levels l on l.id=ltd.level_id where ltd.level_things_id=10 and ltd.date %param% group by l.id";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = ''; 
       
        if(isset($result['titulos'])){
          foreach ($result['titulos'] as $key) {
            $titulos[] = ($key=='M')?'C':(($key=='R')?'P':$key);
          }
          $datos['meta']=[
            'values' => $this->registros(),
            'titulo' => $titulos,
            'tituloE'=>$result['meses']
          ];
        }
        else{
          foreach ($result['meses'] as $k) {
            $titulos[] = $k;
          }
          $datos['meta']=[
            'values' => $this->registros(),
            'titulo' => $titulos,
          ];
        }
      }
      return $datos;
    }
    public function ausentismo($tiempo){
      $sql = "SELECT l.name as 'Nivel',ifnull(A.empleados,0) as 'Personal',ifnull(A.Meta,0) as 'Total de Horas Programadas',ifnull(B.Realizado,0) as 'Total de horas no laboradas',ROUND(ifnull((B.Realizado/ifnull(A.Meta,0))*100,0),2) 'Porcentaje' from levels l left join 
      (Select l.id as 'key',ROUND(ifnull(AVG(hd.employees),ifnull(a.value,0)),0)as 'empleados',ROUND(AVG(hd.employees),0)*SUM(hd.working_hours_at_month) as 'Meta' from levels l left join hours_data hd on l.id=hd.level_id and hd.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' left join adminsettings a on l.id=a.id group by l.id) A on l.id=A.key left join 
      (Select ad.level_id as 'key',sum(ad.number)as 'Realizado' from absences_data ad where ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by ad.level_id) B on l.id=B.key";
      $this->query($sql);
      //echo $sql;
      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['Nivel','Empleados','Total de Horas Programadas','Total de horas no laboradas','%'],
          'titulosG' => ['Total de Horas Programadas','Total de horas no laboradas'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
          'titulosG' => ['Total de Horas Programadas','Total de horas no laboradas'],
        ];
        $param['tiempo'][]=strtotime($tiempo['fecha1']);
        $param['tiempo'][]=strtotime($tiempo['fecha2']);

        $param['sql']="SELECT K.key as 'Actividad'";
        $param['key']="SELECT l.name as 'key' from levels l";
        $param['meta']="SELECT l.name as 'key',ifnull(Round(AVG(hd.employees)*sum(hd.working_hours_at_month),0),0) as'Meta' from levels l left join hours_data hd on l.id=hd.level_id where hd.date %param% group by l.id";
        $param['realizado']="SELECT l.name as 'key',(sum(ad.number))as 'Realizado' from absences_data ad inner join levels l on l.id=ad.level_id where ad.date %param% group by l.id ";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = ''; 
       
        if(isset($result['titulos'])){
          foreach ($result['titulos'] as $key) {
            $titulos[] = ($key=='M')?'L':(($key=='R')?'A':$key);
          }
          $datos['meta']=[
            'values' => $this->registros(),
            'titulo' => $titulos,
            'tituloE'=>$result['meses']
          ];
        }
        else{
          foreach ($result['meses'] as $k) {
            $titulos[] = $k;
          }
          $datos['meta']=[
            'values' => $this->registros(),
            'titulo' => $titulos,
          ];
        }
      }
      return $datos;
    }
    public function referencias($tiempo){
      $fecha1=$tiempo['fecha1'];
      $fecha2=$tiempo['fecha2'];

      $sql = "SELECT l.name as 'Nivel',ifnull(A.referencias,0) as 'Referencias' from levels l left join 
      (Select s.level_id as 'key', sum(r.number) as 'referencias' from reference r inner join specialties s on s.id=r.specialty_id where r.date between '$fecha1' and '$fecha2' group by s.level_id) A on l.id=A.key where l.id<>5";
      $this->query($sql);
      if($tiempo['separador']=="1"){
        $datos['nivel']=[
          'values' => $this->registros(),
          'titulo' => ['Nivel','Total de Referencias'],
          'titulosG' => ['Referencias'],
        ];
        $sql="SELECT p.name as 'Título',ifnull(A.dato,0) as 'Value' from place p left join(SELECT sum(r.number) as 'dato',r.place_id as 'key' from reference r where r.date between '$fecha1' and '$fecha2' group by r.place_id)A on p.id=A.key UNION ALL
          SELECT '<b>Total</b>',ifnull(B.dato,0) from (SELECT sum(r.number) as 'dato',r.place_id as 'key' from reference r where r.date between '$fecha1' and '$fecha2')B ;";

        $this->query($sql);
        
        $datos['hospital']=[
          'values' => $this->registros(),
          'titulo' => ['Lugar','Cantidad'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
          'titulosG' => ['Referencias'],
        ];
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.titulo as 'Nivel'";
        $param['key']="SELECT l.name as titulo, l.id as 'key' from levels l where l.id<>5 UNION ALL 
          select '<b>Total</b>' as 'Título', -1 as 'key'";
        $param['meta']="SELECT s.level_id as 'key', sum(r.number)as 'Meta' from reference r inner join specialties s on s.id=r.specialty_id where r.date %param% group by s.level_id UNION ALL
          SELECT -1 as 'key',sum(r.number) as 'Meta' from reference r where r.date %param%";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos=[];
        $titulos[] = 'Nivel';
        foreach ($result['meses'] as $k) {
          $titulos[] = $k;
        }
        $datos['nivel']=[
          'values' => $this->registros(),
          'titulo' => $titulos,
        ];

        //Por Hospital

        $param['sql']="SELECT K.Título as 'Lugar'";
        $param['key']="SELECT p.name as 'Título',p.id as 'key' from place p UNION ALL 
          select '<b>Total</b>' as 'Título', -1 as 'key'";
        $param['meta']="SELECT sum(r.number) as 'Meta',r.place_id as 'key' from reference r where r.date %param% group by r.place_id UNION ALL
          SELECT sum(r.number) as 'Meta',-1 as 'key' from reference r where r.date %param%";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[0] = 'Lugar';
        $datos['hospital']=[
          'values' => $this->registros(),
          'titulo' => $titulos,
        ];
      }

      return $datos;
    }
    public function administracion($tiempo){
      if($tiempo['separador']=="1"){
        $sql = "SELECT * from (SELECT A.Actividades,ifnull(B.N4,0) as 'Nivel4',ifnull(C.N5,0) as 'Nivel5',ifnull(D.N6,0)as 'Nivel6',ifnull(E.N7,0)as 'Nivel7',(ifnull(B.N4,0)+ifnull(C.N5,0)+ifnull(D.N6,0)+ifnull(E.N7,0)) as 'Total' from 
        (Select a.id as 'Nivel',a.activities as 'Actividades' from administrative_management a) A left join 
        (SELECT ad.administrative_management_id as 'niv', sum(ad.number) as'N4' from administrative_management_data  ad where ad.level_id=1 and ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by niv) B 
        on A.Nivel=B.niv left join (".
        "SELECT ad.administrative_management_id as 'niv', sum(ad.number) as'N5' from administrative_management_data ad where ad.level_id=2 and ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by niv) C 
        on A.Nivel=C.niv left join (".
        "SELECT ad.administrative_management_id as 'niv', sum(ad.number) as'N6' from administrative_management_data ad where ad.level_id=3 and ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by niv) D 
        on A.Nivel=D.niv left join (".
        "SELECT ad.administrative_management_id as 'niv', sum(ad.number) as'N7' from administrative_management_data  ad where ad.level_id=4 and ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by niv) E 
        on A.Nivel=E.niv 
        )F ;";
        $this->query($sql);
        $titulos=['Actividad','Nivel 4','Nivel 5','Nivel 6','Nivel 7','Total'];
      }
      else{
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.Actividades as 'Actividad'";
        $param['key']="SELECT a.id as 'key',a.activities as 'Actividades' from administrative_management a";
        $param['meta']="SELECT ad.administrative_management_id as 'key', sum(ad.number) as'Meta' from administrative_management_data ad where ad.date %param% group by ad.administrative_management_id";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = 'Actividad'; 
       
        foreach ($result['meses'] as $k) {
          $titulos[] = $k;
        }
      }
      $datos=[
        'values' => $this->registros(),
        'titulo' => $titulos,
      ];
      return $datos;
    }//¿Enfermería?
    public function administracion2($tiempo){
      if($tiempo['separador']=="1"){
        $sql = "SELECT * from (SELECT A.Actividades,ifnull(B.N4,0) as 'Nivel4',ifnull(C.N5,0) as 'Nivel5',ifnull(D.N6,0)as 'Nivel6',ifnull(E.N7,0)as 'Nivel7',(ifnull(B.N4,0)+ifnull(C.N5,0)+ifnull(D.N6,0)+ifnull(E.N7,0)) as 'Total' from 
        (Select a.id as 'Nivel',a.activities as 'Actividades' from management a) A left join 
        (SELECT ad.management_id as 'niv', sum(ad.number) as'N4' from management_data  ad where ad.level_id=1 and ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by niv) B 
        on A.Nivel=B.niv left join (".
        "SELECT ad.management_id as 'niv', sum(ad.number) as'N5' from management_data ad where ad.level_id=2 and ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by niv) C 
        on A.Nivel=C.niv left join (".
        "SELECT ad.management_id as 'niv', sum(ad.number) as'N6' from management_data ad where ad.level_id=3 and ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by niv) D 
        on A.Nivel=D.niv left join (".
        "SELECT ad.management_id as 'niv', sum(ad.number) as'N7' from management_data  ad where ad.level_id=4 and ad.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by niv) E 
        on A.Nivel=E.niv 
        )F ;";
        $this->query($sql);
        $titulos=['Actividad','Nivel 4','Nivel 5','Nivel 6','Nivel 7','Total'];
      }
      else{
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.Actividades as 'Actividad'";
        $param['key']="SELECT a.id as 'key',a.activities as 'Actividades' from management a";
        $param['meta']="SELECT ad.management_id as 'key', sum(ad.number) as'Meta' from management_data ad where ad.date %param% group by ad.management_id";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = 'Actividad'; 
       
        foreach ($result['meses'] as $k) {
          $titulos[] = $k;
        }
      }
      $datos=[
        'values' => $this->registros(),
        'titulo' => $titulos,
      ];
      return $datos;
    }
    public function epidemiologia($tiempo){
      $fecha1=date('Y-m-1');
      $fecha2=date('Y-m-t');
      if(isset($tiempo['tipo'])){
        if($tiempo['tipo']=='Per'){
          $fecha1=$tiempo['fecha1'];
          $fecha2=$tiempo['fecha2'];
        }
        else if ($tiempo['tipo']=='Year'){
          $fecha1=date("Y-01-01");
          $fecha2=date("Y-12-31");
        }
      }
      $separador=(isset($tiempo['separador']))?$tiempo['separador']:"1";
      if($separador=="1"){
        $sql = "SELECT e.activities as 'title',ifnull(ed.number,0) as 'value' from epidemiology e left join epidemiology_data ed on e.id=ed.epidemiology_id and ed.date between '$fecha1' and '$fecha2'";
        $this->query($sql);
        $titulos=['Actividad','Total'];
      }
      else{
        $temp[]=strtotime($fecha1);
        $temp[]=strtotime($fecha2);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.Actividades as 'Actividad'";
        $param['key']="SELECT e.id as 'key',e.activities as 'Actividades' from epidemiology e";
        $param['meta']="SELECT ed.epidemiology_id as 'key', sum(ed.number) as'Meta' from epidemiology_data ed where ed.date %param% group by ed.epidemiology_id";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = 'Actividad'; 
       
        foreach ($result['meses'] as $k) {
          $titulos[] = $k;
        }
      }
      $datos=[
        'values' => $this->registros(),
        'titulo' => $titulos,
      ];
      return $datos;
    }
    public function salud($tiempo){
      $fecha1=$tiempo['fecha1'];
      $fecha2=$tiempo['fecha2'];

      $sql = "SELECT A.Nivel as 'Actividad',ifnull(C.Meta,0) as 'Meta',ifnull(B.Realizado,0) as 'Realizado', ROUND(ifnull((ifnull(B.Realizado,0)/ifnull(C.Meta,ifnull(B.Realizado,1)))*100,0),2) as 'Porcentaje',ifnull(D.listeners,0) as 'Sumando' from 
      (Select l.name as 'Nivel',l.id as 'key' from levels l) A left join 
      (SELECT hed.level_id as 'niv', count(hed.id) as'Realizado' from health_education_data hed where hed.health_education_id=1 and hed.status='Realizada' and hed.created_at between '$fecha1' and '$fecha2' group by hed.level_id) B 
      on A.key=B.niv left join (".
      "SELECT hed.level_id as 'niv', count(hed.id) as'Meta' from health_education_data hed where hed.health_education_id=1 and hed.created_at between '$fecha1' and '$fecha2' group by hed.level_id) C 
      on A.key=C.niv  left join (".
      "SELECT hed.level_id as 'niv',sum(hed.listeners) as listeners from health_education_data hed where hed.health_education_id=1 and hed.created_at between '$fecha1' and '$fecha2' group by hed.level_id) D on A.key=D.niv";
      $this->query($sql);

      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['','Meta','Realizado','% Porcentaje','Oyentes'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
        ];
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.titulo as 'Actividad'";
        $param['key']="SELECT l.name as titulo, l.id as 'key' from levels l";
        $param['meta']="SELECT hed.level_id as 'key', count(hed.id) as'Meta' from health_education_data hed where hed.health_education_id=1 and hed.created %param% group by hed.level_id";
        $param['realizado']="SELECT hed.level_id as 'key', count(hed.id) as'Realizado' from health_education_data hed where hed.health_education_id=1 and hed.status='Realizada' and hed.created %param% group by hed.level_id";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = ''; 
       
        foreach ($result['titulos'] as $key) {
          $titulos[] = $key;
        }
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => $titulos,
          'tituloE'=>$result['meses']
        ];
      }

      $sql="SELECT 'Educación en Salud' as Actividad,ifnull(E.Aux,0) as 'Meta',ifnull(A.Realizado,0)as 'Realizado',ifnull(ROUND((ifnull(A.Realizado,0)/ifnull(E.Aux,1))*100,2),0) as 'Porcentaje' from health_education he left join (SELECT count(hed.id) as 'Realizado' from health_education_data hed where hed.health_education_id=1 and status='Realizada' and hed.created_at between '$fecha1' and '$fecha2')A on he.id=1 left join (SELECT count(hed.id) as 'Aux' from health_education_data hed where hed.health_education_id=1 and hed.created_at between '$fecha1' and '$fecha2')E on he.id=1 where he.id=1";

      $this->query($sql);

      $datos['total']=[
        'values' => $this->registros(),
        'titulo' => ['','Meta','Realizado','% Porcentaje'],
      ];

      $sql="SELECT hed.description as Actividad,count(hed.description) as 'Realizadas', sum(hed.listeners) as 'Oyentes' from health_education_data hed where hed.health_education_id=1 and hed.status='Realizada' and hed.created_at between '$fecha1' and '$fecha2' group by Actividad";

      $this->query($sql);
      $datos['oyentes']=[
        'values' => $this->registros(),
        'titulo' => ['Tema','Realizadas','Oyentes'],
      ];
      
      return $datos;
    }
    public function charlas($tiempo){
      $fecha1=$tiempo['fecha1'];
      $fecha2=$tiempo['fecha2'];

      $sql = "SELECT A.Nivel as 'Actividad',ifnull(C.Meta,0) as 'Meta',ifnull(B.Realizado,0) as 'Realizado', ROUND(ifnull((ifnull(B.Realizado,0)/ifnull(C.Meta,ifnull(B.Realizado,1)))*100,0),2) as 'Porcentaje',ifnull(D.listeners,0) as 'Sumando' from 
        (Select l.name as 'Nivel',l.id as 'key' from levels l) A left join 
        (SELECT hed.level_id as 'niv', count(hed.id) as'Realizado' from health_education_data hed where hed.health_education_id=2 and hed.status='Realizada' and hed.created_at between '$fecha1' and '$fecha2' group by hed.level_id) B 
        on A.key=B.niv left join (".
        "SELECT hed.level_id as 'niv', count(hed.id) as'Meta' from health_education_data hed where hed.health_education_id=2 and hed.created_at between '$fecha1' and '$fecha2' group by hed.level_id) C 
        on A.key=C.niv  left join (".
        "SELECT hed.level_id as 'niv',sum(hed.listeners) as listeners from health_education_data hed where hed.health_education_id=2 and hed.created_at between '$fecha1' and '$fecha2' group by hed.level_id) D on A.key=D.niv";
      $this->query($sql);

      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['','Meta','Realizado','% Porcentaje','Oyentes'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
        ];
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT K.titulo as 'Actividad'";
        $param['key']="SELECT l.name as titulo, l.id as 'key' from levels l";
        $param['meta']="SELECT hed.level_id as 'key', count(hed.id) as'Meta' from health_education_data hed where hed.health_education_id=2 and hed.created %param% group by hed.level_id";
        $param['realizado']="SELECT hed.level_id as 'key', count(hed.id) as'Realizado' from health_education_data hed where hed.health_education_id=2 and hed.status='Realizada' and hed.created %param% group by hed.level_id";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = ''; 
       
        foreach ($result['titulos'] as $key) {
          $titulos[] = $key;
        }
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => $titulos,
          'tituloE'=>$result['meses']
        ];
      }

      $sql="SELECT 'Charlas Informativas' as Actividad,ifnull(E.Aux,0) as 'Meta',ifnull(A.Realizado,0)as 'Realizado',ifnull(ROUND((ifnull(A.Realizado,0)/ifnull(E.Aux,1))*100,2),0) as 'Porcentaje' from health_education he left join (SELECT count(hed.id) as 'Realizado' from health_education_data hed where hed.health_education_id=2 and status='Realizada' and hed.created_at between '$fecha1' and '$fecha2')A on he.id=2 left join (SELECT count(hed.id) as 'Aux' from health_education_data hed where hed.health_education_id=2 and hed.created_at between '$fecha1' and '$fecha2')E on he.id=2 where he.id=2";

      $this->query($sql);

      $datos['total']=[
        'values' => $this->registros(),
        'titulo' => ['','Meta','Realizado','% Porcentaje'],
      ];

      $sql="SELECT hed.description as Actividad,count(hed.description) as 'Realizadas', sum(hed.listeners) as 'Oyentes' from health_education_data hed where hed.health_education_id=2 and hed.status='Realizada' and hed.created_at between '$fecha1' and '$fecha2' group by Actividad";

      $this->query($sql);
      $datos['oyentes']=[
        'values' => $this->registros(),
        'titulo' => ['Tema','Realizadas','Oyentes'],
      ];
      
      return $datos;
    }
    public function continua($tiempo){
      $fecha1=$tiempo['fecha1'];
      $fecha2=$tiempo['fecha2'];

      $sql="SELECT 'Educación Continua' as Actividad,ifnull(E.Aux,0) as 'Meta',ifnull(A.Realizado,0)as 'Realizado',ifnull(ROUND((ifnull(A.Realizado,0)/ifnull(E.Aux,1))*100,2),0) as 'Porcentaje' from health_education he left join (SELECT count(hed.id) as 'Realizado' from health_education_data hed where hed.health_education_id=3 and status='Realizada' and hed.created_at between '$fecha1' and '$fecha2')A on he.id=3 left join (SELECT count(hed.id) as 'Aux' from health_education_data hed where hed.health_education_id=3 and hed.created_at between '$fecha1' and '$fecha2')E on he.id=3 where he.id=3";

      $this->query($sql);
      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['','Meta','Realizado','% Porcentaje'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
        ];
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT 'Educación Continua' as 'Actividad'";
        $param['key']="SELECT he.id as 'key' from health_education he where he.id=3";
        $param['meta']="SELECT count(hed.id) as 'Meta',3 as 'key' from health_education_data hed where hed.health_education_id=3 and hed.created_at";
        $param['realizado']="SELECT count(hed.id) as 'Realizado', 3 as 'key' from health_education_data hed where hed.health_education_id=3 and status='Realizada' and hed.created_at %param% ";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = ''; 
       
        foreach ($result['titulos'] as $key) {
          $titulos[] = $key;
        }
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => $titulos,
          'tituloE'=>$result['meses']
        ];
      }
      $sql="SELECT hed.description as Actividad,count(hed.description) as 'Realizadas',Concat(Concat('<ul style=\'text-align:left;\'><li><b>',Concat(Concat(ifnull(A.l1,0),'</b> Enfermería</li><li><b>'),Concat(ifnull(A.l2,0),'</b> Colaboradores Clínicos</li><li><b>'))),Concat(Concat(Concat(ifnull(A.l3,0),'</b> Recepcionistas</li><li><b>'),Concat(ifnull(A.l4,0),'</b> Aux. de Servicio</li><li><b>')),Concat(Concat(ifnull(A.l5,0),'</b> Técnicos de Farmacia</li><li><b>'),Concat(ifnull(A.l6,0),'</b> Aux. de Servicio de la Empresa Premium</li></ul>')))) as 'Personal' from health_education_data hed left join (SELECT sum(l.ENFERMERIA) as l1,sum(l.`COLABORADORES CLINICOS`) as l2,sum(l.RECEPCIONISTAS) as l3,sum(l.`AUX. DE SERVICIO`) as l4,sum(l.`TECNICOS DE FARMACIA`) as l5,sum(l.`AUX. DE SERVICIO DE LA EMPRESA PREMIUM`) as l6,hed.description as id from listeners l inner join health_education_data hed on hed.id=l.health_education_data_id group by hed.description)A on hed.description=A.id 
       where hed.health_education_id=3 and hed.status='Realizada' and hed.created_at between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by Actividad";

      $this->query($sql);
      $datos['personal']=[
        'values' => $this->registros(),
        'titulo' => ['Tema','Realizadas','Personal'],
      ];
      //Título y Value
      $sql="SELECT ifnull(sum(ENFERMERIA),0),ifnull(sum(`COLABORADORES CLINICOS`),0),ifnull(sum(RECEPCIONISTAS),0),ifnull(sum(`AUX. DE SERVICIO`),0),ifnull(sum(`TECNICOS DE FARMACIA`),0),ifnull(sum(`AUX. DE SERVICIO DE LA EMPRESA PREMIUM`),0) from listeners l inner join health_education_data hed on hed.id=5 and hed.status='Realizada' and hed.created_at between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."'";
      $this->query($sql);
      $data = $this->registros();
      $valor = ['Enfermería','Colaboradores Clínicos','Recepcionistas','Auxiliares de Servicio','Técnicos de Farmacia','Aux. de Servicio de la Empresa Premium'];
      $i=0;
      foreach ($data as $key) {
        foreach ($key as $value) {
          $aux = new stdClass();
          $aux->Título=$valor[$i];
          $aux->Value=$value;
          $aux->id=$i;
          $valores[]= $aux;
          $i++;
        }
      }
      $datos['grafico']=[
        'values' => $valores,
      ];
      return $datos;
    }
    public function continuaEpidemiologia($tiempo){
      $fecha1=$tiempo['fecha1'];
      $fecha2=$tiempo['fecha2'];

      $sql="SELECT 'Educación Continua por Epidemiología' as Actividad,ifnull(E.Aux,0) as 'Meta',ifnull(A.Realizado,0)as 'Realizado',ifnull(ROUND((ifnull(A.Realizado,0)/ifnull(E.Aux,1))*100,2),0) as 'Porcentaje' from health_education he left join (SELECT count(hed.id) as 'Realizado' from health_education_data hed where hed.health_education_id=5 and status='Realizada' and hed.created_at between '$fecha1' and '$fecha2')A on he.id=5 left join (SELECT count(hed.id) as 'Aux' from health_education_data hed where hed.health_education_id=5 and hed.created_at between '$fecha1' and '$fecha2')E on he.id=5 where he.id=5";

      $this->query($sql);

      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['','Meta','Realizado','% Porcentaje'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
        ];
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT 'Educación Continua' as 'Actividad'";
        $param['key']="SELECT he.id as 'key' from health_education he where he.id=5";
        $param['meta']="SELECT count(hed.id) as 'Meta',5 as 'key' from health_education_data hed where hed.health_education_id=5 and hed.created_at";
        $param['realizado']="SELECT count(hed.id) as 'Realizado', 5 as 'key' from health_education_data hed where hed.health_education_id=5 and status='Realizada' and hed.created_at %param% ";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = ''; 
       
        foreach ($result['titulos'] as $key) {
          $titulos[] = $key;
        }
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => $titulos,
          'tituloE'=>$result['meses']
        ];
      }
      $sql="SELECT hed.description as Actividad,count(hed.description) as 'Realizadas',Concat(Concat('<ul style=\'text-align:left;\'><li><b>',Concat(Concat(ifnull(A.l1,0),'</b> Enfermería</li><li><b>'),Concat(ifnull(A.l2,0),'</b> Colaboradores Clínicos</li><li><b>'))),Concat(Concat(Concat(ifnull(A.l3,0),'</b> Recepcionistas</li><li><b>'),Concat(ifnull(A.l4,0),'</b> Aux. de Servicio</li><li><b>')),Concat(Concat(ifnull(A.l5,0),'</b> Técnicos de Farmacia</li><li><b>'),Concat(ifnull(A.l6,0),'</b> Aux. de Servicio de la Empresa Premium</li></ul>')))) as 'Personal' from health_education_data hed left join (SELECT sum(l.ENFERMERIA) as l1,sum(l.`COLABORADORES CLINICOS`) as l2,sum(l.RECEPCIONISTAS) as l3,sum(l.`AUX. DE SERVICIO`) as l4,sum(l.`TECNICOS DE FARMACIA`) as l5,sum(l.`AUX. DE SERVICIO DE LA EMPRESA PREMIUM`) as l6,hed.description as id from listeners l inner join health_education_data hed on hed.id=l.health_education_data_id group by hed.description)A on hed.description=A.id 
       where hed.health_education_id=5 and hed.status='Realizada' and hed.created_at between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by Actividad";

      $this->query($sql);
      $datos['personal']=[
        'values' => $this->registros(),
        'titulo' => ['Tema','Realizadas','Personal'],
      ];
      //Título y Value
      $sql="SELECT ifnull(sum(ENFERMERIA),0),ifnull(sum(`COLABORADORES CLINICOS`),0),ifnull(sum(RECEPCIONISTAS),0),ifnull(sum(`AUX. DE SERVICIO`),0),ifnull(sum(`TECNICOS DE FARMACIA`),0),ifnull(sum(`AUX. DE SERVICIO DE LA EMPRESA PREMIUM`),0) from listeners l inner join health_education_data hed on hed.id=5 and hed.status='Realizada' and hed.created_at between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."'";
      $this->query($sql);
      $data = $this->registros();
      $valor = ['Enfermería','Colaboradores Clínicos','Recepcionistas','Auxiliares de Servicio','Técnicos de Farmacia','Aux. de Servicio de la Empresa Premium'];
      $i=0;
      foreach ($data as $key) {
        foreach ($key as $value) {
          $aux = new stdClass();
          $aux->Título=$valor[$i];
          $aux->Value=$value;
          $aux->id=$i;
          $valores[]= $aux;
          $i++;
        }
      }
      $datos['grafico']=[
        'values' => $valores,
      ];
      return $datos;
    }
    public function continuaOftalmologia($tiempo){
     
      $fecha1=$tiempo['fecha1'];
      $fecha2=$tiempo['fecha2'];

      $sql="SELECT 'Educación Continua por Oftalmología' as Actividad,ifnull(E.Aux,0) as 'Meta',ifnull(A.Realizado,0)as 'Realizado',ifnull(ROUND((ifnull(A.Realizado,0)/ifnull(E.Aux,1))*100,2),0) as 'Porcentaje' from health_education he left join (SELECT count(hed.id) as 'Realizado' from health_education_data hed where hed.health_education_id=4 and status='Realizada' and hed.created_at between '$fecha1' and '$fecha2')A on he.id=4 left join (SELECT count(hed.id) as 'Aux' from health_education_data hed where hed.health_education_id=4 and hed.created_at between '$fecha1' and '$fecha2')E on he.id=4 where he.id=4";

      $this->query($sql);

      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['','Meta','Realizado','% Porcentaje'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
        ];
        $temp[]=strtotime($tiempo['fecha1']);
        $temp[]=strtotime($tiempo['fecha2']);

        $param['tiempo']=$temp;
        $param['sql']="SELECT 'Educación Continua' as 'Actividad'";
        $param['key']="SELECT he.id as 'key' from health_education he where he.id=4";
        $param['meta']="SELECT count(hed.id) as 'Meta',4 as 'key' from health_education_data hed where hed.health_education_id=4 and hed.created_at";
        $param['realizado']="SELECT count(hed.id) as 'Realizado', 4 as 'key' from health_education_data hed where hed.health_education_id=4 and status='Realizada' and hed.created_at %param% ";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = ''; 
       
        foreach ($result['titulos'] as $key) {
          $titulos[] = $key;
        }
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => $titulos,
          'tituloE'=>$result['meses']
        ];
      }
      $sql="SELECT hed.description as Actividad,count(hed.description) as 'Realizadas',Concat(Concat('<ul style=\'text-align:left;\'><li><b>',Concat(Concat(ifnull(A.l1,0),'</b> Enfermería</li><li><b>'),Concat(ifnull(A.l2,0),'</b> Colaboradores Clínicos</li><li><b>'))),Concat(Concat(Concat(ifnull(A.l3,0),'</b> Recepcionistas</li><li><b>'),Concat(ifnull(A.l4,0),'</b> Aux. de Servicio</li><li><b>')),Concat(Concat(ifnull(A.l5,0),'</b> Técnicos de Farmacia</li><li><b>'),Concat(ifnull(A.l6,0),'</b> Aux. de Servicio de la Empresa Premium</li></ul>')))) as 'Personal' from health_education_data hed left join (SELECT sum(l.ENFERMERIA) as l1,sum(l.`COLABORADORES CLINICOS`) as l2,sum(l.RECEPCIONISTAS) as l3,sum(l.`AUX. DE SERVICIO`) as l4,sum(l.`TECNICOS DE FARMACIA`) as l5,sum(l.`AUX. DE SERVICIO DE LA EMPRESA PREMIUM`) as l6,hed.description as id from listeners l inner join health_education_data hed on hed.id=l.health_education_data_id group by hed.description)A on hed.description=A.id 
       where hed.health_education_id=4 and hed.status='Realizada' and hed.created_at between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by Actividad";

      $this->query($sql);
      $datos['personal']=[
        'values' => $this->registros(),
        'titulo' => ['Tema','Realizadas','Personal'],
      ];
      //Título y Value
      $sql="SELECT ifnull(sum(ENFERMERIA),0),ifnull(sum(`COLABORADORES CLINICOS`),0),ifnull(sum(RECEPCIONISTAS),0),ifnull(sum(`AUX. DE SERVICIO`),0),ifnull(sum(`TECNICOS DE FARMACIA`),0),ifnull(sum(`AUX. DE SERVICIO DE LA EMPRESA PREMIUM`),0) from listeners l inner join health_education_data hed on hed.id=4 and hed.status='Realizada' and hed.created_at between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."'";
      $this->query($sql);
      $data = $this->registros();
      $valor = ['Enfermería','Colaboradores Clínicos','Recepcionistas','Auxiliares de Servicio','Técnicos de Farmacia','Aux. de Servicio de la Empresa Premium'];
      $i=0;
      foreach ($data as $key) {
        foreach ($key as $value) {
          $aux = new stdClass();
          $aux->Título=$valor[$i];
          $aux->Value=$value;
          $aux->id=$i;
          $valores[]= $aux;
          $i++;
        }
      }
      $datos['grafico']=[
        'values' => $valores,
      ];
      return $datos;
    }
    public function reuniones($tiempo){
      $sql = "SELECT * from (SELECT A.Titulo,ifnull(B.Meta,0) as 'Meta',ifnull(C.Realizado,0) as 'Realizado', ROUND(ifnull((C.Realizado/B.Meta)*100,0),2) as 'Porcentaje' from 
        (SELECT l.name as 'Titulo',l.id as 'Nivel' from levels l) A left join 
        (SELECT am.level_id as 'niv', count(am.id) as'Meta' from administrative_meetings am where am.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by am.level_id) B 
        on A.Nivel=B.niv left join (".
        "SELECT am.level_id as 'niv', count(am.id) as'Realizado' from administrative_meetings am where am.status='Realizada' and am.date between '".$tiempo['fecha1']."' and '".$tiempo['fecha2']."' group by am.level_id) C 
        on A.Nivel=C.niv
        )F ";
      $this->query($sql);
      if($tiempo['separador']=="1"){
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => ['Nivel','Meta','Realizado','% Realización'],
          'titulosG' => ['Meta','Realizado'],
        ];
      }
      else{
        $datos['graf']=[
          'values' => $this->registros(),
          'titulosG' => ['Meta','Realizado'],
        ];
        $param['tiempo'][]=strtotime($tiempo['fecha1']);
        $param['tiempo'][]=strtotime($tiempo['fecha2']);

        $param['sql']="SELECT K.Titulo as 'Nivel'";
        $param['key']="SELECT l.name as 'Titulo',l.id as 'key' from levels l";
        $param['meta']="SELECT am.level_id as 'key', count(am.id) as'Meta' from administrative_meetings am where am.date %param% group by am.level_id";
        $param['realizado']="SELECT am.level_id as 'key', count(am.id) as'Realizado' from administrative_meetings am where am.status='Realizada' and am.date %param% group by am.level_id ";
        $result=$this->separador($param);
        $this->query($result['sql']);
        $titulos[] = ''; 
       
        foreach ($result['titulos'] as $key) {
          $titulos[] = $key;
        }
        $datos['meta']=[
          'values' => $this->registros(),
          'titulo' => $titulos,
          'tituloE'=>$result['meses']
        ];
      }
      return $datos;
    }

      //Generador de Query
    private function separador($param){
      //Tiempo
      $tiempo= $param['tiempo'];
      $aux=new DateTime(date("Y-m-1",$tiempo[0]));
      $diferencia = $aux->diff(new DateTime(date("Y-m-1",$tiempo[1])));
      $meses = ( $diferencia->y * 12 ) + $diferencia->m;
      if($meses==0||$diferencia->d<10)
        $meses++;
      else{
        $meses=$meses+2;
      }
      if($meses>12)
        $meses=12;
      $inicio=$param['sql'];
      for ($i=0; $i < $meses; $i++) { 
        $inicio=$inicio.', ifnull(A'.$i.'.Meta,';
        if(isset($param['realizado']))
          $inicio=$inicio.'ifnull(B'.$i.'.Realizado,0)), 
          ifnull(B'.$i.'.Realizado,0),ifnull(ROUND((ifnull(B'.$i.'.Realizado,0)/ifnull(A'.$i.'.Meta,ifnull(B'.$i.'.Realizado,1)))*100,1),0)';
        else
          $inicio=$inicio.'0)';
      }
      $sql=$inicio." from (".$param['key'].")K ";
      for ($i=0; $i < $meses; $i++) { 
        //Varía el tiempo
        $fecha1 = $aux->format('Y-m-d');
        $fecha2=date("Y-m-t",strtotime($fecha1));
          $Mes[] = ucfirst(strftime('%B %Y',strtotime($fecha1)));
         // $Mes[] = date('F Y',strtotime($aux->format('Y-m-d')));
          $aux->add(new DateInterval('P1M'));
          //Construye
          $reemplazo="between '".$fecha1."' and '".$fecha2."'";
        $sql=$sql.' left join('.str_replace('%param%', $reemplazo, $param['meta']).')A'.$i.' on K.key=A'.$i.'.key ';
        if(isset($param['realizado']))
        $sql=$sql.' left join('.str_replace('%param%', $reemplazo, $param['realizado']).')B'.$i.' on K.key=B'.$i.'.key ';
      }
      $retorno = [
        'sql' => $sql,
        'meses' =>$Mes,
      ];
      if(isset($param['realizado'])){
        for ($i=0; $i < $meses; $i++) {
          $titulos[]='M';          
          $titulos[]='R';          
          $titulos[]='%';          
        }
        $retorno['titulos'] =$titulos;
      }
      
      return $retorno;
    }
    public function nombreEspecialidad($Especialidad){
      $sql="SELECT name from specialties where name LIKE '$Especialidad%' LIMIT 1";
      $this->query($sql);
      return $this->registro();
    }
}