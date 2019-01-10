
<?php
 class MantenimientosModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }
    //Procedimientos
    public function insertarProcedimiento($dato,$nombre,$tiempo=0){
      if($dato!=0){
        $dato=($dato<0)?0:$dato;
        echo $params;
      	$sql = "INSERT into procedure_data values (null, :dato,".(($tiempo==0)?"curdate()":("'".$tiempo."'")).",".$nombre.")ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$dato);
        return $this->execute();
      }
    }
    public function insertarLevelThings($nivel,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        echo $params;
        $sql = "INSERT into level_things_data values (null, :dato, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).", :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarSpecialtyThings($especialidad,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into specialty_things_data values (null, :dato, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).", :id,(select id from specialties where id = ".$especialidad.")) ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarGoal($especialidad,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into goals values(null,:dato,".(($tiempo==0)?"curdate()":("'".$tiempo."'")).",:id) ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarAusentismo($nivel,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into absences_data values (null, :dato, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).", :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function configurarAusentismo($nivel,$params,$tiempo=0){
      $sql = "INSERT into hours_data values (null, :dato1, :dato2, :dato3, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).",(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE employees=:dato1,working_hours_at_month=:dato2,working_hours_at_period=:dato3;";
      $this->query($sql);
      $this->bind(':dato1',$params[0]);
      $this->bind(':dato2',$params[1]);
      $this->bind(':dato3',$params[2]);
      return $this->execute();
    }
    public function insertarAdministrativo($nivel,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into administrative_management_data values (null, :dato, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).", :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarCharla($nivel,$params,$id,$fecha){
      $sql = "INSERT into health_education_data values (null, :dato,'Programada', :id,(select id from levels where name like '%".$nivel."%'),0, '".$fecha."',Now());";
      $this->query($sql);
      $this->bind(':dato',$params);
      $this->bind(':id',$id);
      return $this->execute();
    }
    public function insertarInvestigacion($nivel,$name,$desc,$status,$fecha){
      $sql = "INSERT into investigations values (null, :dato,:desc,:status, '$fecha',(select id from levels where name like '%$nivel%'));";
      $this->query($sql);
      $this->bind(':dato',$name);
      $this->bind(':desc',$desc);
      $this->bind(':status',$status);
      return $this->execute();
    }
    public function insertarGoalCharla($id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into goals_health values(null,:dato,".(($tiempo==0)?"curdate()":("'".$tiempo."'")).",:id) ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function actualizarCharla($params){
      $sql = "UPDATE health_education_data SET description =:descripcion,status=:estado,health_education_id=:he_id,updated_at=Now(),created_at=:date where id=:id;";
      $this->query($sql);
      $this->bind(':descripcion',$params['fname']);
      $this->bind(':estado',$params['estado']);
      $this->bind(':he_id',$params['tipo']);
      $this->bind(':date',$params['fechaC']);
      $this->bind(':id',$params['id']);
      return $this->execute();
    }
    public function actualizarEducacion($id,$params){
      if(count($params)>5){
        $sql = "INSERT into listeners values (null, :dato1, :dato2, :dato3, :dato4, :dato5, :dato6, :id)ON DUPLICATE KEY UPDATE ENFERMERIA=:dato1,`COLABORADORES CLINICOS`=:dato2,RECEPCIONISTAS=:dato3,`AUX. DE SERVICIO`=:dato4,`TECNICOS DE FARMACIA`=:dato5, `AUX. DE SERVICIO DE LA EMPRESA PREMIUM`=:dato6;";
        $this->query($sql);
        $this->bind(':dato2',$params[1]);
        $this->bind(':dato3',$params[2]);
        $this->bind(':dato4',$params[3]);
        $this->bind(':dato5',$params[4]);
        $this->bind(':dato6',$params[5]);
      }
      else{
        $sql="UPDATE health_education_data set listeners=:dato1,updated_at=Now(),status='Realizada' where id=:id";
        $this->query($sql);
      }

      $this->bind(':dato1',$params[0]);
      $this->bind(':id',$id);
      return $this->execute();
    }
    public function actualizarInvestigacion($params){
      $sql = "UPDATE investigations SET name=:name,description=:descripcion,status=:estado,date=:date where id=:id;";
      $this->query($sql);
      $this->bind(':descripcion',$params['description']);
      $this->bind(':estado',$params['estado']);
      $this->bind(':name',$params['fname']);
      $this->bind(':date',$params['fechaC']);
      $this->bind(':id',$params['id']);
      return $this->execute();
    }
    /*
      ************************
      * Carga de Formularios *
      ************************
    */
    public function specialities($level){
      $sql = "SELECT s.name as 'title', s.id as 'id' from specialties s inner join levels l on s.level_id = l.id where l.name like '%".$level."%'";
      $this->query($sql);
      return $this->registros();
     }
    public function levelThings(){
      $sql = "SELECT name as 'title', id as 'id' from level_things;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      } 
    public function specialtyThings(){
      $sql = "SELECT name as 'title', id as 'id' from specialty_things;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      } 
    public function absences(){
      $sql = "SELECT type as 'title', id as 'id' from absences;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      }
    public function absences_config(){
      $valor = ['Empleados en Enfermería','Horas laborales del mes','Horas laborales del periodo'];

      for ($i=0; $i < count($valor); $i++) { 
        $aux = new stdClass();
        $aux->title=$valor[$i];
        $aux->id=$i;
        $valores[]= $aux;
      }
      $formulario = [
        'TítulosX' => ['Configurar','Cantidad'],
        'TítulosY' => $valores,
      ];
      return $formulario;
      }
    public function procedures($nivel,$specialties){
      $retornar=[];
      foreach ($specialties as $key) {
        $sql = "SELECT name as 'title', id as 'id' from procedures where specialty_id = ".$key->id.";";
        $this->query($sql);
        $formulario = [
          'TítulosX' => ['Indicador','Cantidad'],
          'TítulosY' => $this->registros(),
        ];
        array_push($retornar, $formulario);
      }
      return $retornar;
      }

    public function administrative_management(){
      $sql = "SELECT activities as 'title', id as 'id' from administrative_management;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Descripción','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      }

    public function health_education($nivel){
      $sql = "SELECT type as 'title', id as 'id' from health_education ";
       if(!($nivel=="quinto"||$nivel=="Quinto nivel"))
        $sql=$sql." where id <> 4 ";

      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Tipo','Meta'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      }

    public function health_education_data($nivel,$fecha=0){
      if(isset($_SESSION['fecha']))
        $fecha=$_SESSION['fecha'];

      $sql="SELECT hed.description,hed.status,he.type,hed.listeners,DATE_FORMAT(hed.created_at,'%Y/%m/%d'),hed.id as Extra from health_education_data hed 
       inner join levels l on l.id=hed.level_id 
       inner join health_education he on he.id=hed.health_education_id 
       where l.name LIKE '%".$nivel."%'";
        if($fecha==0||$fecha['tipo']=='default')
          $sql=$sql." and hed.status='Programada'";
        else{
          $sql=$sql." and hed.status LIKE'%".$fecha['tipo']."%' and hed.created_at between '".$fecha['fecha1']."' and '".$fecha['fecha2']."'";
        }

      $this->query($sql);
      $datos=[
        'values' => $this->registros(),
        'titulo' => ['Descripción','Estado','Tipo','Oyentes','Programado para'],
      ];
      return $datos;
      }

    public function investigations_data($nivel,$fecha=0){
      if(isset($_SESSION['fecha']))
        $fecha=$_SESSION['fecha'];

      $sql="SELECT i.name,i.description,i.status,DATE_FORMAT(i.date,'%Y/%m/%d'),i.id as Extra from investigations i 
       inner join levels l on l.id=i.level_id 
       where l.name LIKE '%$nivel%'";
        if($fecha==0||$fecha['tipo']=='default')
          $sql=$sql." and i.status='Programada'";
        else{
          $sql=$sql." and i.status LIKE'%".$fecha['tipo']."%' and i.date between '".$fecha['fecha1']."' and '".$fecha['fecha2']."'";
        }
      $this->query($sql);
      $datos=[
        'values' => $this->registros(),
        'titulo' => ['Nombre','Descripción','Estado','Programado para'],
      ];
      return $datos;
      }

    public function investigations($id){
      
      $sql="SELECT i.name as 'name',i.description as 'descripcion',i.status as 'estatus',DATE_FORMAT(i.date,'%Y/%m/%d')as 'fecha',l.name as 'nivel' from investigations i inner join levels l on l.id=i.level_id where i.id = $id LIMIT 1";
        
      $this->query($sql);
      return $this->registro();
      }
    public function education($id){
      
      $sql="SELECT hed.description as 'descripcion',hed.status as 'estatus',hed.health_education_id as 'tipo',DATE_FORMAT(hed.created_at,'%Y/%m/%d') as 'fecha',l.name as 'nivel',he.listeners as 'Oyentes' from health_education_data hed 
       inner join levels l on l.id=hed.level_id 
       inner join health_education he on he.id=hed.health_education_id 
       where hed.id = ".$id." LIMIT 1";
        
      $this->query($sql);
      return $this->registro();
      }

    public function listeners(){
      $valor = ['Enfermería','Colaboradores Clínicos','Recepcionistas','Auxiliares de Servicio','Técnicos de Farmacia','Aux. de Servicio de la Empresa Premium'];

      for ($i=0; $i < count($valor); $i++) { 
        $aux = new stdClass();
        $aux->title=$valor[$i];
        $aux->id=$i;
        $valores[]= $aux;
      }
      $formulario[] = [
        'TítulosX' => ['Descripción','Oyentes'],
        'TítulosY' => $valores,
      ];

      $aux=new stdClass();
      $aux->title='Total';
      $aux->id=1;
      $formulario[]=[
        'TítulosX' => ['Descripción','Oyentes'],
        'TítulosY' => [$aux],
      ];
      return $formulario;
      }
}